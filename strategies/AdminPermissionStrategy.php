<?php
namespace app\strategies;

class AdminPermissionStrategy implements PermissionStrategyInterface
{
    public function canCreate(): bool { return true; }
    public function canUpdate(): bool { return true; }
    public function canDelete(): bool { return true; }
}