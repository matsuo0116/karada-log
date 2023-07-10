<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name=”description” content=”カラダログは、毎日のトレーニングと体の記録と管理を楽にするWebサービスです。今日から理想の体に近づけるよう一緒に頑張りましょう。日々のトレーニングと体の変化を記録しましょう！”>

  <meta property="og:url" content="https://karada-log.com/">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{ asset('storage/image/twitter_ogp.png') }}">
  <meta property="og:title" content="カラダログ">
  <link rel="stylesheet" href="/css/reset.css">
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  
  <title>カラダログ | @yield('title')</title>
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@500&family=Noto+Sans+JP:wght@300;600&family=Noto+Serif&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('storage/image/favicon.ico') }}">
</head>
<body>
  <header class="header">
    

    
    <h1><a href="{{ route('index') }}"><img src="{{ asset('storage/image/header_logo.svg') }}" alt="カラダログ"></a></h1>
    @guest
      <div class="login_link"><a href="{{ route('login') }}">ログインする</a></div>
    @endguest
    @auth
    <p>ようこそ、{{ Auth::user()->name }}さん</p>
    @endauth
    @auth 
  {{--<form action="{{ route('logout') }}" method="post">
    @csrf
    <button>ログアウト</button>
  </form>--}}
  @endauth


  </header>
  
  <nav>
    <ul>
      <li><a href="{{ route('index') }}/" >HOME</a></li>
      <li><a href="{{ route('training.new') }}">トレーニング</a></li>
      <li><a href="{{ route('body') }}">カラダログ</a></li>
      <li><a href="{{ route('setting') }}">設定</a></li>
    </ul>
  </nav>
  
 
  @yield('content')

  <script src="/js/app.js" defer></script>
  <!-- <script src="/js/accordion.js" defer></script> -->
  </body>
</html>