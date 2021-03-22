@extends('layouts.master')
@php
$disp_header = config('const.BLADE.HEADER.NONE');
$disp_gnav = config('const.BLADE.GNAV.NONE');
@endphp

@section('content')

    @include('navigation-menu')

    <div class="w-full relative mt-0 shadow-2xl rounded bg-white overflow-hidden">

    <!-- upload bar -->
    <div class="bg-gray-200 top-0 text-black text-center w-full mb-6 z-30">
        <form class="lg:p-5 sm:flex justify-around items-center" action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-full sm:w-1/3 p-4">
                @error('image')
                    <p class="text-red-600 m-2">{{ $message }}</p>
                @enderror
                <input class="sm:pl-10 m-2 cursor-pointer" type="file" name="image" accept="image/png, image/jpeg, image/png, image/gif">
                {{-- <input type="file" name="image" accept="image/*"> --}}
            </div>
            <div class="w-full sm:w-1/3 mt-4 sm:mt-0 pb-6 sm:pb-0">
                <button type="submit" class="btn-white">アップロード</button>
            </div>
        </form>
    </div>

    <div class="px-4 py-6">

        <div>
            <h2 class="text-2xl font-semibold">画像一覧</h2>
            <hr>
        </div>

        @error('page')
            <p class="text-red-600">
                {{ $message }}
            </p>
        @enderror

        <!-- image cards -->
        <div>
            <div class="relative items-center justify-center">

            <div class="sm:flex flex-wrap mx-auto my-auto w-full justify-around items-end mt-8">
                @foreach ($images as $image)

                    <div class="sm:w-1/2 lg:w-1/3 m-0">
                    <div class="sm:m-4 shadow-md hover:shadow-lg hover:bg-gray-100 rounded-lg bg-white my-12">
                        <!-- Card Image -->
                        <a href="{{ route('images.show', $image->id) }}">
                            <img src="{{ asset('/storage/images/' . $image->name) }}" alt="{{ $image->description }}"
                                class=" w-full object-contain"></a>

                        <!-- Card Content -->
                        <div class="p-4 w-full">
                            <p class="text-justify">{{ $image->updated_at }}</p>
                            <div class="mt-3">
                                @if (Session::has('editing_status'))
                                <div style="display:inline-block;">
                                    <form action={{ session('transition_source') }} method="post" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="image" value="{{ $image->name }}">
                                        <button type="submit" class="btn-yellow">選択</button>
                                    </form>
                                </div>
                                @endif
                                <form action={{ route('image.del-req') }} method="post" style="display:inline-block;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $image->id }}">
                                    <button type="submit" class="btn-red">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>

    {{ $images->links('layouts.paginator.default') }}

    </div>

@endsection
