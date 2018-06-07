<?php

use Illuminate\Database\Seeder;

class SismosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sismos')->Insert([
            'fecha'=>'2018-03-22 09:15:15',
            'magnitud'=>'3.8',
            'latitud'=>'18.21451',
            'longitud'=>'-99.124514',
            'profundidad'=>'12.25',
            'hora'=>'9:15:15',
            ]);
        DB::table('sismos')->Insert([
            'fecha'=>'2018-03-22 10:15:21',
            'magnitud'=>'4.1',
            'latitud'=>'18.012451',
            'longitud'=>'-99.78124',
            'profundidad'=>25.15,
            'hora'=>'10:15:21',
            ]);
        DB::table('sismos')->Insert([
            'fecha'=>'2018-03-23 13:15:05',
            'magnitud'=>'1.5',
            'latitud'=>'19.8721451',
            'longitud'=>'-99.451214',
            'profundidad'=>'12.25',
            'hora'=>'13:15:05',
            ]);
    }
}
