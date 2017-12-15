@extends('admin.layouts.default')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon_1.ico')}}">
    <title>Admin dash</title>
    <link href="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('content')

@section('title_content')
    <h4 class="page-title">Dashboard</h4>
    <p class="text-muted page-title-alt">
        Les étudiants camerounais au Maroc boursiers, non bousiers et stagaires .
    </p>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title m-t-0 m-b-30">Liste des étudiants</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="m-b-30">
                            <button
                                    id="add-etudiant" class="btn btn-primary waves-effect waves-light"> AJOUTER <i
                                        class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <table id="etudiants-table" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>{{ Lang::get('contenu.etudiant_nom')}}</th>
                        <th>{{ Lang::get('contenu.etudiant_prenom')}}</th>
                        <th>{{ Lang::get('contenu.etudiant_date_naissance')}}</th>
                        <th>{{ Lang::get('contenu.etudiant_genre')}}</th>
                        <th>{{ Lang::get('contenu.etudiant_promotion')}}</th>
                        <th>{{ Lang::get('contenu.etudiant_action')}}</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

    <!-- MODAL-->
    @include('admin.etudiant.edit')
    <!-- MODAL-->
@endsection

@stop

@section('js')
    <!-- Datatables-->
    <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
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
                    ajax: '{!! route('etudiants.data') !!}',
                    data: {_token: '{{ csrf_token() }}'},
                     "scrollX": true,
                     "scrollY": "300px",
                    columns: [
                        {data: 'nom', name: 'nom'},
                        {data: 'prenom', name: 'prenom'},
                        {data: 'date_naissance', name: 'date_naissance'},
                        {data: 'genre', name: 'genre'},
                        {data: 'promotion', name: 'promotion'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ],

                });

            //////////////////// Delete Etudiant ///////////////////////////////////

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
                var url = '{{ route("etudiants.destroy", ":id") }}';
                url = url.replace(':id', id);

                swal(swal_ot, function () {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {_token: '{{ csrf_token() }}'},
                    }).done(function () {
                        swal("{{Lang::get('contenu.supprime')}}", "{{Lang::get('contenu.avo_sup')}}", "success");
                        table.ajax.reload(null, false);
                        ;

                    }).error(function () {
                        swal("{{Lang::get('contenu.oops')}}", "{{Lang::get('contenu.problem_server')}}", "error");
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
                    swal("{{Lang::get('contenu.oops')}}", "{{Lang::get('contenu.problem_server')}}", "error");
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
                        swal("{{Lang::get('contenu.ajout_titre')}}", "{{Lang::get('contenu.ajout_message')}}", "success");
                        table.ajax.reload(null, false);
                        ;
                    } else { //if user updated an existing record
                        swal("{{Lang::get('contenu.update_titre')}}", "{{Lang::get('contenu.update_message')}}", "success");
                        table.ajax.reload(null, false);
                    }

                    $('#form-etudiant').trigger("reset");
                    $('#modal-etudiant').modal('hide');

                }).error(function () {
                    swal("{{Lang::get('contenu.oops')}}", "{{Lang::get('contenu.problem_server')}}", "error");
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
