<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->whereBelongsTo(User::find(3))
            /*->whereRelation('comments', function ($query) {$query->where('user_id', 3);})*/
            /*->whereHas('comments', function ($query) {$query->where('user_id', 3);})*/
            /*->with('comments')*/
            ->paginate(10);
        return view('welcome', compact('articles'));
    }
}
