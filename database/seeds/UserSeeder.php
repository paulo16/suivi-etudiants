<?php
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Pays;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        //role 
        $role_admin = Role::where('name', 'admin')->first();
        $role_manager  = Role::where('name', 'manageur')->first();
        $role_consulteur  = Role::where('name', 'consulteur')->first();

        //pays 
        $pays_admin = Pays::where('nom', 'Morocco')->first();

        //user
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->pays_id =$pays_admin->id;
        $admin->save();
        $manager = new User();
        $manager->name = 'Manageur de nom';
        $manager->email = 'manageur@gmail.com';
        $manager->pays_id =$pays_admin->id;
        $manager->password = bcrypt('manageur');

        $manager->save();
        $consulteur = new User();
        $consulteur->name = 'consulteur de nom';
        $consulteur->email = 'consulteur@gmail.com';
        $consulteur->pays_id =$pays_admin->id;
        $consulteur->password = bcrypt('consulteur');
        $consulteur->save();
        //les permissions
        $permissions=Permission::orderBy('name')->get();
        
        foreach ($permissions as $value) {
            $role_admin->attachPermission($value);
        }
        //attach
        $admin->attachRole($role_admin);
        $manager->attachRole($role_manager);
        $consulteur->attachRole($role_consulteur);


    }
}
