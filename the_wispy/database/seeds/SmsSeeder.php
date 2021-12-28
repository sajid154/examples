<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\Media\Models\MediaFile;

class SmsSeeder extends Seeder
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

                for($i=1 ; $i <=1 ; $i++){

                                DB::table('smses')->insert(
                                    [
                                    'number' => '(952)140-9060',
                                    'device_id' => "1",
                                    'type' => 'sent',
                                    'message' => $faker->text(50,100),
                                    ]
                                );
                        }
                for($i=1 ; $i <=1 ; $i++){

                                DB::table('smses')->insert(
                                    [
                                    'number' => '(306)760-2080',
                                    'device_id' => "1",
                                    'type' => 'received',
                                    'message' => $faker->text(50,100),
                                    ]
                                );
                        }
                for($i=1 ; $i <=1 ; $i++){

                                DB::table('smses')->insert(
                                    [
                                    'number' => '(952)140-9060',
                                    'device_id' => "1",
                                    'type' => 'received',
                                    'message' => $faker->text(50,100),
                                    ]
                                );
                        }
                for($i=1 ; $i <=1 ; $i++){

                                DB::table('smses')->insert(
                                    [
                                    'number' => '(306)760-2080',
                                    'device_id' => "1",
                                    'type' => 'sent',
                                    'message' => $faker->text(50,100),
                                    ]
                                );
                        }

        }
    }
}
