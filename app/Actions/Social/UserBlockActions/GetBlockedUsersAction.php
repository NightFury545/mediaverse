<?php

namespace App\Actions\Social\UserBlockActions;

use App\Actions\Filters\RangeFilter;
use App\Models\User;
use App\Models\UserBlock;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;

class GetBlockedUsersAction
{
    /**
     * Повертає список заблокованих користувачів поточного користувача з фільтрацією, сортуванням та пагінацією.
     *
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function __invoke(int $perPage = 20): LengthAwarePaginator
    {
        try {
            /** @var User $user */
            $user = Auth::user();

            return QueryBuilder::for(UserBlock::class)
                ->where('user_id', $user->id)
                ->with('blocked')
                ->allowedFilters([
                    AllowedFilter::partial('reason'),
                    AllowedFilter::partial('blocked.username'),
                    AllowedFilter::custom('created_at', new RangeFilter()),
                ])
                ->allowedSorts(['created_at'])
                ->paginate($perPage)
                ->withQueryString();
        } catch (Exception $e) {
            throw new Exception('Сталася помилка при завантаженні списку заблокованих користувачів.');
        }
    }
}

