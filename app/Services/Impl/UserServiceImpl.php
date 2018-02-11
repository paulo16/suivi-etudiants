<?php

namespace App\Services\Impl;

use App\Models\Pays;
use App\Models\User;
use App\Services\UserService;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Jenssegers\Date\Date;

class UserServiceImpl implements UserService {

	public function listusers(Request $request) {
		$columns = array(
			0 => 'id',
			1 => 'nom',
			2 => 'prenom',
			3 => 'email',
			4 => 'role',
			5 => 'pays',
			6 => 'created_at',
			7 => 'action',
		);

		$totalData = User::count();

		$totalFiltered = $totalData;

		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if (empty($request->input('search.value'))) {

			$users = User::leftjoin('pays', 'users.pays_id', '=', 'pays.id')
			->join('role_user', 'role_user.user_id', '=', 'users.id')
			->join('roles', 'roles.id', '=', 'role_user.role_id')
			->select('users.id as id', 'users.name as nom','users.prenom as prenom', 'users.email as email', 'pays.nom as pays',
				'users.created_at as created_at', 'roles.name as role')
			->offset($start)
			->limit($limit)
			->orderBy($order, $dir)
			->get();
		} else {
			$search = $request->input('search.value');

			$users = User::leftjoin('pays', 'users.pays_id', '=', 'pays.id')
			->join('role_user', 'role_user.user_id', '=', 'users.id')
			->join('roles', 'roles.id', '=', 'role_user.role_id')
			->select('users.id as id', 'users.name as nom','users.prenom as prenom','users.email as email', 'pays.nom as pays',
				'users.created_at as created_at', 'roles.name as role')
			->where('users.name', 'LIKE', "%{$search}%")
			->orwhere('users.prenom', 'LIKE', "%{$search}%")
			->orWhere('users.email', 'LIKE', "%{$search}%")
			->orWhere('pays.nom', 'LIKE', "%{$search}%")
			->offset($start)
			->limit($limit)
			->orderBy($order, $dir)
			->get();

			$totalFiltered = User::leftjoin('pays', 'users.pays_id', '=', 'pays.id')
			->join('role_user', 'role_user.user_id', '=', 'users.id')
			->join('roles', 'roles.id', '=', 'role_user.role_id')
			->select('users.id as id', 'users.name as nom','users.prenom as prenom', 'users.email as email', 'pays.nom as pays',
				'users.created_at as created_at', 'roles.name as role')
			->where('users.name', 'LIKE', "%{$search}%")
			->orwhere('users.prenom', 'LIKE', "%{$search}%")
			->orWhere('users.email', 'LIKE', "%{$search}%")
			->orWhere('pays.nom', 'LIKE', "%{$search}%")
			->offset($start)
			->limit($limit)
			->orderBy($order, $dir)
			->count();
		}

		$data = array();
		if (!empty($users)) {

			$url='<a href=":url" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i>Editer</a>';
			$delete='<a data-id=":id" class="btn btn-xs btn-danger btn-primary delete"><i class="glyphicon glyphicon-remove"></i>sup</a>';
			foreach ($users as $user) {
				$show = route('users.show', $user->id);
				$edit = route('users.edit', $user->id);
				$del =str_replace(":id",$user->id,$delete); 

				$nestedData['id'] = $user->id;
				$nestedData['nom'] = "<a href='{$show}' title='SHOW' >" . $user->nom . "</a>";
				$nestedData['prenom'] = $user->prenom;
				$nestedData['email'] = "<a href='{$show}' title='SHOW' >" . $user->email . "</a>";
				$nestedData['role'] = $user->role;
				$nestedData['pays'] = $user->pays;
				$date = new Date($user->created_at);
				$nestedData['created_at'] = $date->format('l j F Y H:i:s');

				$nestedData['action'] =str_replace(":url",$edit,$url).'&nbsp;'.$del; 

				$data[] = $nestedData;

			}
		}

		$json_data = array(
			"draw" => intval($request->input('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data,
		);

		return $json_data;
	}

	public function update(Request $request, $id) {

		//Debugbar::info($request);
		$user= User::find($id);
		$user->name= $request->get('nom') ? $request->get('nom') : '';
		$user->prenom= $request->get('prenom') ? $request->get('prenom') : '';
		$user->email= $request->get('email') ? $request->get('email') : '';
		$user->password= $request->get('password') ? bcrypt($request->get('password')) : ''; 
		$user->pays_id=$request->get('pays') ? $request->get('pays') : ''; 

		if($request->get('role')){
			$user->roles()->sync($request->get('role'));
		}
           
		return $user->save();
	}

	public function store(Request $request) {
		$user= new User();
		$user->name= $request->get('nom') ? $request->get('nom') : '';
		$user->prenom= $request->get('prenom') ? $request->get('prenom') : '';
		$user->email= $request->get('email') ? $request->get('email') : '';
		$user->password= $request->get('password') ? bcrypt($request->get('password')) : ''; 
		$user->pays_id=$request->get('pays') ? $request->get('pays') : ''; 

		if($user->save()){
			$user->roles()->sync($request->get('role'));
		}

		return $user;
	}

	public function find($id) {
		$user = User::find($id);

		return $user;
	}

	public function delete($id) {
		$user = user::find($id);
		return $user->delete();
	}

	/**
	 * @return int
	 */

	public function count() {
		return User::count();
	}

	public function listpays() {
		return $pays = Pays::select()
		->orderBy('nom', 'asc')
		->get()
		->toArray();
	}

}
