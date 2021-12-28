<?php
namespace App\Traits;

//use Illuminate\Support\Facades\Crypt;
use DB;

trait Encryptable
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable)) {
            $value = DB::select("SELECT AES_DECRYPT (FROM_BASE64('".$value."'),'dAtAbAsE98765432') as decrypted");
            $value= $value[0]->decrypted;
        }
		return $value;
    }

    public function setAttribute($key, $value)
    {

        if (in_array($key, $this->encryptable)) {
            $value = DB::select('SELECT TO_BASE64(AES_ENCRYPT( "'.addslashes($value).'" , "dAtAbAsE98765432")) as encrypted');
            $value = $value[0]->encrypted;
        }
        return parent::setAttribute($key, $value);
    }

   

}
