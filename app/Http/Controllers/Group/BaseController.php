<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Services\GroupService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $service;

    public function __construct(GroupService $service) {
        $this->service = $service;
    }
}
