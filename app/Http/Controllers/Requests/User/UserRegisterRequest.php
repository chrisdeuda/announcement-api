<?php

namespace App\Http\Controllers\Requests\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRegisterRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
            ]
        );

        parent::__construct($request);
    }
}
