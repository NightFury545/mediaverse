<?php

namespace App\Actions\Social\UserActions;

use App\Actions\Filters\RangeFilter;
use App\Models\User;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetUsersAction
{

    /**
     * Отримує список користувачів з застосуванням пагінації, сортування та фільтрації.
     *
     * Цей метод виконує запит для отримання користувачів, застосовуючи дозволені фільтри,
     * сортування та пагінацію, а потім повертає результат у вигляді пагінованого списку.
     *
     * @param int $perPage Кількість користувачів на сторінці (за замовчуванням 20)
     * @return LengthAwarePaginator Пагінований список користувачів
     * @throws Exception Якщо сталася помилка при отриманні користувачів
     */
    public function __invoke(int $perPage = 20): LengthAwarePaginator
    {
        try {
            return $this->applyPagination(
                $this->applySorting(
                    $this->applyFilters(QueryBuilder::for(User::class))
                ),
                $perPage
            );
        } catch (Exception $e) {
            throw new Exception('Помилка під час отримання користувачів: ' . $e->getMessage());
        }
    }

    /**
     * Застосовує фільтри до запиту.
     *
     * Цей метод дозволяє застосувати фільтри для пошуку користувачів за такими критеріями:
     * - країна
     * - стать
     * - статус онлайн
     * - дата народження (за допомогою діапазону)
     * - часткове співпадіння з іменем користувача, першим і останнім іменем
     *
     * @param QueryBuilder $query Запит для застосування фільтрів
     * @return QueryBuilder Модифікований запит з фільтрами
     */
    private function applyFilters(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedFilters([
            AllowedFilter::exact('country'),
            AllowedFilter::exact('gender'),
            AllowedFilter::exact('is_online'),
            AllowedFilter::custom('birthday', new RangeFilter()),
            AllowedFilter::partial('username'),
            AllowedFilter::partial('first_name'),
            AllowedFilter::partial('last_name'),
        ]);
    }

    /**
     * Застосовує сортування до запиту.
     *
     * Цей метод дозволяє застосувати сортування для користувачів за наступними полями:
     * - ім'я користувача
     * - перше ім'я
     * - останнє ім'я
     * - дата народження
     *
     * @param QueryBuilder $query Запит для застосування сортування
     * @return QueryBuilder Модифікований запит із сортуванням
     */
    private function applySorting(QueryBuilder $query): QueryBuilder
    {
        return $query->allowedSorts([
            'username',
            'first_name',
            'last_name',
            'birthday',
        ]);
    }

    /**
     * Застосовує пагінацію до запиту.
     *
     * Цей метод застосовує пагінацію до запиту, визначаючи кількість елементів на сторінці.
     *
     * @param QueryBuilder $query Запит для застосування пагінації
     * @param int $perPage Кількість елементів на сторінці
     * @return LengthAwarePaginator Пагінований список користувачів
     */
    private function applyPagination(QueryBuilder $query, int $perPage): LengthAwarePaginator
    {
        return $query->paginate($perPage);
    }
}
