<?php

namespace App\Http\Controllers;

use App\Common\Utilities\ResponseCode;
use Illuminate\Http\Request;
use App\User;

class UserController extends ApiController
{

    protected $user;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->user()->can('view-users')) return $this->respondData($this->user->all(), $this->user->all()->count() . ' user');
        return $this->respondWithError(ResponseCode::DATA_NOT_FOUND, $this->_getMessageError(ResponseCode::DATA_NOT_FOUND));
    }
}
