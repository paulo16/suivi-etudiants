<?php

namespace App\Services;

/**
 *Intefaces des Users
 **/

interface UserService
{

    public function allUserDatatable();

    public function updateUser($request, $id);

    public function createUser($request);

    public function findUser($id);

    public function deleteUser($id);

    public function countUser();

}