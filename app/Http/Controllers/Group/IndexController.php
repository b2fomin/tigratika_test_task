<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;


class IndexController extends BaseController
{
    public function __invoke(Request $request) {
        $request = $request->query();
        $page = isset($request['page']) ? $request['page'] : 1;
        $per_page = isset($request['per_page']) ? $request['per_page'] : 1;
        $order = $request['order'];
        return $this->service->index($page, $per_page, $order);
    }
}
