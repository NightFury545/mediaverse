<?php
namespace App\Services\Social;

use App\Models\Post;
use App\Services\Social\Post\CreatePostService;
use App\Services\Social\Post\DeletePostService;
use App\Services\Social\Post\GetPostService;
use App\Services\Social\Post\GetPostsService;
use App\Services\Social\Post\UpdatePostService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService
{
    public function __construct(
        protected CreatePostService $createPostService,
        protected UpdatePostService $updatePostService,
        protected DeletePostService $deletePostService,
        protected GetPostService $getPostService,
        protected GetPostsService $getPostsService
    ) {}

    public function create(array $data): Post
    {
        return $this->createPostService->execute($data);
    }

    public function update(Post $post, array $data): Post
    {
        return $this->updatePostService->execute($post, $data);
    }

    public function delete(Post $post): void
    {
        $this->deletePostService->execute($post);
    }

    public function getPost(string $identifier): ?Post
    {
        return $this->getPostService->execute($identifier);
    }

    public function getPosts(array $filters = [], array $sort = [], int $perPage = 20): LengthAwarePaginator
    {
        return $this->getPostsService->execute($filters, $sort, $perPage);
    }
}


