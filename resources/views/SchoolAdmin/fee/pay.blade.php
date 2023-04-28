@extends('SchoolAdmin.layouts.main')
@section('title', 'Fee Payment')
@section('content')
    @include('errors')
    <style>
        .form-block {
            margin-top: 20px;
        }

        .block-inner {
            padding: 15px 0px;
        }
    </style>
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
    <div class="create-main-outer pb-5">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="">
                <button class="nav-link me-1 active " data-bs-toggle="tab" data-bs-target="#pay_form" type="button"
                    role="tab" aria-controls="nav-home" aria-selected="true">Pay</button>
                <button class="nav-link me-1" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#payment_history"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">History</button>
            </div>
        </nav>
        <div class="tab-content mt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="pay_form" role="tabpanel" aria-labelledby="nav-home-tab">
                <form action="{{ route('schooladmin.fee.students.pay.submit') }}" method="POST" class="addOrEditStudent">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="form-block">
                        <h2>Payment Information</h2>
                        <div class="border rounded d-flex flex-wrap block-inner">
                            <div class="col-md-4">
                                <div class="form-group required">
                                    <label for="status">Fee Type</label>
                                    <select class="selectpicker form-control" id="fee_type" name="fee_type">
                                        <option value="">Select Fee Type</option>
                                        @foreach ($feeTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @include('components.textInput', [
                                    'title' => 'Fee Description',
                                    'name' => 'description',
                                ])
                            </div>

                            <div class="col-md-4">
                                <div class="form-group required">
                                    <label for="exampleInputEmail1">Payment Date</label>
                                    <input type="date" class="form-control" name="payment_date" id="payment_date"
                                        value='{{ date('Y-m-d') }}' required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @include('components.textInput', [
                                    'title' => 'Payment Amount',
                                    'type' => 'number',
                                    'name' => 'payment_amount',
                                ])
                            </div>
                            <div class="col-md-4">
                                <div class="form-group required">
                                    <label for="status">Payment Type</label>
                                    <select class="selectpicker form-control" id="payment_type" name="payment_type">
                                        <option value="">Select Fee Type</option>
                                        @foreach ($paymentTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-block pb-5">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="payment_history" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="form-group  col-md-3">
                    <label for="status">For Acadamic Year</label>
                    <select class="selectpicker form-control" onchange="getFeeHistory()" id="for_acadamic_year"
                        name="for_acadamic_year">
                        @foreach ($acadamicYears as $acadamicyear)
                            <option {{ $acadamicyear->id == $currentAcadamicYear ? 'selected' : '' }}
                                value="{{ $acadamicyear->id }}">{{ $acadamicyear->name }}</option>
                        @endforeach
                    </select>
                </div>
                <h2 class="text-center my-3">Tution Fee's paid</h2>
                <table id="tution_fee_table" class="display w-100 border rounded">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <h2 class="text-center my-3">Other Fee's paid</h2>
                <table id="other_fee_table" class="display w-100 border rounded">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
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
        getFeeHistory();

        function getFeeHistory($student, $academic_id) {
            $student = {{ $id }};
            $academic_id = document.getElementById('for_acadamic_year').value;
            if ($.fn.DataTable.isDataTable('#tution_fee_table')) {
                $('#tution_fee_table').DataTable()
                    .destroy();
            }
            if ($.fn.DataTable.isDataTable('#other_fee_table')) {
                $('#other_fee_table').DataTable()
                    .destroy();
            }
            $('#tution_fee_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('schooladmin.fee.student.payment.tutionFee.history') !!}" + "/" + $student + "/" + $academic_id,
                columns: [{
                        "title": "S.No",
                        "data": null,
                        "orderable": false,
                        "className": "indexColumn",
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'fee_type',
                        name: 'fee_type',
                        title: 'Fee Type',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        title: 'Description',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'fee_paid_date',
                        name: 'fee_paid_date',
                        title: 'Fee Paid Date',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type',
                        title: 'Payment Type',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'paid_to_staff',
                        name: 'paid_to_staff',
                        title: 'Payment Recived By',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'payment_amount',
                        name: 'payment_amount',
                        title: 'Amount Paid',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'print_recipt',
                        name: 'print_recipt',
                        title: 'Print Recipt',
                        className: 'text-capitalize'
                    }
                ],
                "order": [],
                buttons: [{
                        "extend": "pdf",
                        "text": "PDF",
                        "filename": "my_table",
                        "titleAttr": "Export to PDF",
                        "className": 'export_btn',
                        "footer": true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }

                    },
                    {
                        "extend": "print",
                        "text": "Print",
                        "titleAttr": "Print table",
                        "className": 'export_btn',
                        "footer": true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'My Excel Document',
                        "className": 'export_btn',
                        "footer": true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                ],
                dom: '<"top"Bf>rt<"bottom"><"clear">',
                language: {
                    paginate: {
                        next: '<i class="fas fa-chevron-right"></i>', // right arrow icon
                        previous: '<i class="fas fa-chevron-left"></i>' // left arrow icon
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // converting to interger to find total
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // computing column Total of the complete result
                    var monTotal = api
                        .column(6)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    $(api.column(5).footer()).html('Total :- ');
                    $(api.column(6).footer()).html(monTotal);
                }
            });

            $('#other_fee_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route('schooladmin.fee.student.payment.otherFee.history') !!}" + "/" + $student + "/" + $academic_id,
                columns: [{
                        "title": "S.No",
                        "data": null,
                        "orderable": false,
                        "className": "indexColumn",
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'fee_type',
                        name: 'fee_type',
                        title: 'Fee Type',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        title: 'Description',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'fee_paid_date',
                        name: 'fee_paid_date',
                        title: 'Fee Paid Date',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type',
                        title: 'Payment Type',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'paid_to_staff',
                        name: 'paid_to_staff',
                        title: 'Payment Recived By',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'payment_amount',
                        name: 'payment_amount',
                        title: 'Amount Paid',
                        className: 'text-capitalize'
                    },
                    {
                        data: 'print_recipt',
                        name: 'print_recipt',
                        title: 'Print Recipt',
                        className: 'text-capitalize'
                    }
                ],
                "order": [],
                buttons: [{
                        "extend": "pdf",
                        "text": "PDF",
                        "filename": "my_table",
                        "titleAttr": "Export to PDF",
                        "className": 'export_btn',
                        "footer": true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }

                    },
                    {
                        "extend": "print",
                        "text": "Print",
                        "titleAttr": "Print table",
                        "className": 'export_btn',
                        "footer": true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'My Excel Document',
                        "className": 'export_btn',
                        "footer": true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                ],
                dom: '<"top"Bf>rt<"bottom"><"clear">',
                language: {
                    paginate: {
                        next: '<i class="fas fa-chevron-right"></i>', // right arrow icon
                        previous: '<i class="fas fa-chevron-left"></i>' // left arrow icon
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    // converting to interger to find total
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    // computing column Total of the complete result
                    var monTotal = api
                        .column(6)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    $(api.column(5).footer()).html('Total :- ');
                    $(api.column(6).footer()).html(monTotal);
                },

            });
        }
    </script>
@endsection
