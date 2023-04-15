@extends('superAdmin.layouts.main')
@section('title',isset($formData) ? "Edit Module" : "Add Moule")
@section('content')
<style>
    .form-block { margin-top: 20px; }
    .block-inner { padding: 15px 0px; }
    .SchoolImagePreview { padding: 0px; margin: 0px;}

</style>
<div class="create-main-outer pb-5">
<form action="{{ isset($formData) ? route('superadmin.module.edit.submit',$formData->id) : route('superadmin.module.add.submit') }}" method="POST" class="addModule" id="addModule" name="addModule" novalidate>
    <div class="form-block">
        <h2>{{ isset($formData) ? "Edit" : "Add" }} Module</h2>
        <div class="border rounded d-flex flex-wrap block-inner">

            <div class="col-md-12">
                @include('components.textInput',['name' => 'name','title' => 'Module Name','required' => true, 'value' => isset($formData) ? $formData->name : ""])
            </div>
            <div class="col-md-12">
                @include('components.textInput',['name' => 'description','title' => 'Module Description','required' => true, 'value' => isset($formData) ? $formData->description : ""])
            </div>
        </div>
    </div>
<div class="form-block pb-5">
    <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Save' }}</button>
</div>
</form>
</div>
@include('components.ajaxFormSubmit',['formId' => 'addModule'])
@endsection
