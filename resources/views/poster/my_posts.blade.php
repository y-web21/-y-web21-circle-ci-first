@extends('layouts.master')
@php
$disp_header = config('const.common.BLADE.HEADER.NONE');
$disp_gnav = config('const.common.BLADE.GNAV.NONE');
@endphp

@section('content')

    @include('navigation-menu')

    <div class="w-full relative mt-0 shadow-2xl rounded my-12 bg-white overflow-hidden">
    <div class="px-0 lg:px-4 py-6">

        <div>
            <h2 class="text-2xl font-semibold">記事一覧</h2>
            <hr>
        </div>

        <table class="hidden lg:table table-fixed my-10">
            <thead>
                <tr class="text-gray-200 font-medium">
                    <th class="border-r border-blue-200 bg-blue-900 x-4 py-2 w-2/15">タイトル</th>
                    <th class="border-r border-blue-200 bg-blue-900 x-4 py-2 w-6/15">内容</th>
                    <th class="border-r border-blue-200 bg-blue-900 x-4 py-2 w-1/15">状態</th>
                    <th class="border-r border-blue-200 bg-blue-900 x-4 py-2 w-2/15">更新日</th>
                    <th class="border-r border-blue-200 bg-blue-900 x-4 py-2 w-2/15">作成日</th>
                    <th class="bg-blue-900 x-4 py-2 w-2/15">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td class="border border-blue-800 w-2/15 px-4 py-2">{{ $article->title }}</td>
                        <td class="border border-blue-800 w-6/15 px-4 py-2">{{ Helper::strlimit($article->content, 100) }}</td>
                        <td class="border border-blue-800 w-1/15 px-4 py-2 text-center">{{ $article->status_name }}</td>
                        <td class="border border-blue-800 w-2/15 px-4 py-2 text-center">{{ $article->updated_at }}</td>
                        <td class="border border-blue-800 w-2/15 px-4 py-2 text-center">{{ $article->created_at }}</td>
                        <td class="border border-blue-800 w-2/15 text-center">
                            <div class="flex items-center justify-around">
                                <div>
                                    <button type="button"
                                        class="btn-green-sm"
                                        onclick="location.href='{{ route('post.edit', ['post' => $article->id]) }}'">編集</button>
                                </div>
                                <form action={{ route('post.destroy', ['post' => $article->id]) }} method="post"
                                    class="m-0">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="btn-red-sm">削除</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="block lg:hidden">
            @foreach ($articles as $article)
                <table class="table-fixed my-10 mt-4">
                    <tbody>
                        <tr>
                            <th class="border-t border-blue-800 w-1/4 bg-blue-900 text-gray-200 x-4 py-2 mt-4">タイトル</th>
                            <td class="border border-blue-800 w-3/4 px-4 py-2">{{ $article->title }}</td>
                        </tr>
                        <tr>
                            <th class="border-t border-b border-blue-200 w-1/4 bg-blue-900 text-gray-200 x-4 py-2">内容</th>
                            <td class="border border-blue-800 w-3/4 px-4 py-2">{{ Helper::strlimit($article->content, 100) }}</td>
                        </tr>
                        <tr>
                            <th class="border-b border-blue-200 w-1/4 bg-blue-900 text-gray-200 x-4 py-2">状態</th>
                            <td class="border border-blue-800 w-3/4 px-4 py-2 text-center">{{ $article->status_name }}</td>
                        </tr>
                        <tr>
                            <th class="border-b border-blue-200 w-1/4 bg-blue-900 text-gray-200 x-4 py-2">更新日</th>
                            <td class="border border-blue-800 w-3/4 px-4 py-2 text-center">{{ $article->updated_at }}</td>
                        </tr>
                        <tr>
                            <th class="border-b border-blue-200 w-1/4 bg-blue-900 text-gray-200 x-4 py-2">作成日</th>
                            <td class="border border-blue-800 w-3/4 px-4 py-2 text-center">{{ $article->created_at }}</td>
                        </tr>
                        <tr>
                            <th class="border-b border-blue-800 w-1/4 bg-blue-900 text-gray-200 x-4 py-2">操作</th>
                            <td class="border border-blue-800 w-3/4 text-center">
                                <div class="flex items-center justify-around">
                                    <div>
                                        <button type="button"
                                            class="btn-green-sm"
                                            onclick="location.href='{{ route('post.edit', ['post' => $article->id]) }}'">編集</button>
                                    </div>
                                    <form action={{ route('post.destroy', ['post' => $article->id]) }} method="post"
                                        class="m-0">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="btn-red-sm">削除</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
    </div>
@endsection
