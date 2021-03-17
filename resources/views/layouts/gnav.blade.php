@php
$navList = [['HOME', '/'], ['RANKING', '/ranking'], ['ABOUT', '/about'], ['COVID-19', '/contact']];
$navLogin = [['ユーザー登録', '/register'], ['ログイン', '/login']];
$currentPage = request()->path();
if (strpos('/', $currentPage) !== false) {
    $currentPage = explode('/', $currentPage)[0];
}
$gnav_type = config('const.common.BLADE.GNAV');
@endphp

@switch($disp_gnav)
    @case($gnav_type['ENABLE'])
    {{-- normal --}}
    <nav class="bg-gray-200 sticky top-0 text-black text-center">
        <div class="flex w-full">

            <ul class="pb-2 flex flex-wrap justify-around w-full max-w-screen-lg m-auto">
                @foreach ($navList as $page)
                    @if (substr($page[1], 1) === $currentPage)
                        {{-- current page --}}
                        <li>
                            <a class="pt-2 mx-3 block border-b border-transparent border-red-600">{{ $page[0] }}</a>
                        </li>
                    @else
                        <li>
                            <a class="pt-2 mx-3 block cursor-pointer nav-focus"
                                href="{{ url($page[1]) }}">{{ $page[0] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="dropdown inline-block relative lg:mr-10">
                <p class="pt-2 px-6 whitespace-nowrap inline-flex items-center">{{ Auth::check() ? Auth::user()->name : '投稿者用' }}</p>
                <div class="dropdown-content absolute hidden">
                    <ul class="mt-2 bg-white rounded-md border-gray-400 border px-3 w-full">
                        @if (!Auth::check())
                            @foreach ($navLogin as $page)
                                <li><a class="mb-2 pt-2 mx-auto block whitespace-no-wrap nav-focus"
                                        href="{{ url($page[1]) }}">{{ $page[0] }}</a></li>
                            @endforeach
                        @else
                            <li>
                                <form method="POST" name="form_logout" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="mb-2 pt-2 mx-auto block whitespace-no-wrap nav-focus"
                                        href="javascript:form_logout.submit()">ログアウト</a>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>





    @break
    @default
    {{-- global navigation less --}}
@endswitch
