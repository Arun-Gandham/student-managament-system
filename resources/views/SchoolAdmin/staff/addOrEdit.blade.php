@extends('SchoolAdmin.layouts.main')
@section('title',isset($formData) ? "Edit Staff" : "Add Staff")
@section('content')
<style>
    .form-block { margin-top: 20px; }
    .block-inner { padding: 15px 0px; }
    .SchoolImagePreview { padding: 0px; margin: 0px;}

</style>
<div class="create-main-outer pb-5">
    <form action="{{ isset($formData) ? route('schooladmin.staff-management.edit.submit',$formData->id) : route('schooladmin.staff-management.add.submit') }}" method="POST" class="addOrEditStaff" id="addOrEditStaff" name="addOrEditStaff"  enctype="multipart/form-data">
        <div class="form-block">
            <h3>Basic information</h3>
            <div class="border rounded d-flex flex-wrap block-inner">
                <div class="col-md-4">
                    @include('components.textInput',['name' => 'name','title' => 'Staff Name','required' => true, 'value' => isset($formData) ? $formData->name : ""])
                </div>
                <div class="col-md-4">
                    @include('components.mobileNumber',['title' => 'Phone Number','name' => 'phone', 'value' => isset($formData) ? $formData->phone : "", 'required' => true])
                </div>
                <div class="col-md-4">
                    @include('components.mobileNumber',['title' => 'Alternate Phone Number','name' => 'alt_phone', 'value' => isset($formData) ? $formData->alt_phone : ""])
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Date Of Joining</label>
                        <input type="date" class="form-control" name="doj" value='{{ isset($formData) ? $formData->doj : ""}}'>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('components.textInput',['title' => 'Staff Email','name' => 'email', 'type' => 'email', 'required' => true, 'value' => isset($formData) ? $formData->email : ""])
                </div>
                <div class="col-md-4">
                    @include('components.textInput',['title' => 'Password','name' => 'password','value' => isset($formData) ? "" : $strong_password, 'required' => isset($formData) ? false : true])
                    @if(isset($formData)) <small class="text-danger">Leave blank if you don't want to change password</small> @endif
                </div>
                <div class="col-md-4">
                    <div class="form-group required">
                        <label for="status">Role</label>
                        <select class="selectpicker form-control" id="role" name="role" required>
                        <option value="">Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ isset($formData) && $formData->role == $role->id ? "selected" : "" }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('components.imageUploadPriview',['name' => 'profile_photo','title' => 'Profile Photo',"previewLink" => isset($formData) ? $formData->profile_photo : "" ])
                </div>
            </div>
        </div>
        <div class="form-block">
            <h3>Address</h3>
            <div class="border rounded d-flex flex-wrap block-inner">

            <div class="col-md-4">
                @include('components.textInput',['name' => 'house_no','title' => 'Dr No.', 'value' => isset($formData) && isset($formData->getAddress->house_no) ? $formData->getAddress->house_no : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'street','title' => 'Street', 'value' => isset($formData) && isset($formData->getAddress->street) ? $formData->getAddress->street : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'city','title' => 'City', 'value' => isset($formData) && isset($formData->getAddress->city) ? $formData->getAddress->city : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'district','title' => 'District', 'value' => isset($formData) && isset($formData->getAddress->district)? $formData->getAddress->district : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">State</label>
                    <select class="selectpicker form-control" id="state" name="state">
                    <option value="">Select State</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ isset($formData) && isset($formData->getAddress->state) && $formData->getAddress->state == $state->id ? "selected" : "" }}>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="tel"class="form-control" placeholder="Pincode" minlength="5" maxlength="6" id="pincode" name="pincode" pattern="[0-9]{6}" title="6 digit PIncode" value="{{ isset($formData) && isset($formData->getAddress->pincode)? $formData->getAddress->pincode : "" }}">
                </div>
            </div>
        </div>
    </div>
    <div class="form-block">
        <h3>Additional Information</h3>
            <div class="border rounded d-flex flex-wrap block-inner">
            <div class="col-md-4">
                @include('components.textInput',['name' => 'short_name','title' => 'Staff Id', 'value' => isset($formData) ? $formData->school_short_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'short_description','title' => 'Staff Sallary Per Anum', 'value' => isset($formData) ? $formData->school_short_description : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Date Of Releaving</label>
                    <input type="date" class="form-control" name="started_on" value='{{ isset($formData) ? $formData->school_started_on : ""}}'>
                </div>
            </div>
        </div>
    </div>
    <div class="form-block pb-5">
        <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Save' }}</button>
    </div>
    </form>
    </div>
    @include('components.ajaxFormSubmit',['formId' => 'addOrEditStaff'])
@endsection
