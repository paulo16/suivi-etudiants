<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Models\Pays;
use App\Models\Role;
use Illuminate\Http\Request;

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
		return $this->userService->listusers($request);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$pays = Pays::select()->orderBy('nom', 'asc') ->get() ->toArray();
		$roles = Role::select()->orderBy('name', 'asc') ->get() ->toArray();
        //dd($pays);

		return view('admin.users.add',compact('pays','roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$this->validate($request, [
			'nom' => 'required',
			'email' => 'email|unique:users',
			'password' => 'required|confirmed',
			'password_confirmation'=>'required',
			'prenom' => 'required',
			'pays' => 'required',
			'role' => 'required',
		]);

		return $this->userService->store($request)? redirect()->route('users.index'): redirect()->route('users.create');
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function show($id) {
		$user = $this->userService->find($id);
		$payss=Pays::find($user->pays_id);
		$roles=$user->roles->pluck('name')->toArray();
		$role= $roles? $roles[0] :"";
		$pays=$payss ? $payss->nom : "";


		return view('admin.users.profil', compact(['user', 'role','pays']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$user= $this->userService->find($id);
		$pays = Pays::select()->orderBy('nom', 'asc') ->get() ->toArray();
		$roles = Role::select()->orderBy('name', 'asc') ->get() ->toArray();
        //dd($pays);

		return view('admin.users.edit',compact('user','pays','roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//dd($request);
		$this->validate($request, [
			'nom' => 'required',
			'email' => 'email|unique:users',
			'password' => 'required|confirmed',
			'password_confirmation'=>'required',
			'prenom' => 'required',
			'pays' => 'required',
			'role' => 'required',
		]);

		if($this->userService->update($request, $id)) {
			return redirect(route('users.show',$id));
		}
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		return $this->userService->delete($id);
	}

}
