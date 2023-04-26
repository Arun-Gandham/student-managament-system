@extends('SchoolAdmin.layouts.main')
@section('title', 'TIme Table')
@section('content')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
    <style>
        .dataTables_wrapper .dataTables_filter {
            float: left;
            margin-right: 20px;
        }

        .dataTables_wrapper .dt-buttons {
            float: right;
        }

        .dataTables_wrapper .dt-buttons .export_btn {
            background-color: #33C5FF;
            color: white;
            font-size: 12px;
            border-radius: 9px;
        }

        .dataTables_wrapper .dt-buttons .export_btn:hover {
            background-color: #00B6FF;
            font-size: 12.5px;
            transition: 0.3s ease;
        }

        .dataTables_wrapper .dataTables_filter label {
            color: black !important;
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid black;
            border-radius: 9px;
        }

        .dataTables_wrapper .dataTables_paginate span a {}

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: none !important;
            color: #00B6FF !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: none !important;
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #00B6FF !important;
            background: none !important;
            border: none !important;
        }

        .dataTables_wrapper table.dataTable.no-footer {
            border: 2px solid #ddd !important;
            border-radius: 9px;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .form-select:focus {
            outline: none;
            border-color: green;
            box-shadow: 0 0 0 0.25rem rgba(104, 243, 102, 0.25);
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="form-block">
                <h2>Basic Information</h2>
                <form action="" method="POST" id="getPeridos" name="getPeridos">
                    @csrf
                    <div class="border rounded  block-inner mb-5 row">
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label for="status">Class</label>
                                <select class="selectpicker form-control" id="class" name="class" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option {{ request()->route("class") !== null && request()->route("class") == $class->id ? 'selected' : ''}} value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label for="status">Section</label>
                                <select class="selectpicker form-control" id="section" name="section" required>
                                    @if (count($sections))
                                        @foreach ($sections as $section)
                                            <option {{ request()->route("section") !== null && request()->route("section") == $section->id ? 'selected' : ''}} value="{{$section->id}}">{{$section->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-success">Get</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        @if ($showTable)
            <div class="col-md-12 overflow-auto w-100">
                <form method="post" action="{{ route('schooladmin.time-table.submitTimeTable') }}" name="update_timetable"
                    id="update_timetable">
                    @csrf
                    <table class="table table-bordered" style="min-width:130%">
                        <thead class="w-100">
                            <tr>
                                <th scope="col">Day</th>
                                @foreach ($periods as $period)
                                    <th>{{ $period->period_name }}<br>{{ $period->from }}<br>{{ $period->to }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($days as $day)
                                <tr>
                                    <td>{{ $day->name }}</td>
                                    @foreach ($periods as $period)
                                        <td>
                                            {{-- isset($finalTimeTable->{$day->id}->{$period->id}) && $finalTimeTable->{$day->id}->{$period->id}->staff_id == $user->id --}}
                                            <input type="hidden" name="period_id[]" value="{{ $period->id }}">
                                            <input type="hidden" name="day_id[]" value="{{ $day->id }}">
                                            <select class="form-select mb-2" name="staff_id[]">
                                                <option value="">Select Teacher</option>
                                                @foreach ($staff as $user)
                                                    @php
                                                        $checkStaff = '';
                                                        if (isset($finalTimeTable[$day->id])) {
                                                            foreach ($finalTimeTable[$day->id] as $eachDay => $timetable) {
                                                                if ($eachDay == $period->id && $timetable->staff_id == $user->id) {
                                                                    $checkStaff = 'selected';
                                                                }
                                                            }
                                                        }

                                                    @endphp
                                                    <option {{ $checkStaff }} value="{{ $user->id }}">
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <select class="form-select" name="subject_id[]">
                                                <option value="" style="color: red;">Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    @php
                                                        $checkSubject = '';
                                                        if (isset($finalTimeTable[$day->id])) {
                                                            foreach ($finalTimeTable[$day->id] as $eachDay => $timetable) {
                                                                if ($eachDay == $period->id && $timetable->subject_id == $subject->id) {
                                                                    $checkSubject = 'selected';
                                                                }
                                                            }
                                                        }

                                                    @endphp
                                                    <option {{ $checkSubject }} value="{{ $subject->id }}">
                                                        {{ $subject->subject_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-3">
                        <div class="form-group">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <input type="hidden" name="class_id"
                        value="{{ request()->route('class') != null ? request()->route('class') : 0 }}">
                    <input type="hidden" name="section_id"
                        value="{{ request()->route('section') != null ? request()->route('section') : 0 }}">
                </form>
            </div>
        @endif
    </div>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> -->

    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <script>
        $(document).ready(function() {
            const mySelects = document.querySelectorAll('select[name="staff_id[]"]');

            mySelects.forEach(function(mySelect) {
                if (mySelect.value === '') {
                    mySelect.classList.add('is-invalid');
                }
                mySelect.addEventListener('change', function() {
                    if (this.value !== '') {
                        this.classList.remove('is-invalid');
                    }
                    else
                    {
                        this.classList.add('is-invalid');
                    }
                });
            });
            const subjectCheck = document.querySelectorAll('select[name="subject_id[]"]');

            subjectCheck.forEach(function(mySelect) {
                if (mySelect.value === '') {
                    mySelect.classList.add('is-invalid');
                }
                mySelect.addEventListener('change', function() {
                    if (this.value !== '') {
                        this.classList.remove('is-invalid');
                    }
                    else
                    {
                        this.classList.add('is-invalid');
                    }
                });
            });

            // Get sections by class
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

            $('#getPeridos').submit(function(event) {
                event.preventDefault();
                window.location = "{{ route('schooladmin.time-table.timeTableManage', '') }}" + "/" + this
                    .class.value + "/" + this.section.value;
            });
        });
    </script>
    @include('components.ajaxFormSubmit', ['formId' => 'update_timetable'])
@endsection
