<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface DataTablesFormatter
{
    public function getDataTablesData(Collection $collection, int $draw, int $recordsTotal, int $recordsFiltered): array;
    public function getColumnNameByIndex(int $index): string;
}
