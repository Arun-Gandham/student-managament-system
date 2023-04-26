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
    </style>
    <div class="row">
        <div class="col-md-3">
            <div class="form-block">
                <h2>Periods Management</h2>
                <form action="{{ isset($formData) ? route('schooladmin.time-table.addPeriod.submit',["id" => $formData->id]) : route('schooladmin.time-table.addPeriod.submit') }}" method="POST" id="getSudents"
                    name="getSudents">
                    @csrf
                    <div class="border rounded  block-inner mb-5">
                        @include('components.textInput', [
                            'title' => 'Period Name',
                            'name' => 'period_name',
                            'required' => true,
                            'value' => isset($formData) ? $formData->period_name : '',
                        ])
                        <div class="">
                            <div class="form-group required">
                                <label for="status">From</label>
                                <input class="form-control" type="time" value="{{ isset($formData) ? $formData->from : '' }}" name="from"
                                    id="from" required>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group required">
                                <label for="status">To</label>
                                <input class="form-control" type="time" value="{{ isset($formData) ? $formData->to : '' }}" name="to"
                                    id="to" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            @if (!count($periods))
                <h3>No periods</h3>
            @else
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Period Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periods as $period)
                            <tr>
                                <td>{{ $period->period_name }}</td>
                                <td>{{ $period->from }}</td>
                                <td>{{ $period->to }}</td>
                                <td>
                                    <a href="{{route('schooladmin.time-table.edit',["id" => $period->id])}}" class="btn btn-xs btn-info"><img src="{{asset("svg/edit.svg")}}" atl="edit"></a>
                                            <form method="POST" action="" style="display:inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="{{asset("svg/trash.svg")}}" atl="delete"></button>
                                            </form>
                                        </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @endif
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable({
                autoWidth: false,
                processing: true,
                "order": [],
                buttons: [{
                        "extend": "pdf",
                        "text": "PDF",
                        "filename": "my_table",
                        "titleAttr": "Export to PDF",
                        "className": 'export_btn',
                        exportOptions: {
                            columns: [0, 1]
                        },

                    },
                    {
                        "extend": "print",
                        "text": "Print",
                        "titleAttr": "Print table",
                        "className": 'export_btn',
                        exportOptions: {
                            columns: [0, 1]
                        },
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'My Excel Document',
                        exportOptions: {
                            columns: [0, 1]
                        },
                        "className": 'export_btn'
                    }
                ],
                dom: '<"top"B>rt<"bottom"><"clear">',

            });
        });
    </script>
@endsection
