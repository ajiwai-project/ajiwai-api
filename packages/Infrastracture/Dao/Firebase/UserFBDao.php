<?php


namespace Ajiwai\Infrastracture\Dao\Firebase;

use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Firestore\QuerySnapshot;

/**
 * Class UserFBDao
 * @package Ajiwai\Infrastracture\Dao\Firebase
 */
class UserFBDao
{
    /** @var string */
    private const TABLE_NAME = 'users';
    /** @var FirestoreClient */
    private $database;

    /**
     * UserFBDao constructor.
     */
    public function __construct()
    {
        $this->database = FirebaseDriver::connect();
    }

    /**
     * ユーザーを登録します
     *
     * @param $userId
     * @param $password
     */
    public function register($userId, $password)
    {
        $this->database
            ->collection(self::TABLE_NAME)
            ->newDocument()
            ->set([
                'user_id' => $userId,
                'password' => $password
            ]);
    }

    /**
     * ユーザーを取得します
     *
     * @param $userId
     * @return QuerySnapshot
     */
    public function findByUserID($userId): QuerySnapshot
    {
        return $this->database
            ->collection(self::TABLE_NAME)
            ->where('user_id', '=', $userId)
            ->documents();
    }

    /**
     * リフレッシュトークンを更新します
     *
     * @param string $DocumentId
     * @param string $refreshId
     */
    public function updateRefreshId(string $DocumentId, string $refreshId)
    {
        $this->database
            ->collection(self::TABLE_NAME)
            ->document($DocumentId)
            ->set(
                ['refresh_id' => $refreshId],
                ['merge' => true]
            );
    }

    public function findByRefreshId(string $refreshId)
    {
        return $this->database
            ->collection(self::TABLE_NAME)
            ->where('refresh_id', '=', $refreshId)
            ->documents();
    }

}
