@extends('SchoolAdmin.layouts.main')
@section('title', isset($formData) ? 'Edit Section' : 'Add Section')
@section('content')
    <style>
        .form-block {
            margin-top: 20px;
        }

        .block-inner {
            padding: 15px 0px;
        }

        .SchoolImagePreview {
            padding: 0px;
            margin: 0px;
        }
    </style>
    <div class="create-main-outer pb-5">
        <form
            action="{{ isset($formData) ? route('schooladmin.class-sections.section.edit.submit', $formData->id) : route('schooladmin.class-sections.section.add.submit') }}"
            method="POST" class="addOrEditSection" id="addOrEditSection" name="addOrEditSection" enctype="multipart/form-data"
            novalidate>
            <div class="form-block">
                <h2>{{ isset($formData) ? 'Edit' : 'Add' }} Section</h2>
                <div class="border rounded d-flex flex-wrap block-inner">
                    <div class="col-md-4">
                        @include('components.textInput', [
                            'name' => 'name',
                            'title' => 'Section Name',
                            'required' => true,
                            'value' => isset($formData) ? $formData->name : '',
                        ])
                    </div>
                </div>
            </div>
    </div>

    <div class="form-block pb-5">
        <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Add' }}</button>
    </div>
    </form>
    </div>
    @include('components.ajaxFormSubmit', ['formId' => 'addOrEditSection'])
@endsection
