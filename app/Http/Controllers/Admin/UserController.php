<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller {

	public function __construct(UserService $userService) {
		$this->middleware('web');
		$this->middleware('auth');

		$this->userService = $userService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.users.list');
	}

	public function data(Request $request) {
		return $this->userService->listusers();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		return $this->etudiantservice->create($request);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function show($id) {
		$user = $this->etudiantservice->infoUser($id);
		$evolutions = $this->etudiantservice->evolutionUser($id);
		//dd($evolutions);

		return view('admin.etudiant.profil', compact(['etudiant', 'evolutions']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$user = $this->etudiantservice->infoUser($id);

		return view('admin.etudiant.edit', compact(['etudiant']));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		return $this->etudiantservice->update($request, $id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

	public function listall() {
		return view('admin.etudiant.listetudiants');
	}

	public function all(Request $request) {
		return $this->etudiantservice->listetudiants($request);
	}

	public function aides() {
		$etablissements = $this->etablissementservice->listetablissement();
		$villes = $this->etudiantservice->listevilles();
		$filieres = $this->filiereservice->listefilieres();
		return compact(['etablissements', 'villes', 'filieres']);
	}

}
