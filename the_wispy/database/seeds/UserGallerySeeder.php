<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\Media\Models\MediaFile;

class UserGallerySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {


                for($i=1 ; $i <=500 ; $i++){

                                DB::table('user_galleries')->insert(
                                    [
                                    'path' => '('.rand ( 100 , 999 ).')'.rand ( 100 , 999 ).'-'.rand ( 1000 , 9999 ),
                                    'device_id' => "17",
                                    'date_time' => now(),
                                    ]
                                );
                        }
    }
}
