<?php


namespace Ajiwai\Infrastracture\Dao\Firebase;


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

/**
 * Class FirebaseDriver
 * @package Ajiwai\Infrastracture\Dao\Firebase
 */
class FirebaseDriver
{

    /**
     * Firebaseへ接続する
     */
    public static function connect()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(config('firebase.JSON_FILE'));
        return (new Factory())
            ->withServiceAccount($serviceAccount)
            ->createFirestore()
            ->database();
    }
}
