<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UsersService
{
    public function getCount(string $filter = null): int
    {
        if($filter) {
            return $this->getFilteredUsers($filter)->count();
        }
        return User::all()->count();
    }

    public function getFilteredUsers(string $filter): Builder {
        return User::where(function($query) use ($filter) {
            $query->orWhere('id', 'like', "%$filter%");
            $query->orWhere('name', 'like', "%$filter%");
            $query->orWhere('email', 'like', "%$filter%");
            $query->orWhere('email', 'like', "%$filter%");
        });
    }

    public function getUsers(string $filter,
                             int $offset,
                             int $records_per_page,
                             int $column_index,
                             string $order_direction,
                             UsersDataTablesService $usersDataTablesService): Collection
    {
        if($filter) {
            $users = $this->getFilteredUsers($filter);
        } else {
            $users = User::orderBy($usersDataTablesService->getColumnNameByindex($column_index), $order_direction);
        }

        return $users->offset($offset)->limit($records_per_page)->get();
    }
}
