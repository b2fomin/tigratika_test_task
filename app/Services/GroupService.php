<?php

namespace App\Services;

use App\Models\Group;

class GroupService {
    public function index(int $page, int $per_page) {
        $res = Group::paginate(perPage: $per_page, page: $page);
        $res = $res->makeHidden(['created_at', 'updated_at']);
        return response([
            'meta' => [
            'page' => $page,
            'per_page' => $per_page,
            'total_number' => Group::all()->count(),
                ],
            'data' => $res]);
    }

    public function sub_groups(int $id) {
        return response()->json(Group::findOrFail($id)->sub_groups()->get());
    }
};