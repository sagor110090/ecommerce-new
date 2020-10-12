<?php

namespace App\Http\Controllers;

use Artisan;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }
    public function crud2index()
    {
        return view('crud2');
    }

    public function crudIndex()
    {
        return view('crud');
    }

    public function jsonSave(Request $request)
    {
        $request->validate([
            'modelName' => 'required',
        ]);
        $validate = [];
        $formdata = [];
        $relationships = [];
        $foreign_keys = [];
        DB::table('crud')->truncate();
        $myFile = "data.json";
        $arr_data = [];

        try
        {
            if ($request->name != null) {
                foreach ($request->name as $i => $value) {
                    $formdata[$i] = [
                        'name' => $request->name[$i],
                        'type' => $request->type[$i],
                    ];
                }
            }

            if ($request->referencesTable != null) {
                foreach ($request->referencesTable as $i => $value) {
                    if ($request->referencesTable[$i] != null) {
                        $foreign_keys[$i] = [
                            "column" => $request->name[$i],
                            "references" => $request->referencesField[$i],
                            "on" => $request->referencesTable[$i],
                            "onDelete" => "cascade",

                        ];
                    }
                }
            }
            $foreign_keys = array_values($foreign_keys);
            if ($request->name) {
                foreach ($request->name as $i => $value) {
                    if ($request->required[$i] != 'not') {
                        $validate[$i] = [
                            'field' => $request->name[$i],
                            'rules' => $request->required[$i],
                        ];
                    }
                }
            }
            if ($request->rname != null) {
                foreach ($request->rname as $i => $value) {
                    $relationships[$i] = [
                        'name' => $request->rname[$i],
                        'class' => $request->class[$i],
                        'type' => $request->rtype[$i],
                    ];
                }
            }

            $final = [
                'fields' => $formdata,
                'foreign_keys' => $foreign_keys,
                'validations' => $validate,
                'relationships' => $relationships,
            ];

            $jsondata = file_get_contents($myFile);
            $final = json_encode($final);
            DB::table('crud')->insert([
                'content' => $final,
            ]);

            $arr_data = json_decode($jsondata, true);
            $jsondata = json_encode($final, JSON_PRETTY_PRINT);
            $res = DB::table('crud')->first();
            if (file_put_contents($myFile, $res->content)) {
                echo 'Data successfully saved';
            } else {
                echo "error";
            }

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        if ($request->name != null) {
            Artisan::call('crud:generate "' . $request->modelName . '" --fields_from_file="data.json" --view-path=admin --controller-namespace=Admin --route-group=admin --form-helper=html');
            Artisan::call('migrate');

            return redirect()->back()->with('success', 'make successfully!');

        }
        return redirect()->back()->with('error', 'error Give the input carefully!');

    }
    public function crudMaker(Request $request)
    {
        $request->validate([
            'modelName' => 'required',
        ]);

        $fields = '';
        foreach ($request->fields as $key => $value) {
            $fields .= $value;
        }
        if ($request->name != null) {
            Artisan::call("crud:generate '" . $request->modelName . "' --fields='" . $fields . "'--view-path=admin --controller-namespace=Admin --route-group=admin --form-helper=html");
            return redirect()->back()->with('success', 'make successfully!');
        }
        return redirect()->back()->with('error', 'error Give the input carefully!');

    }

}
