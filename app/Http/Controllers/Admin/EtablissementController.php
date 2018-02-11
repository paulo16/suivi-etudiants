<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\EtablissementService;
use Illuminate\Http\Request;

class EtablissementController extends Controller {

    public function __construct(EtablissementService $etablissementService) {
        $this->middleware('web');
        $this->middleware('auth');

        $this->etablissementService = $etablissementService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.etablissement.list');
    }

    public function data(Request $request) {
        return $this->etablissementService->listetablissements($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.etablissement.add');
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
        ]);

        return $this->etablissementService->store($request)? redirect()->route('etablissements.index'): redirect()->route('etablissements.create');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id) {
        $etablissement = $this->etablissementService->find($id);


        return view('admin.etablissement.profil');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $etablissement= $this->etablissementService->find($id);
        return view('admin.etablissement.edit',compact('etablissement'));
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
        ]);

        if($this->etablissementService->update($request, $id)) {
            return redirect(route('etablissements.index'));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response|boolean
     */
    public function destroy($id) {
        return response()->json($this->etablissementService->delete($id));
    }

}
