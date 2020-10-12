@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crud Generate</div>

                <div class="card-body">
                    <form action="{{ url('crudMaker') }}" method="post">
                        @csrf
                    <input type="text" class="form-control" id="modelName" name="modelName" placeholder="Model Name">
                    
                    <div class="form-inline m-1" style="padding: 10px">
                        
                        <input type="text"  class="form-control"  id="name" placeholder="name">
                        
                        {{-- <input type="text" class="form-control" id="type" placeholder="type"> --}}
                        <select name="type" id="type" class="form-control">
                            <option value="string">string</option>
                            <option value="email">email</option>
                            <option value="integer">integer</option>
                            <option value="textarea">textarea</option>
                            <option value="number">number</option>
                            <option value="date">date</option>
                            <option value="time">time</option>
                            <option value="file">file</option>
                            <option value="password">password</option>
                            <option value="integer#unsigned">integer#unsigned</option>
                        </select>
                        <a href="#" class="btn btn-success btn-sm add-row "><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    <button type="button" class="delete-row btn btn-danger btn-sm"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function(){
        var i = 0;
        var totalString ='';

        $(".add-row").click(function(e){
                e.preventDefault();
            var type = $("#type").val();
            var name = $("#name").val();
            if (type != '' && name != '') {
                var hash = "#";
                var res = name+hash+type+';';
                totalString += res;
                $('#totalString').val(totalString);
                var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + type + "</td><td>" + name + "</td> </td><td><input type='text' value='" + res + "'  id='fields' name='fields[]' style='border:unset;'></td></tr>";
                $("table tbody").append(markup);

            }
            // $("#type").val('');
            $("#name").val('');
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });    
</script>

@endpush
@push('css')
    <style>
    input {
        margin: 10px !important;
}
    </style>
@endpush
