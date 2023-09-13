<?php

namespace App\Services;

use Exception;
use App\DTOs\Auth\LoginDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Promise\PromiseInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Client\Response as HttpResponse;
use App\Services\Interfaces\AuthenticationServiceInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * @string
     */
    const AUTH_ROUTE = '/oauth/token';

    /**
     * @param LoginDTO $dto
     * @return PromiseInterface|HttpResponse
     * @throws Exception
     */
    public function login(LoginDTO $dto): PromiseInterface|HttpResponse
    {
        $data = [
            'username' => $dto->mobile,
            'password' => $dto->password,
        ];

        $loginData = array_merge($data, [
            'grant_type'    => $dto->grant_type ?? 'password',
            'client_id'     => Config::get('auth.clients.web.admin.id'),
            'client_secret' => Config::get('auth.clients.web.admin.secret'),
            'scope'         => '',
        ]);


        return $this->callOAuth($loginData);
    }

    /**
     * @param $data
     * @return PromiseInterface|HttpResponse
     * @throws Exception
     */
    public function callOAuth($data): PromiseInterface|HttpResponse
    {
        try {
            $authFullApiUrl = Config::get('app.url') . self::AUTH_ROUTE;

            return Http::asForm()->post($authFullApiUrl, $data);
        } catch (\Exception $exception){
            throw new Exception($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }

    }
}
