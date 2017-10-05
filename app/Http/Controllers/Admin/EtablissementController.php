<?php

namespace App\Http\Controllers\Admin;

use App\Models\Etablissement;
use App\Services\EtablissementService;
use App\Http\Requests\EtablissementValidator;
use Entrust;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class EtablissementController
 * @package App\Http\Controllers\Admin
 */
class EtablissementController extends Controller
{

    protected $etablissementservice;

    /**
     * EtablissementController constructor.
     * @param EtablissementService $etablissementService
     */
    public function __construct(EtablissementService $etablissementService)
    {
        $this->etablissementservice = $etablissementService;

    }

    /**
     * Page list person
     * @GET("/tous-etablissements", as="ALL-ETABLISSEMENTS")
     * @return mixed
     */
    public function index()
    {
        //verifie que le role du user permet ce privilège
        if (!Entrust::hasRole(['admin', 'manageur'])) {
            App::abort(403);
        }

        return view('admin.etablissement.list');
    }


    /**
     *
     * @GET("/table-etablissements", as="ALL-ETABLISSEMENTS-DATATABLE")
     * @return mixed
     */
    public function allEtablissementtDataTable()
    {
        return $this->etablissementservice->allEtablissementDataTable();
    }

    /**
     * Page add etablissement
     *
     * @GET("/ajouter-etablissement", as="AJOUTER-ETABLISSEMENT-VIEW")
     * @return mixed
     */
    public function create()
    {
        return view('admin.etablissement.add');
    }

    /**
     * submit etablissement
     * @POST("/submit-add-etablissement", as="SUBMIT-ADD-ETABLISSEMENT")
     * @return mixed
     */
    public function store(EtablissementValidator $request)
    {
        if ($this->etablissementservice->createEtablissement($request)) {
            return redirect(route('ALL-ETABLISSEMENTS'));
        };
        return redirect()->back();
    }

    /**
     * Page profil Etablissement
     *
     * @GET("/view-profil-etablissement/{id}", as="PROFIL-ETABLISSEMENT-VIEW")
     * @return mixed
     */
    public function show($id)
    {
        $etablissement = $this->etablissementservice->findEtablissement($id);
        return view('admin.etablissement.profil');
    }

    /**
     * edit avocat
     *
     * @GET("/edit-etablissement-view/{id}", as="EDIT-ETABLISSEMENT-VIEW")
     * @return mixed
     */
    public function edit(Etablissement $etablissement)
    {
        return view('admin.etablissement.edit');
    }

    /**
     * submit edit etablissement
     *
     * @PUT("/submit-edit-etablissement/{id}", as="SUBMIT-EDIT-ETABLISSEMENT")
     * @return mixed
     */
    public function update(EtablissementValidator $request, $id)
    {
        if ($this->etablissementservice->updateEtablissement($request, $id)) {
            return redirect(route('ALL-ETABLISSEMENTS'));
        };
        return redirect()->back();
    }

    /**
     * Supprimer Etablissement
     * @DELETE("/supprimer-etablissement/{id}", as="DESTROY-ETABLISSEMENT")
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        //verifie que le role du user permet ce privilège
        if (!Entrust::can('delete-etablissement')) {
            App::abort(403);
        }
        return json_encode($this->etablissementservice->deleteEtablissement($id));
    }


}
