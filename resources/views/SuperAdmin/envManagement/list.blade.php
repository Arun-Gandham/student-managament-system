@extends('superAdmin.layouts.main')
@section('title','Modules List')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
<style>
  .dataTables_wrapper .dataTables_filter { float: left; margin-right: 20px; }
  .dataTables_wrapper .dt-buttons { float: right; }
  .dataTables_wrapper .dt-buttons .export_btn{ background-color: #33C5FF; color:white; font-size:12px;border-radius: 9px; }
  .dataTables_wrapper .dt-buttons .export_btn:hover{ background-color: #00B6FF;  font-size:12.5px; transition: 0.3s ease;}
  .dataTables_wrapper .dataTables_filter label{ color: black !important;  font-size:14px; }
  .dataTables_wrapper .dataTables_filter input{ border: 1px solid black; border-radius: 9px; }
  .dataTables_wrapper .dataTables_paginate span a {  }
  .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{ background: none !important; color :#00B6FF !important; border: none;}
  .dataTables_wrapper .dataTables_paginate .paginate_button{ background: none !important; border: none;}
  .dataTables_wrapper .dataTables_paginate .paginate_button:hover{ color:#00B6FF !important;background: none !important;border: none!important;}
  .dataTables_wrapper table.dataTable.no-footer { border:2px solid #ddd !important; border-radius: 9px; padding-bottom: 5px;margin-bottom: 10px;}
  </style>
<table id="myTable" class="display">
    <thead>
    </thead>
    <tbody>
    </tbody>
</table>

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
            serverSide: true,
            ajax: "{!! route('superadmin.subdomain.list.datatable') !!}",
            columns: [
                {
                    "title": "S.No",
                    "data": null,
                    "orderable": false,
                    "className": "indexColumn",
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'subdomain', name: 'subdomain',  title: 'Subdomain', className: 'text-capitalize'},
                { data: 'strong_id', name: 'strong_id', title: 'Strong Id'},
                { data: 'status', name: 'status', title: 'Status'},
                { data: 'actions', name: 'Action', title: 'Action'}
            ],
            "order": [],
            select: {
                style: 'multi',
                 selector: 'td:not(:last-child)'
            },
            // dom: 'lBfrtip',
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
                    {
                        text: '<i class="fa fa-plus" aria-hidden="true"></i> New SUbdomain',
                        "className": 'export_btn',
                        action: function ( e, dt, node, config ) {
                            window.location.replace("{{ route('superadmin.subdomain.add') }}");
                        }
                    },
                  {
                    "extend": "pdf",
                    "text": "PDF",
                    "filename": "my_table",
                    "titleAttr": "Export to PDF",
                    "className": 'export_btn',
                    exportOptions: {
                        columns: [ 0, 1]
                    },

                  },
                  {
                        "extend": "print",
                        "text": "Print",
                        "titleAttr": "Print table",
                        "className": 'export_btn',
                        exportOptions: {
                            columns: [ 0, 1]
                        },
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'My Excel Document',
                        exportOptions: {
                        columns: [ 0, 1]
                        },
                        "className": 'export_btn'
                    }
            ],
            dom: '<"top"Bfrt>rt<"bottom"lp>i<"clear">',
            language: {
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>', // right arrow icon
                    previous: '<i class="fas fa-chevron-left"></i>' // left arrow icon
                }
            },
        });
    });
</script>
@endsection
