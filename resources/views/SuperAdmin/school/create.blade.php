@extends('superAdmin.layouts.main')
@section('title',isset($formData) ? "Edit School" : "Add School")
@section('content')
<style>
    .form-block { margin-top: 20px; }
    .block-inner { padding: 15px 0px; }
    .SchoolImagePreview { padding: 0px; margin: 0px;}

</style>
<div class="create-main-outer pb-5">
<form action="{{ isset($formData) ? route('superadmin.school.edit.submit',$formData->id) : route('superadmin.school.create.submit') }}" method="POST" class="createSchool" id="createSchool" name="createSchool"  enctype="multipart/form-data" novalidate>
    <div class="form-block">
        <h2>Basic Information</h2>
        <div class="border rounded d-flex flex-wrap block-inner">

            <div class="col-md-4">
                @include('components.textInput',['name' => 'school_name','title' => 'School Name','required' => true, 'value' => isset($formData) ? $formData->school_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'school_description','title' => 'School Description','required' => false, 'value' => isset($formData) ? $formData->school_description : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Started On</label>
                    <input type="date" class="form-control" name="started_on" value='{{ isset($formData) ? $formData->school_started_on : ""}}'>
                </div>
            </div>
            <div class="col-md-4 required">
                <div class="form-group">
                    <label for="status">Subdomain</label>
                    <select class="selectpicker form-control" id="subdomain_id" name="subdomain_id" required>
                      <option>Select Subdomain</option>
                      @foreach ($subdomains as $subdomain)
                        <option value="{{$subdomain->strong_id}}">{{$subdomain->subdomain}}</option>
                      @endforeach
                    </select>
                  </div>
            </div>
            <div class="col-md-4">
                @include('components.imageUploadPriview',['name' => 'school_image','title' => 'School Image',"previewLink" => isset($formData) ? $formData->school_image : "" ])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Land Line','name' => 'land_line', 'value' => isset($formData) ? $formData->school_land_line : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Primary Contact Number','name' => 'primary_contact_number', 'value' => isset($formData) ? $formData->school_phone1 : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Seconday Contact Number','name' => 'secondary_contact_number', 'value' => isset($formData) ? $formData->school_phone2 : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Admin Email','name' => 'email', 'type' => 'email', 'required' => true, 'value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Password','name' => 'password','value' => isset($formData) ? "" : $strong_password, 'required' => isset($formData) ? false : true])
                @if(isset($formData)) <small class="text-danger">Leave blank if you don't want to change password</small> @endif
            </div>
        </div>
    </div>
    <div class="form-block">
        <h2>Address</h2>
        <div class="border rounded d-flex flex-wrap block-inner">

        <div class="col-md-4">
            @include('components.textInput',['name' => 'address1','title' => 'Address 1', 'value' => isset($formData) ? $formData->school_address1 : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'address2','title' => 'Address 2', 'value' => isset($formData) ? $formData->school_address2 : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'street','title' => 'Street', 'value' => isset($formData) ? $formData->school_street : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'city','title' => 'City', 'value' => isset($formData) ? $formData->school_city : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'district','title' => 'District', 'value' => isset($formData) ? $formData->school_district : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'state','title' => 'State', 'value' => isset($formData) ? $formData->school_state : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'pincode','title' => 'Pincode', 'value' => isset($formData) ? $formData->school_pincode : ""])
        </div>
    </div>
</div>
<div class="form-block">
    <h2>Additional Information</h2>
        <div class="border rounded d-flex flex-wrap block-inner">

        <div class="col-md-4">
            @include('components.textInput',['name' => 'short_name','title' => 'Short Name', 'value' => isset($formData) ? $formData->school_short_name : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'short_description','title' => 'Short Description', 'value' => isset($formData) ? $formData->school_short_description : ""])
        </div>
        <div class="col-md-4">
            @include('components.imageUploadPriview',['name' => 'school_favicon','title' => 'School Favicon',"previewLink" => isset($formData) ? $formData->school_favicon : "" ])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'school_meta_title','title' => 'Meta Titile', 'value' => isset($formData) ? $formData->school_meta_title : ""])
        </div>
    </div>
</div>
<div class="form-block pb-5">
    <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Save' }}</button>
</div>
</form>
</div>
@include('components.ajaxFormSubmit',['formId' => 'createSchool'])
@endsection
