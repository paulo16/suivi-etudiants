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
            @endsection


@section('content')

@section('title_content')
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-picture card-box">
                        <div class="profile-info-name">
                            <div class="profile-info-detail">
                                <h3 class="m-t-0 m-b-0">
                                    {{$etudiant->nom}}
                                </h3>
                                <br>
                                <div class="text-left">
                                    <p class="text-muted font-13">
                                        <strong>
                                            Prenom :
                                        </strong>
                                        <span class="m-l-15">
                                           {{$etudiant->prenom}}
                                        </span>
                                    </p>
                                    <p class="text-muted font-13">
                                        <strong>
                                            Ville :
                                        </strong>
                                        <span class="m-l-15">
                                           {{$etudiant->ville}}
                                        </span>
                                    </p>
                                    <p class="text-muted font-13">
                                        <strong>
                                            Filiere:
                                        </strong>
                                        <span class="m-l-15">
                                            {{$etudiant->filiere}}
                                        </span>
                                    </p>
                                    <p class="text-muted font-13">
                                        <strong>
                                            Etablissement:
                                        </strong>
                                        <span class="m-l-15">
                                            {{$etudiant->ecole}}
                                        </span>
                                    </p>
                                    <p class="text-muted font-13">
                                        <strong>
                                            Promotion:
                                        </strong>
                                        <span class="m-l-15">
                                            {{$etudiant->annee}}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                    <!--/ meta -->
                    <div class="card-box">
                                <h3 class="m-t-0 m-b-0">
                                    Evolution
                                </h3>
                                <br><br>
                                <p class="text-muted font-13">
                                        <strong>
                                        EX  2009    : Kenitra 
                                        </strong>
                                        <span class="m-l-15">
                                            : Maths Info
                                        </span>
                                </p>
                                <p class="text-muted font-13">
                                         <strong>
                                        EX  2010    : Kenitra 
                                        </strong>
                                        <span class="m-l-15">
                                            : Ingénieur d'etat
                                        </span>
                                </p>
                    </div>
                </div>
            </div>
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
            @endsection
        </link>
    </meta>
</meta>