<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('permissions')->insert([
            //table Etablissement
            [
                'name' => "create-etablissement",
                'display_name' => 'Créer un établissement',
                'description' => "Permission  de créer un établissement",
            ],
            [
                'name' => "update-etablissement",
                'display_name' => 'Mettre à jour un établissement',
                'description' => "Permission  de modifier un établissement",
            ],
            [
                'name' => "delete-etablissement",
                'display_name' => 'Supprimer un établissement',
                'description' => "Permission de supprimer un établissement",
            ],

            //table Filiere
            [
                'name' => "create-filiere",
                'display_name' => 'Créer une filière',
                'description' => "Permission  de créer une Filière",
            ],
            [
                'name' => "update-filiere",
                'display_name' => 'Mettre à jour une filière',
                'description' => "Permission de modifier une filière",
            ],
            [
                'name' => "delete-filiere",
                'display_name' => 'Supprimer une Filière',
                'description' => "Permission de supprimer une filière",
            ],
            //table Ville
            [
                'name' => "create-ville",
                'display_name' => 'Créer une ville',
                'description' => "Permission  de créer une ville",
            ],
            [
                'name' => "update-ville",
                'display_name' => 'Mettre à jour une ville',
                'description' => "Permission de modifier une ville",
            ],
            [
                'name' => "delete-ville",
                'display_name' => 'Supprimer une ville',
                'description' => "Permission de supprimer une ville",
            ],

            //table pays
            [
                'name' => "create-pays",
                'display_name' => 'Créer un pays',
                'description' => "Permission  de créer un pays",
            ],
            [
                'name' => "update-pays",
                'display_name' => 'Mettre à jour un pays',
                'description' => "Permission de modifier un pays",
            ],
            [
                'name' => "delete-pays",
                'display_name' => 'Supprimer un pays',
                'description' => "Permission de supprimer un pays",
            ],

            //table evolution
            [
                'name' => "create-evolution",
                'display_name' => 'Créer une ligne évolution',
                'description' => "Permission  de créer une evolution",
            ],
            [
                'name' => "update-evolution",
                'display_name' => 'Mettre à jour une evolution',
                'description' => "Permission de modifier une evolution",
            ],
            [
                'name' => "delete-evolution",
                'display_name' => 'Supprimer une evolution',
                'description' => "Permission de supprimer une evolution",
            ],

            //table etudiant
            [
                'name' => "create-etudiant",
                'display_name' => 'Créer un etudiant',
                'description' => "Permission  de créer un etudiant",
            ],
            [
                'name' => "update-etudiant",
                'display_name' => 'Mettre à jour un etudiant',
                'description' => "Permission de modifier un etudiant",
            ],
            [
                'name' => "delete-etudiant",
                'display_name' => 'Supprimer un etudiant',
                'description' => "Permission de supprimer un etudiant",
            ],

            //table utilisateur
            [
                'name' => "create-utilisateur",
                'display_name' => 'Créer un utilisateur',
                'description' => "Permission  de créer un utilisateur",
            ],
            [
                'name' => "update-utilisateur",
                'display_name' => 'Mettre à jour un utilisateur',
                'description' => "Permission de modifier un utilisateur",
            ],
            [
                'name' => "delete-utilisateur",
                'display_name' => 'Supprimer un utilisateur',
                'description' => "Permission de supprimer un utilisateur",
            ],


        ]);
    }
}
