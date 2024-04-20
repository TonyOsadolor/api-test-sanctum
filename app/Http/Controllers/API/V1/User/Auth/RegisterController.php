<?php

namespace App\Http\Controllers\API\V1\User\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use App\Http\Requests\API\V1\User\Auth\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    /**
     * Inject models.
     *
     * @param UserService $userService
     */
    public function __construct(private UserService $userService)
    {
        //
    }

    /**
     * Register a new user to the application.
     *
     * @param RegisterRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->userService->store($request);

        $token = $user->createToken($request->ip())->plainTextToken;

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_CREATED)
            ->withMessage('User registration was successful!!!')
            ->withData([
                'user' => $request,
                'token' => $token,
            ])
            ->build();
    }
}
