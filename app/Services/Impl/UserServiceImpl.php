<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Services\UserService;
use Datatables;

class UserServiceImpl implements UserService
{
    /**
     * pour les dataTables
     */
    public function allUserDatatable()
    {


        $users = User::select([
            'id', 'nom', 'prenom', 'date_naissance', 'genre', 'promotion', 'created_at'
        ]);

        return Datatables::of($users)
            ->orderBy('created_at', 'desc')
            ->addColumn('action', function ($user) {
                $action = '<a href="{{' . route('EDIT-USER-VIEW', $user->id) . '}}" class="btn btn-xs btn-primary "><i class="glyphicon glyphicon-edit"></i> Editer</a>';
                $action .= '&nbsp;<a data-url="{{' . route('DELETE-USER', $user->id) . '}}" class="btn btn-xs btn-danger btn-primary delete"><i class="glyphicon glyphicon-remove"></i>sup</a>';
                return $action;
            })
            ->addColumn('profil', function ($user) {
                $profil = '<a href="{{' . route('PROFIL-USER-VIEW', $user->id) . '}}" role="button" class="btn btn-xs btn-primary " ><i class="zmdi zmdi-account"></i>profil</a>';

                return $profil;
            })
            ->editColumn('created_at', function ($user) {
                $createdAt = new Carbon($user->created_at);
                return $createdAt->format('d/m/y');
            })
            ->rawColumns(['profil', 'action'])
            ->smart(true)
            ->make(true);
    }

    public function updateUser($request, $id)
    {
        // TODO: Implement updateUser() method.
    }

    public function createUser($request)
    {
        // TODO: Implement createUser() method.
    }

    public function findUser($id)
    {
        // TODO: Implement findUser() method.
    }

    public function deleteUser($id)
    {
        // TODO: Implement deleteUser() method.
    }

    public function countUser()
    {
        return User::count();
    }
}