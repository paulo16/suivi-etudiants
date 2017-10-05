<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\UserValidator;
use Entrust;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{

    protected $userservice;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userservice = $userService;

    }

    /**
     * Page list person
     * @GET("/tous-users", as="ALL-USERS")
     * @return mixed
     */
    public function index()
    {
        //verifie que le role du user permet ce privilège
        if (!Entrust::hasRole(['admin', 'manageur'])) {
            App::abort(403);
        }

        return view('admin.user.list');
    }


    /**
     *
     * @GET("/table-users", as="ALL-USERS-DATATABLE")
     * @return mixed
     */
    public function allUsertDataTable()
    {
        return $this->userservice->allUserDataTable();
    }

    /**
     * Page add user
     *
     * @GET("/ajouter-user", as="AJOUTER-USER-VIEW")
     * @return mixed
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * submit user
     * @POST("/submit-add-user", as="SUBMIT-ADD-USER")
     * @return mixed
     */
    public function store(UserValidator $request)
    {
        if ($this->userservice->createUser($request)) {
            return redirect(route('ALL-USERS'));
        };
        return redirect()->back();
    }

    /**
     * Page profil User
     *
     * @GET("/view-profil-user/{id}", as="PROFIL-USER-VIEW")
     * @return mixed
     */
    public function show($id)
    {
        $user = $this->userservice->findUser($id);
        return view('admin.user.profil');
    }

    /**
     * edit avocat
     *
     * @GET("/edit-user-view/{id}", as="EDIT-USER-VIEW")
     * @return mixed
     */
    public function edit(User $user)
    {
        return view('admin.user.edit');
    }

    /**
     * submit edit user
     *
     * @PUT("/submit-edit-user/{id}", as="SUBMIT-EDIT-USER")
     * @return mixed
     */
    public function update(UserValidator $request, $id)
    {
        if ($this->userservice->updateUser($request, $id)) {
            return redirect(route('ALL-USERS'));
        };
        return redirect()->back();
    }

    /**
     * Supprimer User
     * @DELETE("/supprimer-user/{id}", as="DELETE-USER")
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        //verifie que le role du user permet ce privilège
        if (!Entrust::can('delete-user')) {
            App::abort(403);
        }
        return json_encode($this->userservice->deleteUser($id));
    }


}
