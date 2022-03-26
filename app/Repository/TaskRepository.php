<?php

namespace App\Repository;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class TaskRepository
{
    public function findByFilter(array $filter): LengthAwarePaginator
    {
        return QueryBuilder::for(Task::class)
            ->with(['status', 'author', 'assign'])
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->paginate(5)
            ->appends($filter);
    }
}
