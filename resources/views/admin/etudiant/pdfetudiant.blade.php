<!DOCTYPE html>
<html><head>
	<title>PDF</title>
	<link href="{{asset('/assets/admin/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet"
	type="text/css"/>
	<link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet" type="text/css"/>
</head><body>
	<p style="text-align:center;">Application de Suivi des Etudiants Camerounais au Royaume du Maroc</p>
	<p style="text-align:center;"><img style="height: 100 px ; width: 200px" src="{{asset('/assets/admin/images/asecam-logo.png')}}" alt="logo"></p>

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
					{{$data['etudiant']->nom}}
				</span>
				<br/>
				<strong>
					Prénom :
				</strong>
				<span class="m-l-15">
					{{$data['etudiant']->prenom}}
				</span>
				<br/>
				<strong>
					Date de Naissance :
				</strong>
				<span class="m-l-15">
					{{$data['etudiant']->naissance}}
				</span>
				<br/>
				<strong>
					Genre :
				</strong>
				<span class="m-l-15">
					@if($data['etudiant']->genre =="M") Masculin @elseif($data['etudiant']->genre =="F") Féminin @else "-"@endif
				</span>
				<br/>
				<strong>
					Status:
				</strong>
				<span class="m-l-15">
					{{$data['etudiant']->situation}}
				</span>
				<br/>
				<strong>
					Promotion:
				</strong>
				<span class="m-l-15">
					{{$data['etudiant']->promotion}}
				</span>
				<br/>
				<strong>
					ville:
				</strong>
				<span class="m-l-15">
					{{$data['etudiant']->ville}}
				</span>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>
					Etablissement:
				</strong>
				<span class="m-l-15">
					{{$data['etudiant']->ecole}}
				</span>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>
					Filière:
				</strong>
				<span class="m-l-15">
					{{$data['etudiant']->filiere}}
				</span>
				<br/>
				<strong>
					Téléphone:
				</strong>
				<span class="m-l-15">
					(+212){{$data['etudiant']->tel}}
				</span>
				<br/>
				<strong>
					Email:
				</strong>
				<span class="m-l-15">
					{{$data['etudiant']->email}}
				</span>
			</p>
		</div>
	</div>
	<div class="container">
		<h3 class="header-title m-t-0 m-b-30">
			Evolution de l'étudiant 
		</h3>
		<table class="table table-bordered m-0">
			<thead>
				<tr>
					<th>Annee</th>
					<th>Ville</th>
					<th>Etablissement</th>
					<th>Filière</th>
					<th>Situation</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data['evolutions'] as $evo)
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
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body></html>