<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use PhpParser\Node\Expr\NullsafeMethodCall;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        if(@$user) {
            return response()->json([
                'status' => 'OK',
                'data' => $user,
                'errors' => null
            ]);
        }

        return response()->json([
            'status' => 'Empty',
            'data' => null,
            'errors' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Helpers $helpers)
    {
        return $helpers->UserRegisterValidator($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($token)
    {
        $user = User::where('access_token', $token)->get();

        if (@$user) {
            return response()->json([
                'status' => 'OK',
                'data' => $user,
                'errors' => null
            ]);
        }

        return response()->json([
            'status' => 'Not Found',
            'data' => null,
            'errors' => [
                'msg' => 'Data not found'
            ]
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
