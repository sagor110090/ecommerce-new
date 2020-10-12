@extends('layouts.app',['pageTitle' => __('crud')])

@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __('crud') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Crud Generate</h4>
                    <h5 class="card-subtitle">System creater</h5>
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                @foreach ($errors->all() as $error)
                <strong>{{$error}}</strong>
                @endforeach
            </div>

            @endif

            <form action="{{ url('jsonSave') }}" method="post">
                @csrf
                <input type="text" class="form-control" id="modelName" name="modelName" placeholder="Model Name">

                <div class="form-inline m-1" style="padding: 10px">
                    <input type="text" class="form-control" id="name" placeholder="field name">
                    <select name="type" id="type" class="form-control">
                        <option value="string">string</option>
                        <option value="integer">integer</option>
                        <option value="longtext">textarea</option>
                        <option value="number">number</option>
                        <option value="date">date</option>
                        <option value="time">time</option>
                        <option value="file">file</option>
                        <option value="password">password</option>
                        <option value="integer#unsigned">integer#unsigned</option>
                        <option value="bigint#unsigned">bigInteger#unsigned</option>
                    </select>

                    <select name="required" id="required" class="form-control">
                        <option value="not">Not required</option>
                        <option value="required">required</option>
                    </select>

                    <a href="#" class="btn btn-success btn-sm add-row "><i class="fa fa-plus"
                            aria-hidden="true"></i></a>
                    <input type="checkbox" name="" id="foreginKeyDivShow">
                    <div id="foreginKeyDiv">
                        <input type="text" class="form-control" id="referencesTable" placeholder="references table">
                        <input type="text" class="form-control" id="referencesField" placeholder="references field">
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Required</th>
                            <th>References table</th>
                            <th>References field</th>
                        </tr>
                    </thead>
                    <tbody id="fieldTable">

                    </tbody>
                </table>
                <button type="button" class="delete-row btn btn-danger btn-sm"> <i class="fa fa-trash"
                        aria-hidden="true"></i> </button>

                <hr>
                <div class="form-inline m-1" style="padding: 10px">
                    <input type="text" class="form-control" id="rname" placeholder="function name">
                    <select id="rtype" class="form-control">
                        <option value="belongsTo">hasOne</option>
                        <option value="belongsTo">belongsTo</option>
                        <option value="hasMany">hasMany</option>
                    </select>

                    <input type="text" class="form-control" id="rclass" placeholder="App\class">

                    <a href="#" class="btn btn-success btn-sm " id="addReletionship"><i class="fa fa-plus"
                            aria-hidden="true"></i></a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>RType</th>
                            <th>RName</th>
                            <th>class</th>
                        </tr>
                    </thead>
                    <tbody id="reletion">

                    </tbody>
                </table>
                <button type="button" class="delete-row btn btn-danger btn-sm"> <i class="fa fa-trash"
                        aria-hidden="true"></i> </button>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection
@push('js')
<script>
    $(document).ready(function () {
        var i = 0;
        var totalString = '';
        $(".add-row").click(function (e) {
            e.preventDefault();
            var type = $("#type").val();
            var name = $("#name").val();
            var required = $("#required").val();
            var referencesTable = $("#referencesTable").val();
            var referencesField = $("#referencesField").val();
            if (type != '' && name != '') {
                var hash = "#";
                var res = name + hash + type + ';';
                totalString += res;
                $('#totalString').val(totalString);
                var markup =
                    "<tr><td class='align-center'><input type='checkbox' name='record'></td><td class='align-center'><input type='text' value='" +
                    type +
                    "'  id='type' name='type[]' style='width: 60px;border:unset;'></td><td class='align-center'><input type='text' value='" +
                    name +
                    "'  id='name' name='name[]' style='width: 60px;border:unset;'></td> </td><td class='align-center'><input type='text' value='" +
                    required +
                    "'  id='required' name='required[]' style='width: 60px;border:unset;'></td><td class='align-center'><input type='text' value='" +
                    referencesTable +
                    "'  id='required' name='referencesTable[]' style='width: 60px;border:unset;'></td><td class='align-center'><input type='text' value='" +
                    referencesField +
                    "'  id='required' name='referencesField[]' style='width: 60px;border:unset;'></td></tr>";
                $("#fieldTable").append(markup);
            }
            // $("#type").val('');
            $("#name").val('');
            // $("#required").val('');
            $("#referencesTable").val('');
            $("#referencesField").val('');
        });
        // Find and remove selected table rows
        $(".delete-row").click(function () {
            $("table tbody").find('input[name="record"]').each(function () {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });
    });
    $('#addReletionship').click(function (e) {
        e.preventDefault();
        var rtype = $("#rtype").val();
        var rname = $("#rname").val();
        var rclass = $("#rclass").val();
        if (rtype != '' && rname != '' && rclass != '') {
            var rmarkup = "<tr><td><input type='checkbox' name='record'></td><td><input type='text' value='" +
                rtype +
                "'  id='type' name='rtype[]' style='border:unset;'></td><td><input type='text' value='" +
                rname +
                "'  id='name' name='rname[]' style='border:unset;'></td> </td></td><td><input type='text' value='" +
                rclass +
                "'  id='required' name='class[]' style='border:unset;'></td></tr>";
            $("#reletion").append(rmarkup);
        }
        $("#rname").val('');
        // $("#rtype").val('');
        $("#rclass").val('');

    });
    $("#foreginKeyDiv").hide();
    $("#foreginKeyDivShow").change(function (e) {
        e.preventDefault();
        // alert('click');
        if (this.checked) {
            $('#foreginKeyDiv').slideDown('show').show();
        } else {
            $("#foreginKeyDiv").slideUp("slow")
        }
    });

</script>

@endpush
@push('css')
<style>
    .btn.btn-sm {
        padding: 0.1rem 0.4rem;
        font-size: 12px;
        margin: 5px;
    }

    input {
        margin: 5px !important;
    }

    select#required {
        margin: 5px !important;
    }

    div#foreginKeyDiv {
        display: inline-grid;
    }

</style>
<link rel="stylesheet" href="{{ asset('assets') }}/css/fontawesome.css">

@endpush
