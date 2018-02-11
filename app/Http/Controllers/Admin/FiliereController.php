<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FiliereService;
use Illuminate\Http\Request;

class FiliereController extends Controller {

    public function __construct(FiliereService $filiereService) {
        $this->middleware('web');
        $this->middleware('auth');

        $this->filiereService = $filiereService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.filiere.list');
    }

    public function data(Request $request) {
        return $this->filiereService->listfilieres($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.filiere.add');
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

        return $this->filiereService->store($request)? redirect()->route('filieres.index'): redirect()->route('filieres.create');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id) {
        $filiere = $this->filiereService->find($id);


        return view('admin.filiere.profil');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $filiere= $this->filiereService->find($id);
        return view('admin.filiere.edit',compact('filiere'));
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

        if($this->filiereService->update($request, $id)) {
            return redirect(route('filieres.index'));
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
        return response()->json($this->filiereService->delete($id));
    }

}
