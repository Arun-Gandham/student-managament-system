@extends('SchoolAdmin.layouts.main')
@section('title', 'Update Results')
@section('content')
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
    <form method="post" action="{{ route('schooladmin.exams.result.update.submit', ['id' => $examDetails->id]) }}"
        id="updateExamResults" name="updateExamResults" class="updateExamResults">
        @csrf
        <input type="hidden" value="{{ $examDetails->id }}" name="exam_id">
        <table class="table border display" id="resultUpdateTable">
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }} {{ $student->sur_name }}</td>
                        <td>
                            <div class="d-none">{{ isset($student->marks) ? $student->marks : 0 }}</div>
                            <input class="form-control" type="hidden" value="{{ $student->id }}" name="student_id[]">
                            <input type="number" name="marks[]" value="{{ isset($student->marks) ? $student->marks : 0 }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="form-block pb-5">
            <button type="submit" class="btn btn-primary float-right">Update</button>
        </div>
    </form>
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
            $('#resultUpdateTable').DataTable({
                processing: false,
                serverSide: false,
                paginate: false,
                "order": [],
                select: {
                    style: 'multi',
                    selector: 'td:not(:last-child)'
                },
                buttons: [{
                        "extend": "pdf",
                        "text": "PDF",
                        "filename": "{{$examDetails->name}} Results",
                        "title": "{{$examDetails->name}} Results",
                        "className": 'export_btn',
                        exportOptions: {
                            columns: [0, 1, 2]
                        },

                    },
                    {
                        "extend": "print",
                        "text": "Print",
                        "title": "{{$examDetails->name}} Results",
                        "className": 'export_btn',
                        exportOptions: {
                            columns: [0, 1, 2]
                        },
                    },
                    {
                        extend: 'excelHtml5',
                        "title": "{{$examDetails->name}} Results",
                        exportOptions: {
                            columns: [0, 1, 2]
                        },
                        "className": 'export_btn'
                    }
                ],
                dom: '<"top"Bfrt>rt<"bottom"lp>i<"clear">',
            });
        });
    </script>
    @include('components.ajaxFormSubmit', ['formId' => 'updateExamResults'])
@endsection
