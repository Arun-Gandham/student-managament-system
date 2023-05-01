@extends('SchoolAdmin.layouts.main')
@section('title', isset($formData) ? 'Edit Class' : 'Add Class')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
            action="{{ isset($formData) ? route('schooladmin.class-sections.class.edit.submit', $formData->id) : route('schooladmin.class-sections.class.add.submit') }}"
            method="POST" class="addOrEditClass" id="addOrEditClass" name="addOrEditClass" enctype="multipart/form-data"
            novalidate>
            <div class="form-block">
                <h2>{{ isset($formData) ? 'Edit' : 'Add' }} Class</h2>
                <div class="border rounded d-flex flex-wrap block-inner">
                    <div class="col-md-3">
                        <div class="col-md-12">
                            @include('components.textInput', [
                                'name' => 'name',
                                'title' => 'Class Name',
                                'required' => true,
                                'value' => isset($formData) ? $formData->name : '',
                            ])
                        </div>
                        <div class="col-md-12">
                            @include('components.textInput', [
                                'name' => 'tution_fee',
                                'title' => 'Tution Fee',
                                'type' => 'number',
                                'required' => true,
                                'value' => isset($formData) ? $formData->tution_fee : '',
                            ])
                        </div>
                    </div>
                    <div class="col-md-9 ">
                        <div class="row sections-block" id="sections-block">
                            @if (isset($formData) && count($formData->classSectionMapping))
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($formData->classSectionMapping as $eachSection)
                                    <div class="{{ $count ? '' : 'get-this-block' }} row delete-block">
                                        @php $count++; @endphp
                                        <div class="col-md-4">
                                            <div class="form-group required">
                                                <label for="status">Section</label>
                                                <select class=" form-control sections" name="section[]">
                                                    <option value="0">Select Section</option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}"
                                                            {{ isset($eachSection) && $eachSection->section_id == $section->id ? 'selected' : '' }}>
                                                            {{ $section->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group required">
                                                <label for="status">Class Teacher</label>
                                                <select class=" form-control sections" name="teacher[]">
                                                    <option value="0">Select Teacher</option>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}"
                                                            {{ isset($teacher) && $teacher->id == $eachSection->class_teacher_id ? 'selected' : '' }}>
                                                            {{ $teacher->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            @include('components.textInput', [
                                                'type' => 'number',
                                                'name' => 'max_strength[]',
                                                'title' => 'Max Strength',
                                                'required' => true,
                                                'value' => isset($eachSection) ? $eachSection->max_strength : '',
                                            ])
                                        </div>
                                        <div class="col-md-1">
                                            <a class="btn btn-danger delete" role="button" aria-disabled="true">Delete</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="get-this-block row delete-block">
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="status">Section</label>
                                            <select class=" form-control sections" name="section[]">
                                                <option value="0">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="status">Class Teacher</label>
                                            <select class=" form-control sections" name="teacher[]">
                                                <option value="0">Select Teacher</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @include('components.textInput', [
                                            'type' => 'number',
                                            'name' => 'max_strength[]',
                                            'title' => 'Max Strength',
                                            'required' => true,
                                            'value' => isset($formData) ? $formData->name : '',
                                        ])
                                    </div>
                                    <div class="col-md-1">
                                        <a class="btn btn-danger delete" role="button" aria-disabled="true">Delete</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <a class="btn btn-success" id="add" role="button">Add Section</a>
                        </div>
                    </div>
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
            // $('.delete').first().css('display', 'none');

            // Add field
            $('#add').click(function() {
                var $html = $('.get-this-block').clone(true);
                $html.removeClass('get-this-block'); // Remove the class used for cloning
                $html.find('.section-title').val('');
                $('#sections-block').append($html);


                var $select = $('#data-select');
                var value = $select.val();
                $select.data('value', value);
                var $clone = $select.clone();
                var $clonedSelect = $clone.find('#data-select');
                $clonedSelect.val($select.data('value'));
                $('#sections-block').append($clone);

            });

            // Delete field
            $('#sections-block').on('click', '.delete', function() {
                $(this).closest('.delete-block').remove();
            });

        });
    </script>
    @include('components.ajaxFormSubmit', ['formId' => 'addOrEditClass'])
@endsection
