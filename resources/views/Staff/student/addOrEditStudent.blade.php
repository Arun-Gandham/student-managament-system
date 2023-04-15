@extends('staff.layouts.main')
@section('title',isset($formData) ? "Edit Student" : "Add Student")
@section('content')
<style>
    .form-block { margin-top: 20px; }
    .block-inner { padding: 15px 0px; }
    .SchoolImagePreview { padding: 0px; margin: 0px;}

</style>
<div class="create-main-outer pb-5">
<form action="{{ isset($formData) ? route('staff.student.edit.submit',$formData->id) : route('staff.student.add.submit') }}" method="POST" class="addOrEditStudent" id="addOrEditStudent" name="addOrEditStudent"  enctype="multipart/form-data" novalidate>
    <div class="form-block">
        <h2>Basic Information</h2>
        <div class="border rounded d-flex flex-wrap block-inner">

            <div class="col-md-4">
                @include('components.textInput',['name' => 'first_name','title' => 'First Name','required' => true, 'value' => isset($formData) ? $formData->school_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'last_name','title' => 'Last Name', 'value' => isset($formData) ? $formData->school_description : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'sur_name','title' => 'Sur Name','required' => true, 'value' => isset($formData) ? $formData->school_description : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'registration_number','title' => 'Registration Number','required' => true, 'value' => isset($formData) ? $formData->school_description : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="exampleInputEmail1">Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" id="dob" value='{{ isset($formData) ? $formData->school_started_on : ""}}' required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="status">Gender</label>
                    <select class="selectpicker form-control" id="gender" name="gender">
                        <option value="">Select Gender</option>
                        @foreach ($genders as $gender)
                            <option value="{{$gender->id}}" {{ $id  == $gender->id ? "selected" : "" }}>{{ $gender->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Contact Number ( If any )','name' => 'phone', 'value' => isset($formData) ? $formData->school_phone1 : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Email ( If any )','name' => 'email', 'value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                @include('components.imageUploadPriview',['name' => 'profile_photo','title' => 'Profile Photo',"previewLink" => isset($formData) ? $formData->school_image : "" ])
            </div>
        </div>
    </div>
    <div class="form-block">
        <h2>Parent/Guardian Information</h2>
            <div class="border rounded d-flex flex-wrap block-inner">
            <div class="col-md-12">
            <h4>Person 1</h4>
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Name', 'name' => 'primary_name', 'required' => false, 'value' => isset($formData) ? $formData->school_short_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Phone Number','name' => 'primary_phone_number', 'required' => false, 'value' => isset($formData) ? $formData->school_phone1 : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Alternamte Phone Number ','name' => 'primary_alt_phone_number', 'value' => isset($formData) ? $formData->school_phone1 : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Email','name' => 'primary_email', 'required' => false, 'type' => 'email', 'value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Education','name' => 'primary_education','value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Ocupation','name' => 'primary_education','value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="status">Relationship to the student</label>
                    <select class="selectpicker form-control" name="primary_relation" >
                        <option value="">Select Relation</option>
                        <option value="1">Father</option>
                        <option value="2">Giardian</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 divide-line"></div>

            <div class="col-md-12">
            <h4>Person 2</h4>
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Name', 'name' => 'secondary_name', 'value' => isset($formData) ? $formData->school_short_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Phone Number','name' => 'secondary_phone_number', 'value' => isset($formData) ? $formData->school_phone1 : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Alternamte Phone Number ','name' => 'secondary_alt_phone_number', 'value' => isset($formData) ? $formData->school_phone1 : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Email','name' => 'secondary_email', 'type' => 'email', 'value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Education','name' => 'secondary_education','value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Ocupation','name' => 'secondary_education','value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Relationship to the student</label>
                    <select class="selectpicker form-control" name="secondaty_relation">
                        <option value="">Select Relation</option>
                        <option value="1">Father</option>
                        <option value="2">Giardian</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-block">
        <h2>Address</h2>
        <div class="border rounded d-flex flex-wrap block-inner">

        <div class="col-md-4">
            @include('components.textInput',['name' => 'address1','required' => false, 'title' => 'Address 1', 'value' => isset($formData) ? $formData->school_address1 : ""])
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

<div class="form-block pb-5">
    <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Add' }}</button>
</div>
</form>
</div>
@include('components.ajaxFormSubmit',['formId' => 'addOrEditStudent'])
@endsection
