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
      <h4 class="header-title m-t-0 m-b-30">Modifier un étudiant</h4>
      <div class="row">
        <!-- Start add form -->
        <form action="{{route('etudiants.update', $etudiant)}}" method="post" data-parsley-validate novalidate>
          {{ csrf_field() }}
          {{ method_field('PATCH') }}

          <div class="col-md-4">
            <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
              <label for="nom">Nom*</label>
              <input type="text" name="nom" parsley-trigger="change" required placeholder="Entrer le nom" class="form-control" id="nom" value="{{ old('nom',$etudiant->nom) }}">

              @if ($errors->has('nom'))
              <span class="help-block">
                <strong>{{ $errors->first('nom') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
              <label for="prenom">Prenom*</label>
              <input type="text" name="prenom" parsley-trigger="change" required placeholder="Entrer le prenom" class="form-control" id="prenom" value="{{ old('prenom',$etudiant->prenom) }}">

              @if ($errors->has('prenom'))
              <span class="help-block">
                <strong>{{ $errors->first('prenom') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email">Adresse Email*</label>
              <input type="email" name="email" parsley-trigger="change" required placeholder="Entrer l'adresse email" class="form-control" id="email" value="{{ old('email',$etudiant->email) }}">

              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
              <label for="tel">Téléphone*</label>
              <input type="numeric" name="tel" parsley-trigger="change" required placeholder="Entrer le numéro de téléphone" class="form-control" id="tel" value="{{ old('tel',$etudiant->tel) }}">

              @if ($errors->has('tel'))
              <span class="help-block">
                <strong>{{ $errors->first('tel') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <!-- lieu Naisssance-->
          <div class="col-md-4">
            <div class="form-group{{ $errors->has('lieu_naissance') ? ' has-error' : '' }}">
              <label for="lieu_naissance">Lieu Naissance*</label>
              <input type="text" name="lieu_naissance" parsley-trigger="change"  placeholder="Entrer lieu naissance" class="form-control" id="lieu_naissance" value="{{ old('lieu_naissance',$etudiant->lieu_naissance) }}">

              @if ($errors->has('lieu_naissance'))
              <span class="help-block">
                <strong>{{ $errors->first('lieu_naissance') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group{{ $errors->has('date_naissance') ? ' has-error' : '' }}">
              <label for="date_naissance">Date de naissance*</label>
              <input type="date" name="date_naissance" parsley-trigger="change" required class="form-control" id="date_naissance" value="{{ old('date_naissance',$etudiant->naissance) }}">

              @if ($errors->has('date_naissance'))
              <span class="help-block">
                <strong>{{ $errors->first('date_naissance') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group col-lg-8">
             <label for="filieres">Filieres*</label>
             <select class="form-control" name="filieres" id="filieres">
               @foreach ($filieres as $p)
               <option value="{{$p['id']}}" @if($p['nom'] == $etudiant['filiere']) selected="selected" @endif>
                {{$p['nom']}}
              </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group{{ $errors->has('promotion') ? ' has-error' : '' }}">
            <label for="promotion">Promotion*</label>
            <input type="number" name="promotion" parsley-trigger="change" required placeholder="Entrer la promotion" class="form-control" id="promotion" value="{{ old('promotion',$etudiant->promotion) }}">

            @if ($errors->has('promotion'))
            <span class="help-block">
              <strong>{{ $errors->first('promotion') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group{{ $errors->has('adresse') ? ' has-error' : '' }}">
            <label for="adresse">Adresse*</label>
            <input type="text" name="adresse" parsley-trigger="change" required placeholder="Entrer l'adresse" class="form-control" id="adresse" value="{{ old('adresse',$etudiant->adresse) }}">

            @if ($errors->has('adresse'))
            <span class="help-block">
              <strong>{{ $errors->first('adresse') }}</strong>
            </span>
            @endif
          </div>
        </div>


        <div class="col-md-4">
          <div class="form-group col-lg-8">
            <label for="status">Status*</label>
            <select name="status" id="status" required class="form-control">
              <option disabled>-- Choisir un status --</option>
              <option value="BOURSIER(MINESUP)" 
              @if($etudiant->status == "BOURSIER(MINESUP)") selected="selected" @endif >BOURSIER(MINESUP)</option>
              <option value="BOURSIER(MINEFOP)" 
              @if($etudiant->status == "BOURSIER(MINEFOP)") selected="selected" @endif>BOURSIER(MINEFOP)</option>
              <option value="STAGAIRE" 
              @if($etudiant->status == "STAGAIRE") selected="selected" @endif >STAGAIRE</option>
              <option value="NON-BOURSIER"  
              @if($etudiant->status == "NON-BOURSIER") selected="selected" @endif>NON-BOURSIER</option>
              <option value="non boursier"  
              @if($etudiant->status == "AUTRES") selected="selected" @endif>AUTRES</option>
            </select>
          </div>
        </div>


        <div class="col-md-4">
          <div class="form-group col-lg-8">
           <label for="etablissements">Etablissements*</label>
           <select class="form-control" name="etablissements" id="etablissements">
             @foreach ($etablissements as $p)
             <option value="{{$p['id']}}" @if($p['nom'] == $etudiant['ecole']) selected="selected" @endif >
              {{$p['nom']}}
            </option>
            @endforeach
          </select>
        </div>
      </div>


      <div class="col-md-4">
        <div class="form-group col-lg-8">
          <label for="genre">Genre*</label>
          <select name="genre" id="genre" required class="form-control">
            <option disabled>-- Choisir un genre --</option>
            <option value="M" @if($etudiant->genre == "M") selected="selected" @endif>M</option>
            <option value="F" @if($etudiant->genre == "F") selected="selected" @endif>F</option>
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group col-lg-8">
          <label for="villes">Villes*</label>
          <select class="form-control" name="villes" id="villes">
           @foreach ($villes as $p)
           <option value="{{$p['id']}}" @if($p['nom'] == $etudiant['ville']) selected="selected" @endif>
            {{$p['nom']}}
          </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group{{ $errors->has('niveau') ? ' has-error' : '' }}">
        <label for="niveau">Niveau*</label>
        <input type="number" name="niveau" parsley-trigger="change" required placeholder="Entrer la niveau" class="form-control" id="niveau" value="{{ old('niveau',$etudiant->niveau) }}">

        @if ($errors->has('niveau'))
        <span class="help-block">
          <strong>{{ $errors->first('niveau') }}</strong>
        </span>
        @endif
      </div>
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
</div>
<!-- end row -->
@endsection