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
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="form-block">
                <h2>Basic Information</h2>
                <form action="" method="POST" id="getTimeTable" name="getTimeTable">
                    @csrf
                    <div class="border rounded  block-inner mb-5 row">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group required">
                                <label for="status">Section</label>
                                <select class="selectpicker form-control" id="section" name="section" required>
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
        <div class="col-md-12">
            <form method="post" name="update_attendance" id="update_attendance">
                @csrf
                <table id="myTable" class="display table-bordered">
                    <thead>

                    </thead>
                    <tbody id="students-body">

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

            $('#getTimeTable').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('schooladmin.time-table.getTimeTable') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#loader').removeClass('hide');
                    },
                    success: function(data) {
                        // $('#myTable').append('<caption style="caption-side: bottom">A fictional company\'s staff table.</caption>');
                        $('#selected_date').val($('#date').val());
                        if ($.fn.DataTable.isDataTable('#myTable')) {
                            $('#myTable').DataTable()
                                .destroy();
                        }

                        // Generate the column definitions dynamically based on the keys in the data objects
                        var columns = Object.keys(data.data[0]).map(function(key) {
                            return {
                                title: key.charAt(0).toUpperCase() + key.slice(1),
                                data: key
                            };
                        });
                        $('#myTable').DataTable({
                            paging: false,
                            ordering: false, // add this line to remove sorting
                            select: {
                                style: 'multi',
                                selector: 'td:not(:last-child)'
                            },
                            dom: '<"top"B>rt<"bottom"><"clear">',
                            data: data.data,
                            columns: columns,
                            buttons: [{
                                    text: '<i class="fa fa-plus" aria-hidden="true"></i> Edit',
                                    "className": 'export_btn',
                                    action: function(e, dt, node, config) {
                                        window.location.replace(
                                            "{{ route('schooladmin.time-table.timeTableManage', '') }}" + "/" + data.class + "/" + data.section
                                            );
                                    }
                                }, {
                                    "extend": "print",
                                    "text": "Print",
                                    title: data.title,
                                    "titleAttr": "Print table",
                                    "className": 'export_btn',
                                },
                                {
                                    extend: 'excelHtml5',
                                    title: data.title,
                                    "className": 'export_btn'
                                }
                            ],
                        });
                        $('#myTable').css('text-align', 'center');
                    },
                    complete: function(data) {
                        $('#loader').addClass('hide');
                    }
                });
            });
        });
    </script>
@endsection
