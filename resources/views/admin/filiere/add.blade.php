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
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title m-t-0 m-b-30">Ajout Filière</h4>
                <div class="row">
                    <div class="col-lg-7 col-lg-offset-2">

                        <!-- Start add form -->
                        <form action="{{route('filieres.store')}}" method="post" data-parsley-validate novalidate>
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                            <label for="nom">Nom*</label>
                            <input type="text" name="nom" parsley-trigger="change" required placeholder="Entrer le nom" class="form-control" id="nom" value="{{ old('nom') }}">

                            @if ($errors->has('nom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nom') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="prenom">description*</label>
                            <input type="text" name="description" parsley-trigger="change" required placeholder="Entrer l'description" class="form-control" id="description" value="{{ old('description') }}">

                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                              Enregister
                            </button>
                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                              Effacer
                            </button>
                          </div>
                        </form>
                        <!-- End add form-->
                    </div>
                </div>

            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
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
@endsection