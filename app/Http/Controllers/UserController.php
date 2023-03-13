<?php

namespace App\Http\Controllers;

use App\Http\CustomResponse\CustomJsonResponse;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id) {
        return User::findOrFail($id);
    }

    public function index() {
        $perPage = 2;
        $page = 0;

        $users = User::selectRaw('COUNT(*) OVER() as "total_records", users.*')
                ->skip($page*$perPage)
                ->take($perPage)
                ->get();

        return normalResponse($users, new UserTransformer, $perPage, $page);
    }
}
