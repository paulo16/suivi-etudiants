@extends('admin.layouts.default')

@section('head')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="{{asset('assets/admin/images/favicon_1.ico')}}">
<title>Stats</title>
@endsection

@section('content')

@section('title_content')
<h4 class="page-title">Statistiques</h4>
<br>
@endsection

<div class=" clearfix card-box" >
    <form id="form">
        <div class="col-md-6">
            <input id="id-etudiant" type="hidden" value=""/>
            <div class="form-group">
                <label class="control-label" for="annee">
                    Année
                </label>
                <select class="form-control" name="annee" id="annee">
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="situation">
                    Situation
                </label>
                <input class="form-control" id="situation" name="situation" type="text" value=""/>
            </div>
            <div id="villes-div" class="input-group">
                <label class="control-label" for="villes">
                    Villes
                </label>
                <select class="form-control" name="villes" id="villes">
                   @foreach ($villes as $v)
                   <option value="{{ $v['id']}}" >{{ $v['nom']}}</option>
                   @endforeach
               </select>
           </div>
           <div class="text-right">
            <button type="submit" class="btn btn-info waves-effect waves-light">lancer filtre</button>
        </div>
    </div>
    <div class="col-md-6">
       <div id="filieres-div" class="input-group">
        <label class="control-label" for="filieres">
            Filières
        </label>
        <select class="form-control" name="filieres" id="filieres">
           @foreach ($filieres as $v)
           <option value="{{ $v['id']}}" >{{ $v['nom']}}</option>
           @endforeach
       </select>
   </div>
   <div id="etablissement-div" class="input-group">
    <label class="control-label" for="etablissements">
        Etablissements
    </label>
    <select class="form-control" name="etablissements" id="etablissements">
       @foreach ($etablissements as $v)
       <option value="{{ $v['id']}}" >{{ $v['nom']}}</option>
       @endforeach
   </select>
</div>  
</div>
<br>
</form>
</div>


<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="glyphicon glyphicon-user text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$nbusers}}</b></h3>
                <p class="text-muted">Utilisateurs</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-custom pull-left">
                <i class="icon-people text-custom"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$nbetudiants}}</b></h3>
                <p class="text-muted">Etudiants</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="md-place text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$nbetablissements}}</b></h3>
                <p class="text-muted">Ecoles</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-custom pull-left">
                <i class="icon-directions text-custom"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$nbfilieres}}</b></h3>
                <p class="text-muted">Filières</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<!-- Les tableaux de bords etudiants par ville et les 10 derniers etudiants ajouter -->
<div class="row">

    <div class="col-lg-12">

        <div class="card-box">
            <h4 class="text-dark header-title m-t-0">Evolutions par années</h4>
            <div>
                {!! $statsvilles->render() !!}
            </div>

        </div>

    </div>

    <!-- col -->
</div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        var today = new Date('03/25/2007');
        var yyyy = today.getFullYear();
        var html = '';
        for (var i = 0; i < 100; i++, yyyy++) {
            if (i==2016){
                html = html + '<option selected value="'+ yyyy +'">' + yyyy + '</option>';
                
            }else{
                html = html + '<option value="'+ yyyy +'">' + yyyy + '</option>';
            }
        }; 

        $('#annee').append(html);  

    });
</script>

@endsection