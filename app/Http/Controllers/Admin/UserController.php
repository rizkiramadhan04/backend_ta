<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() {
        $user = User::all();

        return view('admin.user.index', [
            'item' => $user
        ]);
    }

    public function createPage() {
        return view('admin.user.create');
    }
}
