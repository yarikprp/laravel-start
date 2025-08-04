@extends('layouts.app')

@section('title', isset($article) ? 'Редактировать статью' : 'Добавить статью')
@section('content')
    @include('shared.header', ['title' => isset($article) ? 'Редактировать статью' : 'Добавить статью'])

    <div class="flex flex-col">
        <a href="{{ route('articles.index') }}" class="text-indigo-600 hover:text-indigo-900 my-5 block">
            Вернуться назад
        </a>

        <form action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="POST">
            @csrf
            @if (isset($article))
                @method('PUT')
            @endif

            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Заголовок</label>
                            <input
                                type="text"
                                name="title"
                                value="{{ old('title', $article->title ?? '') }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 @error('title') border-red-500 @enderror rounded-md">
                            @error('title')
                            <div class="text-red-500 mt-2">Поле "заголовок" обязательно</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Текст</label>
                            <textarea
                                name="text"
                                rows="5"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 @error('text') border-red-500 @enderror rounded-md"
                            >{{ old('text', $article->text ?? '') }}</textarea>
                            @error('text')
                            <div class="text-red-500 mt-2">Поле "текст" обязательно</div>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Автор</label>
                            <select
                                name="user_id"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 @error('user_id') border-red-500 @enderror rounded-md"
                            >
                                @foreach($users as $id => $name)
                                    <option value="{{ $id }}" {{ (old('user_id', $article->user_id ?? '') == $id) ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="text-red-500 mt-2">Выберите автора</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ isset($article) ? 'Обновить' : 'Добавить' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
