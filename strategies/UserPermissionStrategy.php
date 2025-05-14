<?php
namespace app\strategies;
class UserPermissionStrategy implements PermissionStrategyInterface
{
    public function canCreate(): bool { return false; }
    public function canUpdate(): bool { return false; }
    public function canDelete(): bool { return false; }
}