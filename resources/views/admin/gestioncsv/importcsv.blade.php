
@extends('admin.layouts.default')

@section('head')
 		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
       	<link rel="shortcut icon" href="{{asset('admin/images/favicon_1.ico')}}">
        <title>Admin dash</title>
@endsection

@section('content')

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

	@if(isset($result) && $result == true)
       <script>
          swal({
				  position: 'top-right',
				  type: 'success',
				  title: 'Fichier bien importé , merçi !!',
				  showConfirmButton: false,
				});
       </script>

	@elseif((isset($result) && $result != true))
       <script>
       	  swal("Oups !", " Problème lors de l'import de fichiers", "error");
       </script>

	@endif

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