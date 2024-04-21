<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Inject models.
     *
     * @param UserService $userService
     */
    public function __construct(public UserService $userService)
    {
        //
    }
    /**
     * Get authenticated user's details.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        // $user = QueryBuilder::for(User::where('id', $request->user()->id))
        $user = QueryBuilder::for($request->user())
            ->firstOrFail();

        return ResponseBuilder::asSuccess()
            ->withMessage('User\'s Profile fetched successful!!!')
            ->withData([
                'user' => $user,
            ])
            ->build();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update Logged In User Profile
     * 
     * @param UpdateUserRequest $request
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $authUser = auth()->user();

        $user = $this->userService->update($request, $authUser);

        return ResponseBuilder::asSuccess()
            ->withMessage('User profile updated successfully.')
            ->withData([
                'user' => $user,
            ])
            ->build();
    }

    /**
     * Deactivate Logged User Profile
     * 
     * @param $userUuid
     */
    public function destroy($userUuid)
    {
        $user = $this->userService->destroy($userUuid);

        return ResponseBuilder::asSuccess()
            ->withMessage('User profile Deleted successfully.')
            ->build();
    }
}
