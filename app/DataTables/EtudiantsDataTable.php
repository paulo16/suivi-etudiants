<?php

namespace App\DataTables;

use App\Models\Etudiant;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

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

        return $dataTable->addColumn('action', 'admin.etudiant.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = Etudiant::leftjoin('evolutions', 'evolutions.etudiant_id', '=', 'etudiants.id')
            ->join('villes', 'evolutions.ville_id', '=', 'villes.id')
            ->join('filieres', 'evolutions.filiere_id', '=', 'filieres.id')
            ->join('etablissements', 'evolutions.etablissement_id', '=', 'etablissements.id')
            ->select('etudiants.id as id', 'etudiants.nom as nom', 'etudiants.prenom as prenom',
                'etudiants.date_naissance as naissance', 'etudiants.genre as genre',
                'etudiants.promotion as promotion', 'villes.nom as ville', 'villes.id as ville_id',
                'filieres.nom as filiere',
                'etablissements.nom as ecole', 'evolutions.situation as situation')
            ->whereColumn('etudiants.promotion', 'evolutions.annee')
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
            ->parameters([
                'dom'     => 'Bfrtip',
                'buttons' => ['csv', 'excel', 'pdf'],
            ]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return ['id', 'genre', 'promotion', 'ville', 'filiere', 'ecole', 'nom', 'prenom', 'naissance'];
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
