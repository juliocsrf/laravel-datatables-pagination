<?php

namespace App\Services;

use App\Interfaces\DataTablesFormatter;
use Illuminate\Database\Eloquent\Collection;

class UsersDataTablesService implements DataTablesFormatter
{
    public function getDataTablesData(Collection $collection, int $draw, int $recordsTotal, int $recordsFiltered): array
    {
        $array = ['draw' => $draw, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered];
        $data = [];
        foreach($collection as $c) {
            $data[] = [$c->id, $c->name, $c->email];
        }
        $array['data'] = $data;
        return $array;
    }

    public function getColumnNameByIndex(int $index): string
    {
        $columns = ['id', 'name', 'email'];
        return $columns[$index];
    }
}
