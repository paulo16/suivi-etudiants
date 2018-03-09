@extends('admin.layouts.default')

@section('head')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="{{asset('assets/admin/images/favicon_1.ico')}}">
<title>Admin dash</title>
<link href="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet"
type="text/css"/>
<link href="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.colVis.css') }}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet"
type="text/css"/>
<link href="{{asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet"
type="text/css"/>
@endsection

@section('content')

@section('title_content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="header-title m-t-0 m-b-30">Liste des Filières</h4>
            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-30">
                        <a id="add-etudiant" role="button" href="{{route('filieres.create')}}" class="btn btn-primary waves-effect waves-light">
                          AJOUTER UNE FILIERE <i class="fa fa-plus"></i>
                      </a>
                  </div>
              </div>
          </div>

          <table id="filiere-table" class="table table-striped table-bordered dt-responsive nowrap"
          cellspacing="0"
          width="100%">
          <thead>
            <tr>
                <th>{{ Lang::get('contenu.filiere_nom')}}</th>
                <th>{{ Lang::get('contenu.filiere_description')}}</th>
                <th>{{ Lang::get('contenu.action')}}</th>
            </tr>
        </thead>
    </table>

</div>
</div><!-- end col -->
</div>
<!-- end row -->
@endsection

@stop

@section('js')
<!-- Datatables-->
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.buttons.min.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap.min.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/pdfmake.min.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/vfs_fonts.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.responsive.min.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/buttons.html5.min.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.colVis.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/buttons.print.min.js') }}">
</script>
<script src="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap.min.js') }}">
</script>
<script>
    $(document).ready(function () {
        var table = $('#filiere-table')
        .DataTable({
            "oLanguage": {
                "sProcessing": "{{ Lang::get('datatable.sProcessing') }}",
                "sSearch": "{{ Lang::get('datatable.sSearch') }}",
                "sLengthMenu": "{{ Lang::get('datatable.sLengthMenu') }}",
                "sInfo": "{{ Lang::get('datatable.sInfo') }}",
                "sInfoEmpty": "{{ Lang::get('datatable.sInfoEmpty') }}",
                "sInfoFiltered": "{{ Lang::get('datatable.sInfoFiltered') }}",
                "sInfoPostFix": "{{ Lang::get('datatable.sInfoPostFix') }}",
                "sLoadingRecords": "{{ Lang::get('datatable.sLoadingRecords') }}",
                "sZeroRecords": "{{ Lang::get('datatable.sZeroRecords') }}",
                "sEmptyTable": "{{ Lang::get('datatable.sEmptyTable') }}",
                "oPaginate": {
                    "sFirst": "{{ Lang::get('datatable.sFirst') }}",
                    "sPrevious": "{{ Lang::get('datatable.sPrevious') }}",
                    "sNext": "{{ Lang::get('datatable.sNext') }}",
                    "sLast": "{{ Lang::get('datatable.sLast') }}"
                },
                "oAria": {
                    "sSortAscending": "{{ Lang::get('datatable.sSortAscending') }}",
                    "sSortDescending": "{{ Lang::get('datatable.sSortDescending') }}"
                }
            },
            order: [[ 0, "desc" ]],
            pageLength: 6,
            lengthMenu: [
            [6, 30, 50, 1000],
            [6, 30, 50, "tous"]
            ],
            processing: true,
            serverSide: true,
            ajax: '{!! route('filieres.data') !!}',
            data: {_token: '{{ csrf_token() }}'},
            dom: '<"top"B><fl><"bottom"rtip><"clear">',
            "buttons": [
            {
                extend: "pdfHtml5",
                title: "Application ASECAM liste des filieres",
                exportOptions: {
                    columns: [0,1,]
                }
            },
            {
                extend: "csvHtml5",
                title: "Application ASECAM liste des filieres",
                exportOptions: {
                    columns: [0, 1,]
                }
            },
            {
                extend: "print",
                title: "Application ASECAM liste des filieres",
                text: "imprimer",
                exportOptions: {
                    columns: [0, 1,]
                }
            },
            ],
            columns: [
            {data: 'nom', name: 'nom'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action'},
            ],

        });

            //////////////////// Delete Etablissement ///////////////////////////////////

            $(document).on('click', '.delete', function () {
                var id = $(this).data('id');
                var swal_ot = {
                    title: "{{Lang::get('contenu.sure')}}",
                    text: "{{Lang::get('contenu.subtext_sure')}}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "{{Lang::get('contenu.confirm_btn')}}",
                    cancelButtonText: "{{Lang::get('contenu.cancel_btn')}}",
                    closeOnConfirm: false
                };
                var url = '{{ route("filieres.delete", ":id") }}';
                url = url.replace(':id', id);

                swal(swal_ot, function () {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {_token: '{{ csrf_token() }}'},
                    }).done(function (result) {

                     if(result==false){
                        swal("{{Lang::get('contenu.sup_imp')}}", "{{Lang::get('contenu.sub_sup_imp')}}");
                        table.ajax.reload(null, false);

                    }else{
                        swal("{{Lang::get('contenu.supprime')}}", "{{Lang::get('contenu.sub_sup')}}", "success");
                        table.ajax.reload(null, false);
                    }

                }).error(function () {
                    swal("{{Lang::get('contenu.oops')}}", "{{Lang::get('contenu.problem_server')}}", "error");
                });
            });
            });

        });
    </script>



    @endsection
