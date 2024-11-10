<?php

namespace App\Services;

use App\Models\Group;

class GroupService {
    public function index(int $page, int $per_page, array $order) {
        $res = Group::paginate(perPage: $per_page, page: $page);
        $res = $res->makeHidden(['created_at', 'updated_at']);
        if ($order === null) {
            $order = range(0, $per_page);
        };
        $arr = [];
        for ($i = 0; $i < count($order); ++$i) {
            array_push($arr, $res[$order[$i]]);
        }
        return response([
            'meta' => [
            'page' => $page,
            'per_page' => $per_page,
            'total_number' => Group::all()->count(),
                ],
            'data' => $arr]);
    }

    public function sub_groups(int $id) {
        return response()->json(Group::findOrFail($id)->sub_groups()->get());
    }
};