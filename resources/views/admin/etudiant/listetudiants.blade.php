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
            <p>
                <a id="add-un-etudiant" role="button" href="{{route('etudiants.create')}}" class="btn btn-primary waves-effect waves-light">
                  AJOUTER UN ETUDIANT <i class="fa fa-plus"></i>
              </a>
              <a class="btn btn-primary" data-toggle="collapse" href="#formfilterdiv" role="button" aria-expanded="false" aria-controls="formfilterdiv">
                AFFICHER LE FORMULAIRE DES FILTRES
            </a>
        </p>
        <hr>
        <div id="formfilterdiv" name="formfilterdiv" class="row collapse">
            <h3 class="header-title m-t-0 m-b-30"> FORMULAIRE DES FILTRES</h3>
            <form action="{{route('etudiants.store')}}" method="post" data-parsley-validate novalidate>
              {{ csrf_field() }}

              <div class="col-md-3">
                <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                  <label for="nom">Nom</label>
                  <input type="text" name="nom" parsley-trigger="change" required placeholder="Entrer un nom" class="form-control" id="nom" value="">
              </div>
          </div>
          <div class="col-md-3">
            <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
              <label for="prenom">Prenom</label>
              <input type="text" name="prenom" placeholder="Entrer un prenom" class="form-control" id="prenom" value="">
          </div>
      </div>

      <div class="col-md-3">
        <div class="form-group{{ $errors->has('promotion') ? ' has-error' : '' }}">
          <label for="nom">promotion</label>
          <input type="text" name="promotion" placeholder="promotion" class="form-control" id="promotion" value="">
      </div>
  </div>
  <div class="col-md-3">
    <div class="form-group col-lg-12">
        <label for="filieres">Filieres</label>
        <select class="form-control" name="filieres" id="filieres">
            <option value=""> </option>
            @foreach ($filieres as $p)
            <option value="{{$p['id']}}">
              {{$p['nom']}}
          </option>
          @endforeach
      </select>
  </div>
</div>

<div class="col-md-3">
  <div class="form-group col-lg-12">
    <label for="status">Status</label>
    <select name="status" id="status" required class="form-control">
      <option disabled>-- Choisir un status --</option>
      <option value=""> </option>
      <option value="BOURSIER(MINESUP)">BOURSIER(MINESUP)</option>
      <option value="BOURSIER(MINEFOP)">BOURSIER(MINEFOP)</option>
      <option value="STAGAIRE">STAGAIRE</option>
      <option value="PRIVEE">NON-BOURSIER</option>
      <option value="AUTRES">AUTRES</option>
  </select>
</div>
</div>


<div class="col-md-3">
  <div class="form-group col-lg-12">
     <label for="etablissements">Etablissements</label>
     <select class="form-control" name="etablissements" id="etablissements">
        <option value=""> </option>
        @foreach ($etablissements as $p)
        <option value="{{$p['id']}}" >
          {{$p['nom']}}
      </option>
      @endforeach
  </select>
</div>
</div>


<div class="col-md-3">
    <div class="form-group col-lg-12">
      <label for="genre">Genre</label>
      <select name="genre" id="genre" required class="form-control">
        <option disabled>-- Choisir un genre --</option>
        <option value=""> </option>
        <option value="M">M</option>
        <option value="F">F</option>
    </select>
</div>
</div>

<div class="col-md-3">
    <div class="form-group col-lg-12">
      <label for="villes">Villes</label>
      <select class="form-control" name="villes" id="villes">
        <option value=""> </option>
        @foreach ($villes as $p)
        <option value="{{$p['id']}}">
            {{$p['nom']}}
        </option>
        @endforeach
    </select>
</div>
</div>

<div class="col-md-3">
    <div class="form-group col-lg-12">
      <label for="archiver">Archiver</label>
      <select class="form-control" name="archiver" id="archiver">
         <option value=""> </option>
         <option value="true"> Etudiants Archivés</option>
         <option value="false"> Etudiants Actifs</option>
     </select>
 </div>
</div>
<div class="col-md-3 ">
    <div class="form-group col-lg-12">
        <label for="lancer">Lancer le filtre en cliquant ici svp </label>
        <button id="btnfiltre" class="btn btn-primary waves-effect waves-light" type="submit">
         Filtre sur les étudiants 
     </button>
 </div>
</div>

</form>

</div>

<hr>

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
            {{ Lang::get('contenu.etudiant_date_naissance') }}
        </th>
        <th>
            Situation
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
            {{ Lang::get('Niveau') }}
        </th>
        <th>
            {{ Lang::get('Tel') }}
        </th>
        <th>
            {{ Lang::get('Archiver') }}
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

      call_dataTable({});

      function call_dataTable(filters){

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
            order: [[ 1, "asc" ]],
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [
            [10, 30, 50, -1],
            [10, 30, 50, "tous"]
            ],
            iDisplayLength: -1,
            "scrollX": true,
            "scrollY": "400px",
            ajax: {
                url:'{!! route('etudiants.all') !!}',
                type:'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    filtre:filters
                },
            },
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
                            columns: [0,1, 2, 3, 4, 5, 6, 7, 8,9,10,11]
                        }
                    },

                    ],
                    "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },
                    ],
                    columns: [
                    {data: 'numero', name: 'numero'},
                    {data: 'nom', name: 'nom'},
                    {data: 'prenom', name: 'prenom'},
                    {data: 'naissance', name: 'naissance'},
                    {data: 'situation', name: 'situation'},
                    {data: 'genre', name: 'genre'},
                    {data: 'promotion', name: 'promotion'},
                    {data: 'ville', name: 'ville'},
                    {data: 'filiere', name: 'filiere'},
                    {data: 'ecole', name: 'ecole'},
                    {data: 'niveau', name: 'niveau'},
                    {data: 'tel', name: 'tel'},
                    {data: 'archive', name: 'archive'},
                    {data: 'action', name: 'action'},
                    ],

                });
}



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
                        $('#etudiants-table').DataTable().ajax.reload(null, false);
                        ;

                    }).error(function () {
                        swal("{{ Lang::get('contenu.oops') }}", "{{ Lang::get('contenu.problem_server') }}", "error");
                    });
                });
            });


            //////////////////// Archiver Etudiant ///////////////////////////////////

            $(document).on('click', '.archive', function () {
                var id = $(this).data('id');
                var url = '{{ route("etudiants.archiver", ":id") }}';
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {_token: '{{ csrf_token() }}'},
                }).done(function () {
                        //swal("{{ Lang::get('contenu.supprime') }}", "{{ Lang::get('contenu.sub_sup') }}", "success");
                        $('#etudiants-table').DataTable().ajax.reload(null, false);
                        ;

                    }).error(function () {
                        swal("{{ Lang::get('contenu.oops') }}", "{{ Lang::get('contenu.problem_server') }}", "error");
                    });

                });



            //////////////////// Clique sur lancer filtre ///////////////////////////////////

            $("#btnfiltre").click(function (e) {
                e.preventDefault();
                var formData = {
                    nom: $('#nom').val(),
                    prenom: $('#prenom').val(),
                    filiere: $('#filieres').val(),
                    ville: $('#villes').val(),
                    status: $('#status').val(),
                    etablissement: $('#etablissements').val(),
                    genre: $('#genre').val(),
                    archiver: $('#archiver').val(),
                    promotion: $('#promotion').val(),
                };

                //console.log("nom:"+$('#nom').val());

                $('#etudiants-table').DataTable().destroy();
                call_dataTable(formData);

            });




        });
    </script>
    @endsection
