<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert([
            [
                'name' => "admin",
                'display_name' => 'Administrateur',
                'description' => "Role administrateur, permet de voir et manipuler tous les élements de l'application",
            ],
            [
                'name' => "Manageur",
                'display_name' => 'Manageur',
                'description' => "Role manageur, permet de voir et manipuler certains éléments de l'application",
            ],
            [
                'name' => "consulteur",
                'display_name' => 'Consulteur',
                'description' => "Role consulteur, permet de voir les élements de l'application sans modification possible",
            ],
        ]);

        
    }
}
