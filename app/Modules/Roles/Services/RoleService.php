<?php
namespace App\Modules\Roles\Services;

use App\Models\Role;
use App\Modules\Core\Services\Service;

class RoleService extends Service {
    protected $fields= ['name'];
    protected $searchField = 'role';
    protected $rules = [
        "add" => [
            'name' => 'required|unique:roles,name',
        ],
        "update" => [
            'name' => 'required|unique:roles,name',
        ],
        "delete" => [
            'id' => 'required|exists:roles,id',
        ],
        "get" => [
            'id' => 'required|exists:roles,id',
        ]
    ];

    public function __construct(Role $model) {
        parent::__construct($model);
    }
}
