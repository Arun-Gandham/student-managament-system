@extends('superAdmin.layouts.main')
@section('title',isset($formData) ? "Edit Subdomain" : "Add Subdomain")
@section('content')
<style>
    .form-block { margin-top: 20px; }
    .block-inner { padding: 15px 0px; }
    .SchoolImagePreview { padding: 0px; margin: 0px;}

</style>
<div class="create-main-outer pb-5">
<form action="{{ isset($formData) ? route('superadmin.subdomain.edit',$formData->id) : route('superadmin.subdomain.add') }}" method="POST" class="addSubdomain" id="addSubdomain" name="addSubdomain" novalidate>
    <div class="form-block">
        <h2>{{ isset($formData) ? "Edit" : "Add" }} Subdomain</h2>
        <div class="border rounded d-flex flex-wrap block-inner">

            <div class="col-md-12">
                @include('components.textInput',['name' => 'subdomain','title' => 'Name','required' => true, 'value' => isset($formData) ? $formData->subdomain : ""])
            </div>
            <div class="col-md-12">
                @include('components.textInput',['name' => 'strong_id','title' => 'Strong Id','required' => true, 'value' => isset($formData) ? $formData->strong_id : time()])
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Subdomain Status</label>
                    <select class="selectpicker form-control" id="status" name="status">
                      <option value="1" {{ isset($formData) && $formData->status == "1" ? "selected" : "" }}>Active</option>
                      <option value="0" {{ isset($formData) && $formData->status == "0" ? "selected" : "" }}>Inactive</option>
                    </select>
                  </div>
            </div>
        </div>
    </div>
<div class="form-block pb-5">
    <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Save' }}</button>
</div>
</form>
</div>
@include('components.ajaxFormSubmit',['formId' => 'addSubdomain'])
@endsection
