<?php

namespace App\Services;

use App\Models\Group;
use Response;

class GroupService {
    public function index(int $page, int $per_page, array | null $order) {
        $res = Group::paginate(perPage: $per_page, page: $page);
        $res = $res->makeHidden(['created_at', 'updated_at']);
        if ($order === null) {
            $order = range(0, $per_page);
        };
        $arr = [];
        for ($i = 0; $i < min(count($res), count($order)); ++$i) {
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

    public function delete(int $id) {
        try {
            $group = Group::findOrFail($id);
            $group->sub_groups()->delete();
            $group->delete();
            return response(['success' => true]);
        }
        catch (\Exception $e){
            return response(['success' => false, 'err_msg' => $e], status: 404);
        }
    }
};