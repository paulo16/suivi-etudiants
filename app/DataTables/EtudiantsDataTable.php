<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class EtudiantsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'etudiantsdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
                $query = Etudiant::leftjoin('evolutions', 'evolutions.etudiant_id', '=', 'etudiants.id')
            ->leftjoin('villes', 'evolutions.ville_id', '=', 'villes.id')
            ->leftjoin('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
            ->leftjoin('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
            ->select('evolutions.id as id', 'etudiants.nom', 'etudiants.prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre', 'evolutions.annee as annee', 'villes.nom as ville', 'filieres.nom as filiere', 'etablissements.nom as ecole')
            ->where('evolutions.annee', '=', 'etudiants.promotion')
            ;
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return ['id', 'genre', 'annee', 'ville','filiere', 'ecole', 'nom', 'prenom', 'naissance'];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'etudiantsdatatable_' . time();
    }
}
