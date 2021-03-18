@extends('layouts.master')
@php
$disp_header = config('const.BLADE.HEADER.NONE');
$disp_gnav = config('const.BLADE.GNAV.NONE');
@endphp

@section('content')
    @include('navigation-menu')
    <div class="w-full relative mt-0 shadow-2xl rounded my-12 bg-white overflow-hidden">
        @include('poster.parts.form_article', [$mode = 'edit'])
    </div>
@endsection
