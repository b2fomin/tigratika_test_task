<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends BaseController
{
    public function __invoke(int $id) {
        return $this->service->delete($id);
    }
}
