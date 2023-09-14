<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Repository;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
