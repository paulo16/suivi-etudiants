<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 *Intefaces des Users
 **/

interface UserService {

	public function listusers(Request $request);

	public function update(Request $request, $id);

	public function store(Request $request);

	public function find($id);

	public function delete($id);

	public function count();

	public function listpays();

}
