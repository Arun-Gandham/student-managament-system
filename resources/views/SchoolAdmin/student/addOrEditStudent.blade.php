@extends('SchoolAdmin.layouts.main')
@section('title',isset($formData) ? "Edit Student" : "Add Student")
@section('content')
<style>
    .form-block { margin-top: 20px; }
    .block-inner { padding: 15px 0px; }
    .SchoolImagePreview { padding: 0px; margin: 0px;}

</style>
<div class="create-main-outer pb-5">
<form action="{{ isset($formData) ? route('schooladmin.student.edit.submit',$formData->id) : route('schooladmin.student.add.submit') }}" method="POST" class="addOrEditStudent" id="addOrEditStudent" name="addOrEditStudent"  enctype="multipart/form-data" novalidate>
    <div class="form-block">
        <h2>Basic Information</h2>
        <div class="border rounded d-flex flex-wrap block-inner">
            <div class="col-md-4">
                @include('components.textInput',['name' => 'first_name','title' => 'First Name','required' => true, 'value' => isset($formData) ? $formData->first_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'last_name','title' => 'Last Name', 'value' => isset($formData) ? $formData->last_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'sur_name','title' => 'Sur Name','required' => true, 'value' => isset($formData) ? $formData->sur_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Roll No.','name' => 'roll_no', 'value' => isset($formData) ? $formData->roll_no : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['name' => 'registration_number','title' => 'Registration Number','required' => true, 'value' => isset($formData) ? $formData->registration_number : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="exampleInputEmail1">Date Of Birth</label>
                    <input type="date" class="form-control" name="dob" id="dob" value='{{ isset($formData) ? $formData->dob : ""}}' required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="status">Gender</label>
                    <select class="selectpicker form-control" id="gender" name="gender">
                        <option value="">Select Gender</option>
                        @foreach ($genders as $gender)
                            <option value="{{$gender->id}}" {{ isset($formData) && $formData->gender  == $gender->id ? "selected" : "" }}>{{ $gender->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Contact Number ( If any )','name' => 'phone', 'value' => isset($formData) ? $formData->phone : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Email ( If any )','name' => 'email', 'value' => isset($formData) ? $formData->email : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="status">Class</label>
                    <select class="selectpicker form-control" id="class" name="class" required>
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{$class->id}}" {{ isset($formData) && $formData->class_id  == $class->id ? "selected" : "" }}>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="status">Section</label>
                    <select class="selectpicker form-control" id="section" name="section" required>
                        @foreach ($defaultSections as $key => $value)
                        <option value="{{$key}}" {{isset($formData) && $key == $formData->section_id ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Tution Fee','type' => 'number','name' => 'tution_fee','required' => true, 'value' => isset($formData) && isset($formData->getTutionFee->tution_fee) ? $formData->getTutionFee->tution_fee : ""])
            </div>
            <div class="col-md-4">
                @include('components.imageUploadPriview',['name' => 'profile_photo','title' => 'Profile Photo',"previewLink" => isset($formData) ? $formData->profile_photo : "" ])
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
                @include('components.textInput',['title' => 'Name', 'name' => 'primary_name', 'required' => true, 'value' => isset($parentData) ? $parentData->primary_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Phone Number','name' => 'primary_phone_number', 'required' => true, 'value' => isset($parentData) ? $parentData->primary_phone : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Alternamte Phone Number ','name' => 'primary_alt_phone_number', 'value' => isset($parentData) ? $parentData->primary_alt_phone : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Email','name' => 'primary_email', 'required' => false, 'type' => 'email', 'value' => isset($parentData) ? $parentData->primary_email : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Education','name' => 'primary_education','value' => isset($parentData) ? $parentData->primary_education : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Ocupation','name' => 'primary_ocupdation','value' => isset($parentData) ? $parentData->primary_ocupation : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group required">
                    <label for="status">Relationship to the student</label>
                    <select class="selectpicker form-control" name="primary_relation" required>
                        <option value="">Select Relation</option>
                        <option value="1" {{isset($parentData) && $parentData->primary_relation == 1 ? "selected" : '' }}>Father</option>
                        <option value="2" {{isset($parentData) && $parentData->primary_relation == 2 ? "selected" : '' }}>Giardian</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 divide-line"></div>

            <div class="col-md-12">
            <h4>Person 2</h4>
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Name', 'name' => 'secondary_name', 'value' => isset($parentData) ? $parentData->secondary_name : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Phone Number','name' => 'secondary_phone_number', 'value' => isset($parentData) ? $parentData->secondary_phone : ""])
            </div>
            <div class="col-md-4">
                @include('components.mobileNumber',['title' => 'Alternamte Phone Number ','name' => 'secondary_alt_phone_number', 'value' => isset($parentData) ? $parentData->secondary_alt_phone : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Email','name' => 'secondary_email', 'type' => 'email', 'value' => isset($parentData) ? $parentData->secondary_email : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Education','name' => 'secondary_education','value' => isset($parentData) ? $parentData->secondary_education : ""])
            </div>
            <div class="col-md-4">
                @include('components.textInput',['title' => 'Ocupation','name' => 'secondary_ocupation','value' => isset($parentData) ? $parentData->secondary_ocupation : ""])
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Relationship to the student</label>
                    <select class="selectpicker form-control" name="secondaty_relation">
                        <option value="">Select Relation</option>
                        <option value="1" {{isset($parentData) && $parentData->secondary_relation == 1 ? "selected" : '' }}>Father</option>
                        <option value="2" {{isset($parentData) && $parentData->secondary_relation == 2 ? "selected" : '' }}>Giardian</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-block">
        <h2>Address</h2>
        <div class="border rounded d-flex flex-wrap block-inner">

        <div class="col-md-4">
            @include('components.textInput',['name' => 'd_no','required' => false, 'title' => 'D.No', 'value' => isset($addressData) ? $addressData->d_no : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'street','title' => 'Street', 'value' => isset($addressData) ? $addressData->street : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'city','title' => 'City', 'value' => isset($addressData) ? $addressData->city : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'district','title' => 'District', 'value' => isset($addressData) ? $addressData->district : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'state','title' => 'State', 'value' => isset($addressData) ? $addressData->state : ""])
        </div>
        <div class="col-md-4">
            @include('components.textInput',['name' => 'pincode','title' => 'Pincode', 'value' => isset($addressData) ? $addressData->pincode : ""])
        </div>
    </div>
</div>

<div class="form-block pb-5">
    <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Add' }}</button>
</div>
</form>
</div>
<script>
    $(document).ready(function() {
        // Event listener for select element
        $('#class').on('change', function() {
            var selectedOption = $(this).val();

            // Send Ajax request to get updated options
            $.ajax({
                url: '{{ route("schooladmin.sections.by.class") }}',
                type: 'GET',
                data: { selectedOption: selectedOption },
                dataType: 'json',
                success: function(response) {
                    $('#tution_fee').val(response.classFee);
                    // Clear current options
                    $('#section').empty();

                    // Add new options
                    $('#section').append($('<option>', {
                        value: '',
                        text: '-- Select an option --'
                    }));
                    $.each(response.options, function(key, value) {
                        $('#section').append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                }
            });
        });
    });
    </script>
@include('components.ajaxFormSubmit',['formId' => 'addOrEditStudent'])
@endsection
