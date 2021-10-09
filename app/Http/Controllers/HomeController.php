<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UsersDataTablesService;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function pagination(Request $request, UsersService $usersService, UsersDataTablesService $usersDataTablesService): JsonResponse
    {
        $draw = $request->get('draw');
        $records_per_page = $request->get('length');
        $offset = $request->get('start');
        $order = $request->get('order');

        $column_index = 0;
        $order_direction = 'asc';

        if(count($order) > 0) {
            $column_index = $order[0]['column'];
            $order_direction = $order[0]['dir'];
        }

        $filter = $request->get('search');
        $filter = (isset($filter['value'])) ? $filter['value'] : false;

        $total_rows = $usersService->getCount();
        $total_filtered = $usersService->getCount($filter);

        $data = $usersService->getUsers($filter, $offset, $records_per_page, $column_index, $order_direction, new UsersDataTablesService());
        $json = $usersDataTablesService->getDataTablesData($data, $draw, $total_rows, $total_filtered);

        return response()->json($json);
    }
}
