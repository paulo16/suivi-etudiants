
@extends('admin.layouts.default')

@section('head')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="{{asset('admin/images/favicon_1.ico')}}">
<title>Admin dash</title>
@endsection

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<h4 class="header-title m-t-0 m-b-30">Integrer  un fichier CSV d'étudiants</h4>

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

			<hr>
			<p>
				<a href="{{ route('EXPORT-ETUDIANTS','xlsx') }}">
					<button class="btn btn-success">Télécharger les étudiants depuis la base de données </button>
				</a> 
			</p>
			<hr>
			<p>
				<h5>IMPORTER LES ETUDIANTS DANS L'APPLICATION</h5>
				<hr>
			</p>

			<div class="col-lg-7 col-lg-offset-2">

				<form  action="{{ route('POST-IMPORT-ETUDIANTS')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="file" class="dropify" name="import_file" />
					<br/>
					<div class="form-group text-right m-b-0">
						<button class="btn btn-primary waves-effect waves-light" type="submit">
							Enregister
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

</div>
@stop

@section('js')
<script>
	$(document).ready(function () {
		$('.dropify').dropify({
			messages: {
				'default': 'Drag and drop a file here or click',
				'replace': 'Drag and drop or click to replace',
				'remove':  'Remove',
				'error':   'Ooops, something wrong happended.'
			}
		});
	});
</script>

@endsection