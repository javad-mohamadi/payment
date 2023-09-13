<?php

namespace App\DTOs\Auth;

use Illuminate\Http\Request;

class LoginDTO
{
    /**
     * @param string $mobile
     * @param string $password
     * @param string|null $grant_type
     */
    public function __construct(
        public string $mobile,
        public string $password,
        public ?string $grant_type
    ) {
    }

    /**
     * @param Request $request
     * @return LoginDTO
     */
    public static function getFromRequest(Request $request): LoginDTO
    {
        return new static(
            $request->mobile,
            $request->password,
            $request->grant_type
        );
    }
}
