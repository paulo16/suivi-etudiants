@extends('admin.layouts.default')

@section('head')
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link href="{{ asset('assets/admin/images/favicon_1.ico') }}" rel="shortcut icon">
<title>
    Admin dash
</title>
<link href="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.colVis.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

@section('title_content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="header-title m-t-0 m-b-30">
                Liste des étudiants
            </h4>
            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-30">
                        <a id="add-un-etudiant" role="button" href="{{route('etudiants.create')}}" class="btn btn-primary waves-effect waves-light">
                          AJOUTER UN ETUDIANT <i class="fa fa-plus"></i>
                      </a>
                  </div>
              </div>
          </div>
          <table cellspacing="0" class="table table-hover" id="etudiants-table" width="100%">
            <thead>
                <tr>
                   <th>
                    {{ Lang::get('N°') }}
                </th>
                <th>
                    {{ Lang::get('contenu.etudiant_nom') }}
                </th>
                <th>
                    {{ Lang::get('contenu.etudiant_prenom') }}
                </th>
                <th>
                    {{ Lang::get('contenu.etudiant_genre') }}
                </th>
                <th>
                    {{ Lang::get('contenu.etudiant_promotion') }}
                </th>
                <th>
                    {{ Lang::get('contenu.evolution_ville') }}
                </th>
                <th>
                    {{ Lang::get('contenu.evolution_filiere') }}
                </th>
                <th>
                    {{ Lang::get('contenu.evolution_etablissement') }}
                </th>
                <th>
                    Situation
                </th>
                <th>
                    {{ Lang::get('contenu.etudiant_date_naissance') }}
                </th>
                <th>
                    {{ Lang::get('Télephone') }}
                </th>
                <th>
                    {{ Lang::get('Email') }}
                </th>
                <th>
                    {{ Lang::get('action') }}
                </th>
            </tr>
        </thead>
    </table>
</div>
</div>
<!-- end col -->
</div>
<!-- end row -->
<!-- MODAL-->
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
        var table = $('#etudiants-table')
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
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [
            [10, 30, 50, 200],
            [10, 30, 50, 200]
            ],
            iDisplayLength: -1,
            "scrollX": true,
            "scrollY": "400px",
            ajax: '{!! route('etudiants.all') !!}',
            data: {_token: '{{ csrf_token() }}'},
                    //"scrollX": true,
                    //"sScrollXInner": "110%",
                    dom: '<"top"B><fl><"bottom"rtip><"clear">',
                    "buttons": [
                    {
                        extend: "pdfHtml5",
                        title: "Application ASECAM liste des étudiants",
                        exportOptions: {
                            columns: [0,1, 2, 3, 4, 5, 6, 7, 8,9,10,]
                        }
                    },
                    {
                        extend: "csvHtml5",
                        title: "Application ASECAM liste des étudiants",
                        exportOptions: {
                            columns: [0,1, 2, 3, 4, 5, 6, 7, 8,9,10,]
                        }
                    },
                    {
                        extend: "print",
                        title: "Application ASECAM liste des étudiants",
                        text: "imprimer",
                        exportOptions: {
                            columns: [0,1, 2, 3, 4, 5, 6, 7, 8,9,10]
                        }
                    },

                    ],
                    columns: [
                    {data: 'numero', name: 'numero'},
                    {data: 'nom', name: 'nom'},
                    {data: 'prenom', name: 'prenom'},
                    {data: 'genre', name: 'genre'},
                    {data: 'promotion', name: 'promotion'},
                    {data: 'ville', name: 'ville'},
                    {data: 'filiere', name: 'filiere'},
                    {data: 'ecole', name: 'ecole'},
                    {data: 'situation', name: 'situation'},
                    {data: 'naissance', name: 'naissance'},
                    {data: 'tel', name: 'telephone'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action'},
                    ],

                });


            //////////////////// Delete Etudiant ///////////////////////////////////

            $(document).on('click', '.delete', function () {
                var id = $(this).data('id');
                var swal_ot = {
                    title: "{{ Lang::get('contenu.sure') }}",
                    text: "{{ Lang::get('contenu.subtext_sure') }}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "{{ Lang::get('contenu.confirm_btn') }}",
                    cancelButtonText: "{{ Lang::get('contenu.cancel_btn') }}",
                    closeOnConfirm: false
                };
                var url = '{{ route("etudiants.delete", ":id") }}';
                url = url.replace(':id', id);

                swal(swal_ot, function () {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {_token: '{{ csrf_token() }}'},
                    }).done(function () {
                        swal("{{ Lang::get('contenu.supprime') }}", "{{ Lang::get('contenu.sub_sup') }}", "success");
                        table.ajax.reload(null, false);
                        ;

                    }).error(function () {
                        swal("{{ Lang::get('contenu.oops') }}", "{{ Lang::get('contenu.problem_server') }}", "error");
                    });
                });
            });


        });
    </script>
    @endsection
