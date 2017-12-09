<?php

namespace App\Services\Impl;

use App\Models\Etablissement;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Ville;
use App\Services\GestionFichierService;
use DB;
use Excel;
use Illuminate\Http\Request;
use Session;

class GestionFichierServiceImpl implements GestionFichierService {

	public function importExcel(Request $request) {
		try {
			if ($request->hasFile('import_file')) {
				Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
					foreach ($reader->toArray() as $key => $row) {
						if ($row) {
							if (!empty($row['nom']) or !empty($row['prenom'])) {

								$etudiant = Etudiant::where([
									['nom', 'like', isset($row['nom']) ? $row['nom'] : ''],
									['prenom', 'like', isset($row['prenom']) ? $row['prenom'] : ''],
									['date_naissance', '=', isset($row['date_de_naissance']) ? $row['date_de_naissance'] : ''],
								])->first();

								if (empty($etudiant)) {
									$etudiant = new Etudiant();
									$etudiant->nom = isset($row['nom']) ? $row['nom'] : '';
									$etudiant->prenom = isset($row['prenom']) ? $row['prenom'] : '';
									$etudiant->date_naissance = isset($row['date_de_naissance']) ? $row['date_de_naissance'] : '0000-00-00';
									$etudiant->genre = isset($row['genre']) ? $row['genre'] : '';
									$etudiant->status = isset($row['status']) ? $row['status'] : '';
									$etudiant->promotion = isset($row['promotion']) ? trim($row['promotion']) : '';
									$etudiant->tel = isset($row['telephone']) ? $row['telephone'] : '';
									$etudiant->email = isset($row['email']) ? $row['email'] : '';
									$etudiant->save();
									//dd('apres-'.$etudiant);
								}
							}

							//Filière
							if (!empty($row['filiere'])) {
								$filiere = Filiere::where('nom', mb_strtoupper($row['filiere'], 'UTF-8'))->first();
								if (empty($filiere)) {
									$filiere = new Filiere();
									$filiere->nom = mb_strtoupper($row['filiere'], 'UTF-8');
									$filiere->save();
								}
							}

							//Etablissement
							if (!empty($row['etablissement'])) {
								$etablissement = Etablissement::where('nom', mb_strtoupper($row['etablissement'], 'UTF-8'))->first();
								if (empty($etablissement)) {
									$etablissement = new Etablissement();
									$etablissement->nom = mb_strtoupper($row['etablissement'], 'UTF-8');
									$etablissement->save();
								}
							}

							// Evolution

							if (!empty($etudiant)) {

								$evolution = DB::table('evolutions')
									->where('etudiants.id', '=', $etudiant->id)
									->Join('etudiants', 'evolutions.etudiant_id', '=', 'etudiants.id')
									->first();

								if (empty($evolution)) {

									if (!empty($row['ville'])) {
										$ville = Ville::where('nom', mb_strtoupper($row['ville'], 'UTF-8'))->first();
									}
									DB::table('evolutions')->insert([
										[
											'situation' => isset($row['status']) ? $row['status'] : '',
											'niveau' => isset($row['niveau']) ? $row['niveau'] : '',
											'annee' => isset($row['promotion']) ? $row['promotion'] : '',
											'etudiant_id' => $etudiant->id,
											'ville_id' => isset($ville) ? $ville->id : null,
											'filiere_id' => isset($filiere) ? $filiere->id : null,
											'etablissement_id' => isset($etablissement) ? $etablissement->id : null,
										],
									]);

								}

							}
						}
					}
				});
			}

			Session::put('success', 'Youe file successfully import in database!!!');

			return true;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
}
