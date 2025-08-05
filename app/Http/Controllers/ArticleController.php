<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()
            ->select(['id', 'title', 'thumbnail', 'created_at', 'user_id'])
            ->with(['user:id,name'])
            ->withCount('comments')
            ->latest()
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::pluck('name', 'id')->toArray();
        return view('articles.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        Article::create($request->validated());

        return redirect()->route('articles.index')->with('success', 'Статья добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $users = User::pluck('name', 'id')->toArray();
        return view('articles.form', compact('article', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->only(['title', 'text', 'user_id']);

        if ($request->hasFile('thumbnail')) {
            /** @var UploadedFile $file */
            $file = $request->file('thumbnail');

            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $data['thumbnail'] = $file->store('images/articles', 'public');
        }

        // Обновляем статью
        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Статья успешно обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
