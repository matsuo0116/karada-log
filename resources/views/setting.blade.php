@extends('layout.header')

@section('title', '設定')

@section('content')
<main id="setting">
  <div class="wrapper">
  <h2 class="sub_title">プロフィール設定</h2>
  <div class="setting_group">
    <div class="setting_avatar">
      <div class="current_avatar">
        <p>アイコン画像</p>
        @if($user->avatar == null)
        <img class="prof_img" src="/storage/uploads/no_image.png" alt="">
        @else
        <img class="prof_img" src="{{ asset($user->avatar) }}" alt="">
        @endif
      </div>
    
    
    <form action="{{ route('setting.upload') }}" enctype="multipart/form-data" method="post">
      @csrf
      
      <input class="image_choice" type="file" name="image">
      <button class="green_btn">画像をアップロード</button>
      @error('image')
      <p class="error_message">{{ $message }}</p>
      @enderror
    </form>
    </div>

    <form action="{{ route('setting.change') }}" method="post">
      @csrf

      <div class="form_item">
        目標体重
        <input type="text" name="target_weight" value="{{ $user->target_weight }}">
        
        
      </div>
      <p class="annotation">(小数第一位まで入力できます)</p>
      @error('target_weight')
        <p class="error_message">{{ $message }}</p>
        @enderror
      <div class="form_item">
        目標体脂肪率<input type="text" name="target_fat" value="{{ $user->target_fat_per }}">
        
        
      </div>
      @error('target_fat')
        <p class="error_message">{{ $message }}</p>
        @enderror
      <p class="annotation">(小数第一位まで入力できます)</p>
      <div class="form_item">
        年齢<input type="text" name="age" value="{{ $user->age }}">
        
      </div>
      @error('age')
      <p class="error_message">{{ $message }}</p>
        @enderror
      
      <div class="form_item">
        身長<input type="text" name="height" value="{{ $user->height }}">
        
        
      </div>
      <p class="annotation">(小数第一位まで入力できます)</p>
      @error('height')
        <p class="error_message">{{ $message }}</p>
        @enderror
      <input class="green_btn" type="submit" value="設定変更">
    </form>
    
  </div>

  @include('profile.edit')
  @auth 
  <form action="{{ route('logout') }}" method="post">
    @csrf
    <button class="logout_btn">ログアウト</button>
  </form>
  @endauth
  <div>
  <a href="https://twitter.com/karada_log2023" class="logout_btn" style="width:120px; margin-bottom:16px;">お問い合わせ</a>
  <p style="font-size:14px; color:#999; text-align:center; line-height:1.4;">現在Webサイトについてのご質問・お問い合わせは一時的にTwitterのDMにて受け付けております。<br>今後、サイト内にお問い合わせフォームを設置予定です。</p>
  </div>
  
  </div>
</main>
@endsection