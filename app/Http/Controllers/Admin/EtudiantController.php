<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Services\EtudiantService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EtudiantController extends Controller
{

    public function __construct(EtudiantService $etudiantservice)
    {
        $this->middleware('web');
        $this->middleware('auth');

        $this->etudiantservice = $etudiantservice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.etudiant.list');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        return $this->etudiantservice->datatable();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->etudiantservice->create($request);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $etudiant = $this->etudiantservice->infoEtudiant($id);
        //dd($etudiant);
        return view('admin.etudiant.profil', ['etudiant' =>$etudiant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->etudiantservice->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
