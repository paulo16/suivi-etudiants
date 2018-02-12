@extends('admin.layouts.default')

@section('head')
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link href="{{asset('assets/admin/images/favicon_1.ico')}}" rel="shortcut icon">
<title>
    Admin dash
</title>
<link href="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection


@section('content')

@section('title_content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h3 class="header-title m-t-0 m-b-30">
                Profil de l'étudiant
            </h3>
            <div class="clearfix">
                <p>
                    <img alt="profile-image" class="img-remake" src="{{asset('/assets/admin/images/customer.png')}}"/>
                    <strong>
                        Nom :
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->nom}}
                    </span>
                    <br/>
                    <strong>
                        Prénom :
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->prenom}}
                    </span>
                    <br/>
                    <strong>
                        Date de Naissance :
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->naissance}}
                    </span>
                    <br/>
                    <strong>
                        Genre :
                    </strong>
                    <span class="m-l-15">
                        @if($etudiant->genre =="M") Masculin @elseif($etudiant->genre =="F") Féminin @else "-"@endif
                    </span>
                    <br/>
                    <strong>
                        Status:
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->situation}}
                    </span>
                    <br/>
                    <strong>
                        Promotion:
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->promotion}}
                    </span>
                    <br/>
                    <strong>
                        ville:
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->ville}}
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <strong>
                        Etablissement:
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->ecole}}
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <strong>
                        Filière:
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->filiere}}
                    </span>
                    <br/>
                    <strong>
                        Téléphone:
                    </strong>
                    <span class="m-l-15">
                        (+212){{$etudiant->tel}}
                    </span>
                    <br/>
                    <strong>
                        Email:
                    </strong>
                    <span class="m-l-15">
                        {{$etudiant->email}}
                    </span>
                </p>
                <div class="clearfix">
                    <div class="text-left">
                        <a target="_blank" href="{{ route('generate-pdf',['id' => $etudiant->id])}}" class="btn btn-white waves-effect">
                            Imprimer le profil
                        </a>
                    </div>
                    <div class="text-right">
                        <a  href="{{ route('etudiants.edit', $etudiant) }}" class="btn btn-xs btn-primary " id="update-etudiant">
                            <span class='glyphicon glyphicon-edit'>editer</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--/ meta -->
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">
                Parcours
            </h4>
            <table class="table table-bordered m-0">
                <thead>
                    <tr>
                        <th>
                            Année
                        </th>
                        <th>
                            Ville
                        </th>
                        <th>
                            Etablissement
                        </th>
                        <th>
                            Filière
                        </th>
                        <th>
                            Situation
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evolutions as $evo)
                    <tr>
                        <td>
                            {{ $evo['annee'] }}
                        </td>
                        <td>
                            {{ $evo['ville']}}
                        </td>
                        <td>
                            {{ $evo['ecole']}}
                        </td>
                        <td>
                            {{ $evo['filiere'] }}
                        </td>
                        <td>
                            {{ $evo['situation'] }}
                        </td>

                        <td>
                            <a data-id="{{ $evo['id_evolution'] }} }}"  class="btn btn-xs btn-primary"id="update-evolution" ><span class='glyphicon glyphicon-edit'></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br/>
            <a  data-id="{{ $etudiant->id }}" class="btn btn-primary waves-effect waves-light" id="add-evolution"><span class='glyphicon  glyphicon-plus'></span>
                Ajouter une évolution
            </a>
            @include('admin.evolution.add')
            @include('admin.evolution.edit')
            @endsection

            @stop

            @section('js')
            <!-- Datatables-->
            <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}">
            </script>
            <script src="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.js')}}">
            </script>
            <script src="{{asset('assets/admin/plugins/datatables/dataTables.buttons.min.js')}}">
            </script>
            <script src="{{asset('assets/admin/plugins/datatables/vfs_fonts.js')}}">
            </script>
            <script src="{{asset('assets/admin/plugins/datatables/dataTables.responsive.min.js')}}">
            </script>
            <script src="{{asset('assets/admin/plugins/datatables/responsive.bootstrap.min.js')}}">
            </script>
            <script src="{{asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}">
            </script>
            <script>
                $(document).ready(function () {
                    $('#date-naissance').datepicker({
                        language: 'fr',
                        format: 'yyyy-mm-dd',
                    });

                    /* show edit evolution */
                    $(document).on('click', '#update-evolution', function () {
                        var id = $(this).data('id');
                        var url = '{{ route("etudiants.evolutions", ":id") }}';
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url,
                            type: 'GET',
                        }).done(function (result) {
                            //console.log(result);

                            $.each(result.etablissements, function(key, value) {

                                if(value.nom == result.evolutions.ecole){
                                    $('#etablissements-evo')
                                    .append($("<option selected></option>")
                                        .attr("value",value.id)
                                        .text(value.nom));
                                }else{
                                    $('#etablissements-evo')
                                    .append($("<option></option>")
                                        .attr("value",value.id)
                                        .text(value.nom)); 
                                }   

                            });

                            $.each(result.villes, function(key, value) { 
                                if(value.nom == result.evolutions.ville){ 
                                 $('#villes-evo')
                                 .append($("<option selected></option>")
                                    .attr("value",value.id)
                                    .text(value.nom)); 
                             }else{
                               $('#villes-evo')
                               .append($("<option></option>")
                                .attr("value",value.id)
                                .text(value.nom)); 

                           }
                       });

                            $.each(result.filieres, function(key, value) { 
                                if(value.nom == result.evolutions.filiere){   
                                 $('#filieres-evo')
                                 .append($("<option selected></option>")
                                    .attr("value",value.id)
                                    .text(value.nom)); 
                             }else{
                                 $('#filieres-evo')
                                 .append($("<option></option>")
                                    .attr("value",value.id)
                                    .text(value.nom));
                             }
                         });

                            $('#id-evolution').val(result.evolutions.id_evolution);
                            $('#annee-evo').val(result.evolutions.annee);
                            $('#situation-evo').val(result.evolutions.situation);
                            $('#sousmettre').val("update");
                            $('#modal-evolution').modal('show');

                        }).error(function () {
                            swal("{{Lang::get('contenu.oops')}}", "{{Lang::get('contenu.problem_server')}}", "error");
                        });
                    });

                    /* update evolution */

                    $("#sousmettre-evo").click(function (e) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        e.preventDefault();
                        var formData = {
                            id_evolution: $('#id-evolution').val(),
                            annee: $('#annee-evo').val(),
                            situation: $('#situation-evo').val(),
                            ville: $('#villes-evo').val(),
                            etablissement: $('#etablissements-evo').val(),
                            filiere: $('#filieres-evo').val(),
                        };

                        var evolution_id = $('#id-evolution').val();
                        var    url = '{{ route("evolutions.update",':id') }}';
                        url = url.replace(':id', evolution_id);
                        var    type = "PUT";

                        $.ajax({
                            type: type,
                            url: url,
                            data: formData,
                        }).done(function (evolution) {

                            swal("{{Lang::get('contenu.update_titre')}}", "{{Lang::get('contenu.update_message')}}", "success");
                            location.reload();

                        }).error(function () {
                            swal("{{Lang::get('contenu.oops')}}", "{{Lang::get('contenu.problem_server')}}", "error");
                        });

                    });


                    /* show add evolution */

                    $(document).on('click', '#add-evolution', function () {
                        var id_etudiant = $(this).data('id');
                        var url = '{{ route("etudiants.aides") }}';
                        $.ajax({
                            url: url,
                            type: 'GET',
                        }).done(function (result) {
                            //console.log(result);

                            $.each(result.etablissements, function(key, value) {
                                $('#etablissements-add-evo')
                                .append($("<option></option>")
                                    .attr("value",value.id)
                                    .text(value.nom)); 
                            });

                            $.each(result.villes, function(key, value) { 
                               $('#villes-add-evo')
                               .append($("<option></option>")
                                .attr("value",value.id)
                                .text(value.nom)); 
                           });

                            $.each(result.filieres, function(key, value) { 
                             $('#filieres-add-evo')
                             .append($("<option></option>")
                                .attr("value",value.id)
                                .text(value.nom));
                         });
                            $('#id-etudiant-add-evo').val(id_etudiant);
                            $('#sousmettre-add-evo').val("add");
                            $('#form-add-evoluton').trigger("reset");
                            $('#modal-add-evo').modal('show');

                        }).error(function () {
                            swal("{{Lang::get('contenu.oops')}}", "{{Lang::get('contenu.problem_server')}}", "error");
                        });
                    });


                    /* sousmettre add evolution */

                    $("#sousmettre-add-evo").click(function (e) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });
                        e.preventDefault();
                        var formData = {
                            id_etudiant: $('#id-etudiant-add-evo').val(),
                            annee: $('#annee-add-evo').val(),
                            situation: $('#situation-add-evo').val(),
                            ville: $('#villes-add-evo').val(),
                            etablissement: $('#etablissements-add-evo').val(),
                            filiere: $('#filieres-add-evo').val(),
                        };

                        var    url = '{{ route("evolutions.store") }}';
                        var    type = "POST";

                        $.ajax({
                            type: type,
                            url: url,
                            data: formData,
                        }).done(function (evolution) {

                            swal("{{Lang::get('contenu.ajout_titre')}}", "{{Lang::get('contenu.update_message')}}", "success");
                            location.reload();

                        }).error(function () {
                            swal("{{Lang::get('contenu.oops')}}", "{{Lang::get('contenu.problem_server')}}", "error");
                        });

                    });


                });
            </script>
            @endsection
