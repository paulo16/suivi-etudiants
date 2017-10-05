
@extends('admin.layouts.default')

@section('head')
 		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
       	<link rel="shortcut icon" href="{{asset('admin/images/favicon_1.ico')}}">
        <title>Admin dash</title>
@endsection

@section('content')

   @section('title_content')
		<h4 class="page-title">Dashboard</h4>
		<p class="text-muted page-title-alt">
		   Bienvenue sur l'application de suvi des étudiants camerounais au  Royaume du Maroc!
		</p>
   @endsection

   <div class="row">
    @if($message = Session::get('success'))
		<div class="alert alert-info alert-dismissible fade in" role="alert">
	      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">×</span>
	      </button>
	      <strong>Success!</strong> {{ $message }}
	    </div>
	@endif

	{!! Session::forget('success') !!}

	<br />
	<a href="{{ route('EXPORT-ETUDIANTS','xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
	<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('POST-IMPORT-ETUDIANTS')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="file" name="import_file" />
		<button class="btn btn-primary">Importer  les étudiants</button>
	</form>               

   </div>
@stop

@section('js')


@endsection