<?php
namespace app\strategies;

interface PermissionStrategyInterface
{
    public function canCreate(): bool;
    public function canUpdate(): bool;
    public function canDelete(): bool;
}