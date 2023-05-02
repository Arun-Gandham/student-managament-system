@extends('SchoolAdmin.layouts.main')
@section('title', 'Schedule exam')
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
            action="{{ isset($formData) ? route('schooladmin.exams.schedule.submit', $formData->id) : route('schooladmin.exams.schedule.submit') }}"
            method="POST" class="scheduleExam" id="scheduleExam" name="scheduleExam">
            <div class="form-block">
                @if (isset($formData))
                    <div class="form-block pb-5">
                        <a href="{{ route('schooladmin.exams.result.update', ['id' => $formData->id]) }}"
                            class="btn btn-danger float-right">update result</a>
                    </div>
                @endif
                <h3>Exam Details</h3>
                <div class="border rounded d-flex flex-wrap block-inner">
                    <div class="col-md-4 ">
                        <div class="form-group required">
                            <label for="">Exam Mode</label>
                            <select class="selectpicker form-control" name="mode">
                                <option {{ isset($formData) && 1 == $formData->mode ? 'selected' : '' }} value="1">
                                    Offline</option>
                                <option {{ isset($formData) && 0 == $formData->mode ? 'selected' : '' }} value="0">
                                    Online</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="status">Class</label>
                            <select class="selectpicker form-control" id="class" name="class" required>
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option {{ isset($formData) && $class->id == $formData->class_id ? 'selected' : '' }}
                                        value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label for="status">Section</label>
                            <select class="selectpicker form-control" id="section" name="section" required>
                                @if (isset($sections) && count($sections))
                                    @foreach ($sections as $section)
                                        <option {{ $formData->section_id == $section->id ? 'selected' : '' }}
                                            value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @include('components.textInput', [
                            'name' => 'exam_name',
                            'title' => 'Exam Name',
                            'required' => true,
                            'value' => isset($formData) ? $formData->name : '',
                        ])
                    </div>

                    <div class="col-md-4">
                        @include('components.textInput', [
                            'name' => 'start_date',
                            'title' => 'Start Date & Time',
                            'required' => true,
                            'type' => 'datetime-local',
                            'value' => isset($formData) ? $formData->start_date : '',
                        ])
                    </div>
                    <div class="col-md-4">
                        @include('components.textInput', [
                            'name' => 'end_date',
                            'title' => 'End Date & Time',
                            'required' => true,
                            'type' => 'datetime-local',
                            'value' => isset($formData) ? $formData->end_date : '',
                        ])
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group required">
                            <label for="">Show to students</label>
                            <select class="selectpicker form-control" name="student_show">
                                <option {{ isset($formData) && '1' == $formData->status ? 'selected' : '' }}
                                    value="1">
                                    Show</option>
                                <option {{ isset($formData) && '0' == $formData->status ? 'selected' : '' }}
                                    value="0">
                                    Don't Show</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group required">
                            <label for="">Results Release</label>
                            <select class="selectpicker form-control" name="result_released">
                                <option {{ isset($formData) && '0' == $formData->result_released ? 'selected' : '' }}
                                    value="0">
                                    No</option>
                                <option {{ isset($formData) && '1' == $formData->result_released ? 'selected' : '' }}
                                    value="1">
                                    Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @include('components.textInput', [
                            'name' => 'total_marks',
                            'title' => 'Total Marks',
                            'required' => true,
                            'type' => 'number',
                            'value' => isset($formData) ? $formData->total_marks : '',
                        ])
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group required">
                            <label for="">Topics</label>
                            <textarea class="form-control" id="topics" name="topics" rows="3" required>{{ isset($formData) ? $formData->topics : '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="form-block pb-5">
        <button type="submit" class="btn btn-primary float-right">{{ isset($formData) ? 'Update' : 'Save' }}</button>
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
                    url: '{{ route('schooladmin.attendance.sections.by.class') }}',
                    type: 'GET',
                    data: {
                        selectedOption: selectedOption
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('#loader').removeClass('hide');
                    },
                    success: function(response) {
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
                    },
                    complete: function(data) {
                        $('#loader').addClass('hide');
                    }
                });
            });
        });
    </script>
    @include('components.ajaxFormSubmit', ['formId' => 'scheduleExam'])
@endsection
