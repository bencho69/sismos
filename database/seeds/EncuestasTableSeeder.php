<?php

use Illuminate\Database\Seeder;

class EncuestasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//'fecha'=>'2018-'+random _int(1, 12)+'-'+random _int(1, 28)+' '+random _int(1, 23)+':'+random_ int(1, 59)+':'+random_ int(1, 59),
    	$collection = collect([2.5, 3.25, 3.75, 4.1, 5.2, 6.3, 6.6, 7.2, 7.0]);
        for ($i=1; $i<=100; $i++){
        	$Sem = random_int(1,10);
        	if ($Sem>4){
        		// El 60 porciento de las encuestas serán con confianza del 100% 
	        	DB::table('encuestas')->Insert([
		            'latitud' => '17.' . random_int(100000, 9999999),
		            'longitud' => '-99.' . random_int(100000, 9999999),
		            'intensidad' => random_int(1, 8),
		            'sismo_id' =>random_int(1, 3),
		            'confianza' => 1,
		            ]);
        	}else {
		        DB::table('encuestas')->Insert([
		            'latitud' => '17.' . random_int(100000, 9999999),
		            'longitud' => '-99.' . random_int(100000, 9999999),
		            'intensidad' => random_int(1, 8),
		            'sismo_id' =>random_int(1, 3),
		            'confianza' => random_int(1, 100)/100,
		            ]);
	        }
        }
    }
}
