<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="felx flex-col">
                    <div class="flex items-center pt-8 justify-around ssm:justify-start sm:pt-0">
                        <div class="px-4 text-lg text-gray-500 tracking-wider">
                            @yield('code')
                        </div>

                        <div class="border-r border-gray-400" style="width: 1px; height: 1.75rem;"></div>

                        <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                            @yield('message')
                        </div>

                    </div>
                    <div class="flex justify-around mt-4 text-sm text-gray-500 uppercase tracking-wider">
                        <button class="btn-http-error" onclick="location.href='{{ route('home')}}'">ホームへ</button>
                        <button class="btn-http-error ml-4" onclick="javascript:history.back();">戻る</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
