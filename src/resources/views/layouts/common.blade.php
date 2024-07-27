<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @yield('css')
</head>
<body>
    <header>
        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-icon"
            onclick="location.href='{{ isset($menuRoute) ? route($menuRoute) : '#' }}'">☰</label>
        <div class="rese-text">Rese</div>
        <div class="spacer"></div>

        @if(!isset($hideSearch) || !$hideSearch)
            <div class="search-container">
                <form action="{{ route('search') }}" method="get" class="search-form">
                    <select name="area" class="input-box">
                        <option value="">All area</option>
                        @if(isset($areas))
                            @foreach($areas as $area)
                                <option value="{{ $area }}">{{ $area }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span>|</span>

                    <select name="genre" class="input-box">
                        <option value="">All genre</option>
                        @if(isset($genres))
                            @foreach($genres as $genre)
                                <option value="{{ $genre }}">{{ $genre }}</option>
                            @endforeach
                        @endif
                    </select>
                    <span>|</span>

                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="search" class="search-input" placeholder="Search...">
                    </div>
                </form>
            </div>
        @endif
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
