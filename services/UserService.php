<?php
namespace app\services;

use app\factories\ValidatorFactory;
use app\models\User;
use app\repositories\DbUserRepository;
use Yii;

class UserService
{
    private $repository;

    public function __construct(DbUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): User
    {
        $validators = [
            'name' => ValidatorFactory::create('name'),
            'email' => ValidatorFactory::create('email'),
            'registration_number' => ValidatorFactory::create('registration_number'),
        ];

        foreach ($validators as $field => $validator) {
            if (!$validator->validate($data[$field])) {
                throw new \DomainException($validator->getErrorMessage());
            }
        }

        $user = new User();
        $user->setAttributes($data);
        if (!$user->validate()) {
            throw new \DomainException('Dados inválidos: ' . json_encode($user->errors));
        }

        $this->repository->save($user);
        return $user;
    }

    public function update(int $id, array $data): User
    {
        $user = $this->repository->findById($id);
        if (!$user) {
            throw new \DomainException('Usuário não encontrado.');
        }

        $validators = [
            'name' => ValidatorFactory::create('name'),
            'email' => ValidatorFactory::create('email'),
            'registration_number' => ValidatorFactory::create('registration_number'),
        ];

        foreach ($validators as $field => $validator) {
            if (isset($data[$field]) && !$validator->validate($data[$field])) {
                throw new \DomainException($validator->getErrorMessage());
            }
        }

        $user->setAttributes($data);
        if (!$user->validate()) {
            throw new \DomainException('Dados inválidos: ' . json_encode($user->errors));
        }

        $this->repository->save($user);
        return $user;
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function findById(int $id): ?User
    {
        return $this->repository->findById($id);
    }
}