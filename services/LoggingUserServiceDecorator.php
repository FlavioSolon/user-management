<?php
namespace app\services;

use app\models\User;
use Yii;

class LoggingUserServiceDecorator
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(array $data): User
    {
        $user = $this->userService->create($data);
        Yii::info("Usuário {$user->id} criado.", __METHOD__);
        return $user;
    }

    public function update(int $id, array $data): User
    {
        $user = $this->userService->update($id, $data);
        Yii::info("Usuário {$user->id} atualizado.", __METHOD__);
        return $user;
    }

    public function delete(int $id): void
    {
        $this->userService->delete($id);
        Yii::info("Usuário {$id} deletado.", __METHOD__);
    }

    public function findById(int $id): ?User
    {
        return $this->userService->findById($id);
    }
}