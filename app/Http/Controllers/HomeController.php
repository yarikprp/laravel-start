<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->select(['id', 'name', 'email'])
            ->paginate(10);
        return view('welcome', compact('users'));
    }
}
