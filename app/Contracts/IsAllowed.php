<?php

namespace App\Contracts;

interface IsAllowed
{
    public function isAllowed(int $entityId, int $userId): bool;
}
