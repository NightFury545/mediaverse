<?php

namespace App\Actions\Social\ChatActions;

use App\Models\Chat;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class GetChatsAction
{
    /**
     * Отримує список чатів для поточного користувача з сортуванням.
     *
     * @param int $perPage Кількість чатів на сторінці
     * @return LengthAwarePaginator
     * @throws Exception
     */
    public function __invoke(int $perPage = 20): LengthAwarePaginator
    {
        try {
            $query = $this->buildBaseQuery();

            $this->applyFilters($query);
            $this->applySorting($query);

            return $query->paginate($perPage);
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання чатів: ' . $e->getMessage());
        }
    }

    /**
     * Створює базовий запит для отримання чатів для поточного користувача.
     *
     * @return QueryBuilder
     */
    private function buildBaseQuery(): QueryBuilder
    {
        $user = auth()->user();

        return QueryBuilder::for(Chat::class)
            ->with([
                'userOne:id,username,avatar,is_online,last_seen_at',
                'userTwo:id,username,avatar,is_online,last_seen_at'
            ])
            ->where(function ($query) use ($user) {
                $query->where('user_one_id', $user->id)
                    ->orWhere('user_two_id', $user->id);
            });
    }

    /**
     * Додає сортування за останнім повідомленням і за датою створення чату.
     *
     * @param QueryBuilder $query
     */
    private function applySorting(QueryBuilder $query): void
    {
        $query->allowedSorts(['last_message_at', 'created_at']);
    }

    /**
     * Додає фільтрацію для пошуку за username співрозмовника.
     *
     * @param QueryBuilder $query
     */
    private function applyFilters(QueryBuilder $query): void
    {
        $query->allowedFilters([
            AllowedFilter::partial('user_two.username'),
        ]);
    }
}
