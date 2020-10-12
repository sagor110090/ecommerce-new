<?php

namespace Sagor110090\CrudGenerator\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate
                            {name : The name of the Crud.}
                            {--fields= : Field names for the form & migration.}
                            {--fields_from_file= : Fields from a json file.}
                            {--validations= : Validation rules for the fields.}
                            {--controller-namespace= : Namespace of the controller.}
                            {--model-namespace= : Namespace of the model inside "app" dir.}
                            {--pk=id : The name of the primary key.}
                            {--pagination=25 : The amount of models per page for index pages.}
                            {--indexes= : The fields to add an index to.}
                            {--foreign-keys= : The foreign keys for the table.}
                            {--relationships= : The relationships for the model.}
                            {--route=yes : Include Crud route to routes.php? yes|no.}
                            {--route-group= : Prefix of the route group.}
                            {--view-path= : The name of the view path.}
                            {--form-helper=html : Helper for generating the form.}
                            {--localize=no : Allow to localize? yes|no.}
                            {--locales=en : Locales language type.}
                            {--soft-deletes=no : Include soft deletes fields.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Crud including controller, model, views & migrations.';

    /** @var string  */
    protected $routeName = '';

    /** @var string  */
    protected $controller = '';

    protected $seederName = '';
    protected $sidebarName = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $modelName = Str::singular($name);
        // inisilizzing seeder name
        $this->seederName  = strtolower(Str::singular($name));
        $this->sidebarName  = Str::snake($name, '-');
        
        $migrationName = Str::plural(Str::snake($name));
        $tableName = $migrationName;

        $routeGroup = $this->option('route-group');
        $this->routeName = ($routeGroup) ? $routeGroup . '/' . Str::snake($name, '-') : Str::snake($name, '-');
        $perPage = intval($this->option('pagination'));

        $controllerNamespace = ($this->option('controller-namespace')) ? $this->option('controller-namespace') . '\\' : '';
        $modelNamespace = ($this->option('model-namespace')) ? trim($this->option('model-namespace')) . '\\' : '';

        $fields = rtrim($this->option('fields'), ';');

        if ($this->option('fields_from_file')) {
            $fields = $this->processJSONFields($this->option('fields_from_file'));
        }

        $primaryKey = $this->option('pk');
        $viewPath = $this->option('view-path');

        $foreignKeys = $this->option('foreign-keys');

        if ($this->option('fields_from_file')) {
            $foreignKeys = $this->processJSONForeignKeys($this->option('fields_from_file'));
        }

        $validations = trim($this->option('validations'));
        if ($this->option('fields_from_file')) {
            $validations = $this->processJSONValidations($this->option('fields_from_file'));
        }

        $fieldsArray = explode(';', $fields);
        $fillableArray = [];
        $migrationFields = '';

        foreach ($fieldsArray as $item) {
            $spareParts = explode('#', trim($item));
            $fillableArray[] = $spareParts[0];
            $modifier = !empty($spareParts[2]) ? $spareParts[2] : 'nullable';

            // Process migration fields
            $migrationFields .= $spareParts[0] . '#' . $spareParts[1];
            $migrationFields .= '#' . $modifier;
            $migrationFields .= ';';
        }

        $commaSeparetedString = implode("', '", $fillableArray);
        $fillable = "['" . $commaSeparetedString . "']";

        $localize = $this->option('localize');
        $locales = $this->option('locales');

        $indexes = $this->option('indexes');
        $relationships = $this->option('relationships');
        if ($this->option('fields_from_file')) {
            $relationships = $this->processJSONRelationships($this->option('fields_from_file'));
        }

        $formHelper = $this->option('form-helper');
        $softDeletes = $this->option('soft-deletes');

        $this->call('crud:controller', ['name' => $controllerNamespace . $name . 'Controller', '--crud-name' => $name, '--model-name' => $modelName, '--model-namespace' => $modelNamespace, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--pagination' => $perPage, '--fields' => $fields, '--validations' => $validations]);
        $this->call('crud:model', ['name' => $modelNamespace . $modelName, '--fillable' => $fillable, '--table' => $tableName, '--pk' => $primaryKey, '--relationships' => $relationships, '--soft-deletes' => $softDeletes]);
        $this->call('crud:migration', ['name' => $migrationName, '--schema' => $migrationFields, '--pk' => $primaryKey, '--indexes' => $indexes, '--foreign-keys' => $foreignKeys, '--soft-deletes' => $softDeletes]);
        $this->call('crud:view', ['name' => $name, '--fields' => $fields, '--validations' => $validations, '--view-path' => $viewPath, '--route-group' => $routeGroup, '--localize' => $localize, '--pk' => $primaryKey, '--form-helper' => $formHelper]);
        if ($localize == 'yes') {
            $this->call('crud:lang', ['name' => $name, '--fields' => $fields, '--locales' => $locales]);
        }

        // For optimizing the class loader
        if (\App::VERSION() < '5.6') {
            $this->callSilent('optimize');
        }

        // Updating the Http/routes.php file
        $routeFile = app_path('Http/routes.php');

        if (\App::VERSION() >= '5.3') {
            $routeFile = base_path('routes/web.php');
             
            $seedsFile = base_path('database/seeds/PermissionsSeeder.php');

            $sidebar = base_path('resources/views/layouts/parts/sidebar.blade.php');
        }

        if (file_exists($routeFile) && (strtolower($this->option('route')) === 'yes')) {
            $this->controller = ($controllerNamespace != '') ? $controllerNamespace . '\\' . $name . 'Controller' : $name . 'Controller';

            $isAdded = File::append($routeFile, "\n" . implode("\n", $this->addRoutes()));

            if ($isAdded) {
                $this->info('Crud/Resource route added to ' . $routeFile);
            } else {
                $this->info('Unable to add the route to ' . $routeFile);
            }
        }

        // add seed 
        if (file_exists($seedsFile)) {
            $permissions = [
                'show',
                'create',
                'edit',
                'delete',
            ];
            for ($i=0; $i < 4; $i++) { 
                $isAdded = File::append($seedsFile, "\n" . implode("\n", $this->addSeeds($permissions[$i])));
            }

            if ($isAdded) {
                $this->info('seed added to ' . $seedsFile);
            } else {
                $this->info('Unable add seed to ' . $seedsFile);
            }
        }
        // add sidebar 
        if (file_exists($sidebar)) {
             
             
            $isAdded = File::append($sidebar, "\n" . implode("\n", $this->addSidebar()));

            

            if ($isAdded) {
                $this->info('seed added to ' . $sidebar);
            } else {
                $this->info('Unable add seed to ' . $sidebar);
            }
        }
    }

    /**
     * Add routes.
     *
     * @return  array
     */
    protected function addRoutes()
    {
        return ["Route::resource('" . $this->routeName . "', '" . $this->controller . "');"];
    }
    protected function addSeeds($permissions)
    {
        $seederName =  $this->seederName.'-'.$permissions;
        return ["DB::table('permissions')->insert(['name'=> '". $seederName."']);"];
    }
    protected function addSidebar()
    { 
        $sidebarName =  $this->sidebarName;
        return ['<li class="dropdown {{ Request::is("'.$this->routeName.'*") ? "active":""}}"> <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>'. ucwords( Str::replaceArray('-', [' '], $sidebarName)).' Management </span></a><ul class="dropdown-menu"><li class="{{ Request::is("'.$this->routeName.'/create*") ? "active":""}}"><a class="nav-link" href="{{ url("'.$this->routeName.'/create") }}">New '.ucwords( Str::replaceArray('-', [''], $sidebarName)).'</a></li> <li class="{{ Request::is("'.$this->routeName.'") ? "active":""}}"><a class="nav-link" href="{{ url("'.$this->routeName.'") }}">'.ucwords( Str::replaceArray('-', [''], $sidebarName)).' List</a></li> </ul></li>'];
    }

    /**
     * Process the JSON Fields.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONFields($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        $fieldsString = '';
        foreach ($fields->fields as $field) {
            if ($field->type === 'select' || $field->type === 'enum') {
                $fieldsString .= $field->name . '#' . $field->type . '#options=' . json_encode($field->options) . ';';
            } else {
                $fieldsString .= $field->name . '#' . $field->type . ';';
            }
        }

        $fieldsString = rtrim($fieldsString, ';');

        return $fieldsString;
    }

    /**
     * Process the JSON Foreign keys.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONForeignKeys($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (! property_exists($fields, 'foreign_keys')) {
            return '';
        }

        $foreignKeysString = '';
        foreach ($fields->foreign_keys as $foreign_key) {
            $foreignKeysString .= $foreign_key->column . '#' . $foreign_key->references . '#' . $foreign_key->on;

            if (property_exists($foreign_key, 'onDelete')) {
                $foreignKeysString .= '#' . $foreign_key->onDelete;
            }

            if (property_exists($foreign_key, 'onUpdate')) {
                $foreignKeysString .= '#' . $foreign_key->onUpdate;
            }

            $foreignKeysString .= ',';
        }

        $foreignKeysString = rtrim($foreignKeysString, ',');

        return $foreignKeysString;
    }

    /**
     * Process the JSON Relationships.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONRelationships($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (!property_exists($fields, 'relationships')) {
            return '';
        }

        $relationsString = '';
        foreach ($fields->relationships as $relation) {
            $relationsString .= $relation->name . '#' . $relation->type . '#' . $relation->class . ';';
        }

        $relationsString = rtrim($relationsString, ';');

        return $relationsString;
    }

    /**
     * Process the JSON Validations.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONValidations($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (!property_exists($fields, 'validations')) {
            return '';
        }

        $validationsString = '';
        foreach ($fields->validations as $validation) {
            $validationsString .= $validation->field . '#' . $validation->rules . ';';
        }

        $validationsString = rtrim($validationsString, ';');

        return $validationsString;
    }
}
