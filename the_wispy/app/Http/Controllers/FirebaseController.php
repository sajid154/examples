<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ClientList;
use Morrislaptop\Firestore\Factory;
use Kreait\Firebase\ServiceAccount;
class FirebaseController extends Controller

{

//

public function index(){

    ini_set('max_file_uploads', 200);
    ini_set('memory_limit','10240M');
    ini_set('post_max_size', '200M');
    ini_set('max_input_time', '60');

    ini_set('max_execution_time', 1600);
    $client_data = Clientlist::all();
    // dd($client_data);
    foreach ($client_data as $key => $value) {

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/thewispy-6b883-ad4d94865c93.json');

    $firestore = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->createFirestore();

        $collection = $firestore->collection('users');
        $user = $collection->document((!empty($value->uniqueid)?$value->uniqueid:"no"));

       $user->set([
                'expired' => 'No' ]);
         dump($value->uniqueid);
    }
// This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.




exit();


$firestore = new FirestoreClient();

$collectionReference = $firestore->collection('Users');
$documentReference = $collectionReference->document($userId);
$snapshot = $documentReference->snapshot();

echo "Hello " . $snapshot['firstName'];exit();
print_r("Output: 1");
        $factory = new Factory();
        print_r("Output: 2");
        $firestore = $factory->createFirestore();
        print_r("Output: 3");
        $database = $firestore->database();

        $userRef =  $database->collection('users');
        $snapshot = $userRef->document('Hus')->snapshot();

        if($snapshot->exists()) {
            printf('Document data:' . PHP_EOL);
            print_r($snapshot->data());

        }
        print_r("Output: 4");

return "asas";




$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/laravelwithfirebase-fc51a-42b8356cfb9e.json');

$firebase = (new Factory)

->withServiceAccount($serviceAccount)

->withDatabaseUri('https://laravelwithfirebase-fc51a-default-rtdb.firebaseio.com/')

->create();

$database = $firebase->getDatabase();

$newPost = $database

->getReference('blog/posts')

->update([

'id' => '1',
'name' => 'ali a',
'expiration_date' => 'july-2020',
'start_date' => 'june-2020'

]);

//$newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-

//$newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-

//$newPost->getChild('title')->set('Changed post title');

//$newPost->getValue(); // Fetches the data from the realtime database

//$newPost->remove();

echo"<pre>";

print_r($newPost->getvalue());

}



     /**
     * Write code on Method
     *
     * @return response()
     */
    public function deviceRemoteLock(Request $request, $device_id)
    {
     
        $device = Clientlist::find($device_id);
     
          
        $SERVER_API_KEY = 'AAAAhE4QPLY:APA91bE0Dh1fGaQLI3RJTNvRNu9d6UpV_zj8APtcr-YDOXf_MvSDtwUukLQINOJwzgZdk8wpTsN1VDuQI4NaPWdOJYqyl7DIhAH__8PYlkW_GAqoy3oz_vdhOUaATj9ptx3Z-XefqIUC';
  
        $data = [
            "registration_ids" => [$device->device_token],
            "data" => [
                "run_command" => $request->run_command,  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
         $response = json_decode($response);
        
        if ($response->success == 1) {
            
            return redirect()->back()->with('success', 'Phone locked successfully.');
        
        }else{

            return redirect()->back()->with('unsuccess', "Didn't Complete the request due Error.");
        

        }
    }



        public function gotoLock($id)
    {
        return view('user.remote_lock', compact('id'));
    }
}







?>