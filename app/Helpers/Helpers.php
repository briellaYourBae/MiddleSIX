<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Helpers {
    function UserRegisterValidator(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'validationError',
                'data' => null,
                'errors' => [
                    'msg' => $validator->errors()
                ]
            ]);
        }

        $user = User::create(
        [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'access_token' => Carbon::now()->format('Ymd')
        ]);

        return response()->json([
            'status' => 'OK',
            'data' => [
                'user' => $user
            ]
        ]);
    }
}