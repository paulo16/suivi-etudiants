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
                <h4 class="header-title m-t-0 m-b-30">Ajout étudiant</h4>
                <div class="row">
                    <div class="col-lg-7 col-lg-offset-2">

                        <!-- Start add form -->
                        <form action="{{route('SUBMIT-ADD-ETUDIANT')}}" method="post" data-parsley-validate novalidate>
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

                          <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                            <label for="prenom">Prenom*</label>
                            <input type="text" name="prenom" parsley-trigger="change" required placeholder="Entrer le prenom" class="form-control" id="prenom" value="{{ old('prenom') }}">

                            @if ($errors->has('prenom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('prenom') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Adresse Email*</label>
                            <input type="email" name="email" parsley-trigger="change" required placeholder="Entrer l'adresse email" class="form-control" id="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                            <label for="tel">Téléphone*</label>
                            <input type="numeric" name="tel" parsley-trigger="change" required placeholder="Entrer le numéro de téléphone" class="form-control" id="tel" value="{{ old('tel') }}">

                            @if ($errors->has('tel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tel') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="form-group{{ $errors->has('date_naissance') ? ' has-error' : '' }}">
                            <label for="date_naissance">Date de naissance*</label>
                            <input type="date" name="date_naissance" parsley-trigger="change" required class="form-control" id="date_naissance" value="{{ old('date_naissance') }}">

                            @if ($errors->has('date_naissance'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date_naissance') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="row">
                            <div class="form-group col-lg-3">
                              <label for="status">Status*</label>
                              <select name="status" id="status" required class="form-control">
                                <option disabled>-- Choisir un status --</option>
                                <option value="boursier">Boursier</option>
                                <option value="non boursier">Non boursier</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group{{ $errors->has('promotion') ? ' has-error' : '' }}">
                            <label for="promotion">Promotion*</label>
                            <input type="number" name="promotion" parsley-trigger="change" required placeholder="Entrer la promotion" class="form-control" id="promotion" value="{{ old('promotion') }}">

                            @if ($errors->has('promotion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('promotion') }}</strong>
                                </span>
                            @endif
                          </div>

                          <div class="row">
                            <div class="form-group col-lg-3">
                              <label for="genre">Genre*</label>
                              <select name="genre" id="genre" required class="form-control">
                                <option disabled>-- Choisir un genre --</option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group{{ $errors->has('adresse') ? ' has-error' : '' }}">
                            <label for="adresse">Adresse*</label>
                            <input type="text" name="adresse" parsley-trigger="change" required placeholder="Entrer l'adresse" class="form-control" id="adresse" value="{{ old('adresse') }}">

                            @if ($errors->has('adresse'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('adresse') }}</strong>
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