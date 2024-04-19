<?php

namespace App\Modules\Core\Services;

use Illuminate\Auth\Access\AuthorizationException;
use App\Contracts\IsAllowed;

abstract class AuthenticatedService extends Service implements IsAllowed
{
    abstract public function isAllowed(int $entityCustomerId, int $userId): bool;

    protected function performAction($id, $data, $ruleKey, $action) {
        $this->validate($data, $ruleKey);

        if ($this->hasErrors()) {
            return;
        }

        if (!$this->isAllowed($id, auth('api')->user()->id)) {
            throw new AuthorizationException('Unauthorized');
        }

        $model = $this->model->where('id', $id)->first();

        return $model->$action($data);
    }
}
