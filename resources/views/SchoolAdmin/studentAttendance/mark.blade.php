@extends('SchoolAdmin.layouts.main')
@section('title', 'School List')
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

        .green-row {
            background-color: #90EE90 !important;
        }

        .red-row {
            background-color: #FFCCCB !important;
        }
        .yellow-row {
            background-color: #FFFFE0 !important;
        }
    </style>
    <div class="row">
        <div class="col-md-3">
            <div class="form-block">
                <h2>Basic Information</h2>
                <form action="" method="POST" id="getSudents" name="getSudents">
                    @csrf
                    <div class="border rounded  block-inner mb-5">
                        <div class="">
                            <div class="form-group required">
                                <label for="status">Class</label>
                                <select class="selectpicker form-control" id="class" name="class" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group required">
                                <label for="status">Section</label>
                                <select class="selectpicker form-control" id="section" name="section" required>
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group required">
                                <label for="status">Date</label>
                                <input class="form-control" type="date" value="{{ date('Y-m-d') }}" name="date"
                                    id="date" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-success">Get</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-success" onclick='$("#update_attendance").submit();'>Update
                            Attendance</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <form method="post" name="update_attendance" id="update_attendance">
                @csrf
                <table id="myTable" class="display">
                    <thead>
                    </thead>
                    <tbody id="students-body">
                    </tbody>
                </table>
                <input type="hidden" name="selected_date" id="selected_date">
            </form>

        </div>
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

            $('#getSudents').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('schooladmin.attendance.sections.by.class.for.attendance') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#loader').removeClass('hide');
                    },
                    success: function(data) {
                        $('#selected_date').val($('#date').val());
                        if ($.fn.DataTable.isDataTable('#myTable')) {
                            $('#myTable').DataTable()
                                .destroy();
                        }
                        $('#myTable').DataTable({
                            paging: false,
                            "createdRow": function(row, data) {
                                if (data.attendance != '0') {
                                    if (data.attendance == '4') {
                                        $(row).addClass('yellow-row');
                                    }
                                    else if (data.attendance != '2') {
                                        $(row).addClass('green-row');
                                    }
                                    else {
                                        $(row).addClass('red-row');
                                    }
                                }
                            },
                            data: data.data,
                            "order": [
                                [0, 'asc']
                            ],
                            columns: [{
                                    data: 'roll_no',
                                    name: 'roll_no',
                                    title: 'Roll No.',
                                    className: 'text-capitalize'
                                },
                                {
                                    data: 'name',
                                    name: 'name',
                                    title: 'Name',
                                    className: 'text-capitalize'
                                },
                                {
                                    data: 'actions',
                                    name: 'actions',
                                    title: 'Action'
                                }

                            ]
                        });
                    },
                    complete: function(data) {
                        $('#loader').addClass('hide');
                    }
                });
            });
        });

        $('#update_attendance').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('schooladmin.attendance.bulk.update') }}",
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#loader').removeClass('hide');
                },
                success: function(data) {
                    $('#getSudents').submit();
                    toastr.success("Success");
                },
                error: function(response, textStatus, errorThrown) {
                    if (response.status == 404) {
                        toastr.error(
                            "Requested action not available<br><small>Please contact adminstrator</small>"
                        );
                    } else if (response.status == 500) {
                        toastr.error(
                            "Internal server error<br><small>Please try again after sometime</small>"
                        );
                    } else if (response.status == 400) {
                        toastr.error(response.responseJSON.error);
                    } else {
                        toastr.error(
                            "Something went wrong<br><small>Please contact adminstrator</small>");
                    }
                },
                complete: function(data) {
                    $('#loader').addClass('hide');
                }
            });
        });
    </script>
@endsection
