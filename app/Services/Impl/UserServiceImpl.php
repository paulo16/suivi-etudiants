<?php

namespace App\Services\Impl;

use App\Models\Pays;
use App\Models\User;
use App\Services\UserService;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UserServiceImpl implements UserService {

	public function listusers(Request $request) {
		$columns = array(
			0 => 'id',
			1 => 'name',
			2 => 'email',
			3 => 'pays_id',
			4 => 'created_at',
		);

		$totalData = User::count();

		$totalFiltered = $totalData;

		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if (empty($request->input('search.value'))) {

			$users = User::leftjoin('pays', 'users.pays_id', '=', 'pays.id')
				->select('users.id as id', 'users.name as nom', 'users.email as email', 'pays.name as pays',
					'users.created_at as created_at')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
		} else {
			$search = $request->input('search.value');

			$users = User::leftjoin('pays', 'users.pays_id', '=', 'pays.id')
				->select('users.id as id', 'users.name as nom', 'users.email as email', 'pays.name as pays',
					'users.created_at as created_at')
				->where('users.nom ', 'LIKE', "%{$search}%")
				->orWhere('users.email', 'LIKE', "%{$search}%")
				->orWhere('pays.name', 'LIKE', "%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();

			$totalFiltered = User::leftjoin('pays', 'users.pays_id', '=', 'pays.id')
				->select('users.id as id', 'users.name as nom', 'users.email as email', 'pays.name as pays',
					'users.created_at as created_at')
				->where('users.nom ', 'LIKE', "%{$search}%")
				->orWhere('users.email', 'LIKE', "%{$search}%")
				->orWhere('pays.name', 'LIKE', "%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->count();
		}

		$data = array();
		if (!empty($users)) {
			foreach ($users as $user) {
				$show = route('user.show', $user->id);
				$edit = route('user.edit', $user->id);

				$nestedData['id'] = $user->id;
				$nestedData['nom'] = "<a href='{$show}' title='SHOW' >" . $user->nom . "</a>";
				$nestedData['email'] = "<a href='{$show}' title='SHOW' >" . $user->email . "</a>";
				$nestedData['pays'] = $user->pays;
				$nestedData['created_at'] = $user->created_at;

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

		Debugbar::info($request);
		$user = Etudiant::where('id', $id);

		$updateUser = [
			'name' => $request->get('nom') ? $request->get('nom') : '',
			'email' => $request->get('email') ? $request->get('email') : '',
			'pays_id' => $request->get('pays') ? $request->get('pays') : '',
			'created_at' => $request->get('created_at') ? $request->get('created_at') : '',
		];

		$user->update($updateUser);

		return $this->find($id);
	}

	public function create(Request $request) {
		return Etudiant::create([
			'name' => $request->get('nom') ? $request->get('nom') : '',
			'email' => $request->get('email') ? $request->get('email') : '',
			'password' => bcrypt($request->get('email')),
			'pays_id' => $request->get('pays') ? $request->get('pays') : null,
			'created_at' => $request->get('created_at') ? $request->get('created_at') : null,
		]);
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
