<?php
namespace app\repositories;

use app\models\User;
use yii\data\ActiveDataProvider;

class DbUserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        return User::findOne($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::findOne(['email' => $email]);
    }

    public function save(User $user): void
    {
        $user->save();
    }

    public function delete(int $id): void
    {
        User::deleteAll(['id' => $id]);
    }

    public function findAllByName(string $name, int $pageSize): array
    {
        $query = User::find()->where(['like', 'name', $name]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => $pageSize],
        ]);
        return $dataProvider->getModels();
    }
}