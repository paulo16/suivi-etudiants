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
                        <button class="btn btn-primary waves-effect waves-light" id="add-etudiant">
                            AJOUTER
                            <i class="fa fa-plus">
                            </i>
                        </button>
                    </div>
                </div>
            </div>
            <table cellspacing="0" class="table table-hover" id="etudiants-table" width="100%">
                <thead>
                    <tr>
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
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<!-- MODAL-->
@include('admin.etudiant.edit')
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
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [
            [10, 30, 50, 200000],
            [10, 30, 50, "tous"]
            ],
            iDisplayLength: -1,
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
                            columns: [1, 2, 3, 4, 5, 6, 7, 8,9,10,11]
                        }
                    },
                    {
                        extend: "csvHtml5",
                        title: "Application ASECAM liste des étudiants",
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8,9,10,11]
                        }
                    },
                    {
                        extend: "print",
                        title: "Application ASECAM liste des étudiants",
                        text: "imprimer",
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8,9,10,11]
                        }
                    },
                    ],
                    columns: [
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
                var url = '{{ route("etudiants.destroy", ":id") }}';
                url = url.replace(':id', id);

                swal(swal_ot, function () {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {_token: '{{ csrf_token() }}'},
                    }).done(function () {
                        swal("{{ Lang::get('contenu.supprime') }}", "{{ Lang::get('contenu.avo_sup') }}", "success");
                        table.ajax.reload(null, false);
                        ;

                    }).error(function () {
                        swal("{{ Lang::get('contenu.oops') }}", "{{ Lang::get('contenu.problem_server') }}", "error");
                    });
                });
            });

            //////////////////// show update Etudiant ////////////////////////////////////

            $(document).on('click', '#update-etudiant', function () {
                var id = $(this).data('id');
                var url = '{{ route("etudiants.show", ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                }).done(function (etudiant) {
                    $('#id-etudiant').val(etudiant.id);
                    $('#nom').val(etudiant.nom);
                    $('#prenom').val(etudiant.prenom);
                    $('#email').val(etudiant.email);
                    $('#tel').val(etudiant.tel);
                    $('#date-naissance').val(etudiant.date_naissance);
                    $('#status').val(etudiant.status);
                    $('#promotion').val(etudiant.promotion);
                    $('#genre').val(etudiant.genre);
                    $('#adresse').val(etudiant.adresse);
                    $('#sousmettre').val("update");
                    $('#modal-etudiant').modal('show');

                }).error(function () {
                    swal("{{ Lang::get('contenu.oops') }}", "{{ Lang::get('contenu.problem_server') }}", "error");
                });
            });

            ////////////////// save update Etudiant /////////////////////////////////////
            $("#sousmettre").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                e.preventDefault();
                var formData = {
                    nom: $('#nom').val(),
                    prenom: $('#prenom').val(),
                    email: $('#email').val(),
                    tel: $('#tel').val(),
                    date_naissance: $('#date-naissance').val(),
                    status: $('#status').val(),
                    promotion: $('#promotion').val(),
                    genre: $('#genre').val(),
                    adresse: $('#adresse').val()
                };

                var state = $('#sousmettre').val();
                var etudiant_id = $('#id-etudiant').val();
                var type = "POST"; //for creating new resource
                var url = '{{ route("etudiants.store") }}';

                if (state == "update") {
                    url = '{{ route("etudiants.update",':id') }}';
                    url = url.replace(':id', etudiant_id);
                    type = "PUT"; //for updating existing resource
                }

                $.ajax({
                    type: type,
                    url: url,
                    data: formData,
                }).done(function (etudiant) {

                    if (state == "add") { //if user added a new record
                        swal("{{ Lang::get('contenu.ajout_titre') }}", "{{ Lang::get('contenu.ajout_message') }}", "success");
                        table.ajax.reload(null, false);
                        ;
                    } else { //if user updated an existing record
                        swal("{{ Lang::get('contenu.update_titre') }}", "{{ Lang::get('contenu.update_message') }}", "success");
                        table.ajax.reload(null, false);
                    }

                    $('#form-etudiant').trigger("reset");
                    $('#modal-etudiant').modal('hide');

                }).error(function () {
                    swal("{{ Lang::get('contenu.oops') }}", "{{ Lang::get('contenu.problem_server') }}", "error");
                });

            });

            /////////////////// click add etudiant //////////////////////////////

            $('#add-etudiant').click(function () {
                $('#sousmettre').val("add");
                $('#form-etudiant').trigger("reset");
                $('#modal-etudiant').modal('show');
            });


        });
    </script>
    @endsection
