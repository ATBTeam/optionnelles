<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Specialite;
use App\Parcours;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // clear our database ------------------------------------------
        DB::table('specialite')->delete();
        DB::table('parcours')->delete();
        DB::table('groupe')->delete();
        DB::table('user')->delete();
        DB::table('profil')->delete();
        DB::table('choix')->delete();
        DB::table('enseigner')->delete();
        DB::table('ue')->delete();
        DB::table('parcours_ue')->delete();

        /*
        $specialite = Specialite::create(array(
            'intitule' => 'MIAGE',
            'description' => 'Méthodes Informatiques Appliquées à la Gestion de l\'Entreprise'
        ));

        $parcours = Parcours::create(array(
            'intitule' => 'M2 MIAGE',
            'description' => 'Master 1 Miage',
            'annee' => 1,
            'nb_opt_s1' => 10,
            'nb_opt_s2' => 10,
            'deb_choix_s1' => '0000-00-00 00:00:00',
            'fin_choix_s1' => '0000-00-00 00:00:00',
            'deb_choix_s2' => '0000-00-00 00:00:00',
            'fin_choix_s2' => '0000-00-00 00:00:00',
            'id_specialite' => $specialite->id
        ));
        */



        $this->command->info('Parfait, vérifier ta base de données');

        Model::reguard();
    }
}
