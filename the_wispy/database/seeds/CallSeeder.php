<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\Media\Models\MediaFile;

class CallSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $type= [
            ['OUTGOING','MISSED'],
            ['MISSED','OUTGOING'],
            ['OUTGOING','MISSED']
        ];
// dd($type[0]);
      for($i=1 ; $i <=4 ; $i++){
        dump($i);

                for($i=1 ; $i <=2 ; $i++){

                                DB::table('calllog')->insert(
                                    [
                                    'number' => '('.rand ( 100 , 999 ).')'.rand ( 100 , 999 ).'-'.rand ( 1000 , 9999 ),
                                    'device_id' => "1",
                                    'type' => 'OUTGOING',
                                    'duration' => rand ( 10 , 60 ), // password
                                    'name' => $faker->name,
                                    ]
                                );
                        }
                for($i=1 ; $i <=2 ; $i++){

                                DB::table('calllog')->insert(
                                    [
                                    'number' => '('.rand ( 100 , 999 ).')'.rand ( 100 , 999 ).'-'.rand ( 1000 , 9999 ),
                                    'device_id' => "1",
                                    'type' => 'MISSED',
                                    'duration' => rand ( 10 , 60 ), // password
                                    'name' => $faker->name,
                                    ]
                                );
                        }

        }
    }
}
