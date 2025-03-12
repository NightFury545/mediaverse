<?php

namespace App\Http\Controllers\Social;
use App\Http\Controllers\Controller;
use App\Http\Requests\Social\UserRequests\UpdateUserRequest;
use App\Models\User;
use App\Services\Social\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Constructor to initialize UserService.
     *
     * @param UserService $userService
     */
    public function __construct(protected UserService $userService)
    {
    }

    /**
     * Show a specific user.
     *
     * @param string $identifier
     * @return JsonResponse
     */
    public function show(string $identifier): JsonResponse
    {
        try {
            $userData = $this->userService->getUser($identifier);

            return response()->json([
                'data' => $userData,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve user: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a list of users.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('perPage', 20);

            $users = $this->userService->getUsers($perPage);

            return response()->json($users);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch users: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update a specific user.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->authorize('update', $user);

        try {
            $data = $request->all();

            $updatedUser = $this->userService->update($user, $request->validated());

            return response()->json([
                'message' => 'User updated successfully.',
                'data' => $updatedUser,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to update user: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        try {
            $this->userService->delete($user);

            return response()->json([
                'message' => 'User deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to delete user: ' . $e->getMessage(),
            ], 500);
        }
    }
}

