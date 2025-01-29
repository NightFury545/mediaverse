<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Http\Requests\Social\Post\CreatePostRequest;
use App\Http\Requests\Social\Post\UpdatePostRequest;
use App\Models\Post;
use App\Services\Social\PostService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected PostService $postService)
    {
    }

    public function store(CreatePostRequest $request): JsonResponse
    {
        $this->authorize('create', Post::class);

        try {
            $post = $this->postService->create($request->validated());

            return response()->json([
                'message' => 'Post created successfully.',
                'data' => $post,
            ], 201);
        } catch (Exception $e) {
            Log::error('Error creating post: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to create post.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $identifier): JsonResponse
    {
        try {
            $post = $this->postService->getPost($identifier);

            if (!$post) {
                return response()->json(['message' => 'Post not found.'], 404);
            }

            $this->authorize('view', $post);

            return response()->json([
                'data' => $post,
            ]);
        } catch (Exception $e) {
            Log::error('Error retrieving post: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to retrieve post.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $this->authorize('update', $post);

        try {
            $updatedPost = $this->postService->update($post, $request->validated());

            return response()->json([
                'message' => 'Post updated successfully.',
                'data' => $updatedPost,
            ]);
        } catch (Exception $e) {
            Log::error('Error updating post: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to update post.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->authorize('delete', $post);

        try {
            $this->postService->delete($post);

            return response()->json([
                'message' => 'Post deleted successfully.',
            ]);
        } catch (Exception $e) {
            Log::error('Error deleting post: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to delete post.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Post::class);

        try {
            $filters = $request->get('filters', []);
            $sort = $request->get('sort', []);
            $perPage = $request->get('perPage', 20);

            $posts = $this->postService->getPosts($filters, $sort, $perPage);

            return response()->json([
                'data' => $posts,
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching posts: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to fetch posts.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
