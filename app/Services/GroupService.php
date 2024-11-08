<?php

namespace App\Services;

use App\Models\Group;

class GroupService {
    public function index() {
        $res = Group::all();
        $res = $res->makeHidden(['created_at', 'updated_at']);
        return response()->json($res);
    }
};