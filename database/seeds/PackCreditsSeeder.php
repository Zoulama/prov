<?php

use Illuminate\Database\Seeder;

class PackCreditsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pack_credits')->delete();
        DB::table('pack_credits')->insert(
        	[
	            'nb_credit' 	=> '115',
	            'credit_offer' 	=> '15',
	            'price' 		=> '100',
	            'label'			=> 'Pack de 100 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);

        DB::table('pack_credits')->insert([
	            'nb_credit' 	=> '230',
	            'credit_offer' 	=> '30',
	            'price' 		=> '200',
	            'label'			=> 'Pack de 200 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);

        DB::table('pack_credits')->insert(	[
	            'nb_credit' 	=> '345',
	            'credit_offer' 	=> '45',
	            'price' 		=> '300',
	            'label'			=> 'Pack de 300 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);

        DB::table('pack_credits')->insert(	[
	            'nb_credit' 	=> '460',
	            'credit_offer' 	=> '60',
	            'price' 		=> '400',
	            'label'			=> 'Pack de 400 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);

        DB::table('pack_credits')->insert([
	            'nb_credit' 	=> '575',
	            'credit_offer' 	=> '75',
	            'price' 		=> '500€',
	            'label'			=> 'Pack de 500 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);
        
        DB::table('pack_credits')->insert([
	            'nb_credit' 	=> '690',
	            'credit_offer' 	=> '90',
	            'price' 		=> '600',
	            'label'			=> 'Pack de 600 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);
        
        DB::table('pack_credits')->insert([
	            'nb_credit' 	=> '920',
	            'credit_offer' 	=> '120',
	            'price' 		=> '800',
	            'label'			=> 'Pack de 800 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);

        DB::table('pack_credits')->insert([
	            'nb_credit' 	=> '1 150',
	            'credit_offer' 	=> '150',
	            'price' 		=> '1 100',
	            'label'			=> 'Pack de 1000 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);

        DB::table('pack_credits')->insert([
	            'nb_credit' 	=> '1 725',
	            'credit_offer' 	=> '225',
	            'price' 		=> '1 500',
	            'label'			=> 'Pack de 1500 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);

        DB::table('pack_credits')->insert([
	            'nb_credit' 	=> '2 300',
	            'credit_offer' 	=> '300',
	            'price' 		=> '2 000',
	            'label'			=> 'Pack de 2000 crédits',
	            'created_at'	=> Carbon::now(),
	            'updated_at'	=> Carbon::now(),
        ]);
    }
}
