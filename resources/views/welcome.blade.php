@extends('layouts.app')

@section('title', 'Welcome Page')
@section('content')
{{--    <x-header>Пользователи</x-header>--}}
    @include('shared.header', ['title' => 'Статьи'])
    <div class="container mx-auto">
        <a href="#" class="text-indigo-600 hover:text-indigo-900 my-5 block">
            Добавить статья
        </a>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    @if($articles->isNotEmpty())
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Имя
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        E-mail
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Количество комметариев
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Действия</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($articles as $article)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $article->title }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $article->created_at }}
                                            </div>
                                        </td>


                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                0
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center space-x-3">
                                            <a
                                                class="text-indigo-600 hover:text-indigo-900"
                                                href="#"
                                            >Редактировать</a>

                                            <a class="text-red-600 hover:text-red-900 cursor-pointer">
                                                Удалить
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{ $articles->links('pagination::tailwind') }}
                        </div>
                    @else
                        <div class="text-center font-bold text-xl">
                            Статей пока нет
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
