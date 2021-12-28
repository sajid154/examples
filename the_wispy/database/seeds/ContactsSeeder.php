<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\Media\Models\MediaFile;

class ContactsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {

                for($i=0 ; $i <=500 ; $i++){

$a = '('.rand ( 100 , 999 ).') '.rand ( 100 , 999 ).'-'.rand ( 1000 , 9999 );

$res[] = DB::select('SELECT TO_BASE64(AES_ENCRYPT( "'.addslashes($a).'" , "dAtAbAsE98765432")) as encrypted');
$name[] = DB::select('SELECT TO_BASE64(AES_ENCRYPT( "'.addslashes($faker->name).'" , "dAtAbAsE98765432")) as encrypted');
// dump($res[$i][0]);
                             DB::table('contacts')->insert(
                                    [
                                    'number' => $res[$i][0]->encrypted,
                                    'device_id' => "1",
                                    'name' => $name[$i][0]->encrypted,
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'updated_at' => date("Y-m-d H:i:s"),
                                    ]
                                );

                        }
    }
}
