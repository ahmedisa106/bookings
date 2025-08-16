<?php

namespace Modules\Users\Http\Controllers;

use App\Helpers\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Transformers\UserResource;

class UsersController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        return  $this->json(
            UserResource::make(request()->user()->load('times'))
        );
    }
}
