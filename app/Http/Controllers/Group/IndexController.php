<?php

namespace App\Http\Controllers\Group;


class IndexController extends BaseController
{
    public function __invoke() {
        return $this->service->index();
    }
}
