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
                <h2>Fee Types</h2>
                <form
                    action="{{ isset($formData) ? route('schooladmin.fee.type.submit', ['id' => $formData->id]) : route('schooladmin.fee.type.submit') }}"
                    method="POST">
                    @csrf
                    <div class="border rounded  block-inner mb-5">
                        @include('components.textInput', [
                            'title' => 'Fee Type Name',
                            'name' => 'name',
                            'required' => true,
                            'value' => isset($formData) ? $formData->name : '',
                        ])
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
            @if (!count($feeTypes))
                <h3>No Fee Types</h3>
            @else
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Fee Type Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feeTypes as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td>
                                    @if($type->school_id != 0)
                                    <a href="{{ route('schooladmin.fee.type.edit', ['id' => $type->id]) }}" class="btn btn-xs btn-info"><img src="{{ asset('svg/edit.svg') }}" atl="edit"></a>
                                    <form method="POST" action="" style="display:inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="{{ asset('svg/trash.svg') }}" atl="delete"></button>
                                    </form>
                                    @endif
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
                buttons: [
                ],
                dom: '<"top"B>rt<"bottom"><"clear">',

            });
        });
    </script>
@endsection
