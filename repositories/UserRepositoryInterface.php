<?php

namespace app\repositories;

use app\models\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function save(User $user): void;

    public function delete(int $id): void;

    public function findAllByName(string $name, int $pageSize): array;
}