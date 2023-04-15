@extends('SchoolAdmin.layouts.main')
@section('title',isset($formData) ? "Edit Role" : "Add Role")
@section('content')
<style>
    /* .form-block { margin-top: 20px; } */
    .block-inner { padding: 15px 0px; }
</style>
<div class="create-main-outer pb-5">
    <form action="{{ isset($formData) ? route('schooladmin.roles-permissions.roles.edit.submit',$formData->id) : route('schooladmin.roles-permissions.roles.add.submit') }}" method="POST" class="addoreditrole" id="addoreditrole" name="addoreditrole">
        <div class="form-block">
            <h1>{{ isset($formData) ? 'Edit' : 'Add' }} Role</h1>
            <div class="border rounded d-flex flex-wrap block-inner">
                <div class="col-md-12">
                    @include('components.textInput',['name' => 'name','title' => 'Role Name','required' => true, 'value' => isset($formData) ? $formData->name : ""])
                </div>
                <div class="col-md-12">
                    @include('components.textInput',['name' => 'description','title' => 'Role Description','required' => true, 'value' => isset($formData) ? $formData->description : ""])
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Role Status</label>
                        <select class="selectpicker form-control" id="status" name="status">
                          <option value="1" {{ isset($formData) && $formData->status == "1" ? "selected" : "" }}>Active</option>
                          <option value="0" {{ isset($formData) && $formData->status == "0" ? "selected" : "" }}>Inactive</option>
                        </select>
                      </div>
                </div>
            </div>
        </div>
    <div class="form-block pb-5 mt-3">
        <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Add' }}</button>
    </div>
    </form>
    </div>
@include('components.ajaxFormSubmit',['formId' => 'addoreditrole'])
@endsection
