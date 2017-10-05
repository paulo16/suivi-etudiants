@extends('admin.layouts.default')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon_1.ico')}}">
    <title>Admin dash</title>
@endsection

@section('content')

@section('title_content')
    <h4 class="page-title">Dashboard</h4>
    <p class="text-muted page-title-alt">
        Bienvenue sur l'application de suvi des étudiants camerounais au Royaume du Maroc!
    </p>
@endsection

<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-info pull-left">
                <i class="glyphicon glyphicon-user text-info"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{$users}}</b></h3>
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
                <h3 class="text-dark"><b class="counter">{{$etudiants}}</b></h3>
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
                <h3 class="text-dark"><b class="counter">{{$etablissements}}</b></h3>
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
                <h3 class="text-dark"><b class="counter">{{$filieres}}</b></h3>
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


@endsection