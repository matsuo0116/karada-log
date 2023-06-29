@extends('layout.header')
@vite(['resources/js/app.js'])
@section('title', 'カラダログ')

@section('content')
<main id="body">
  <div class="wrapper">
  <h2 class="today">{{ $today }}</h2>
    <!-- 目標までの数値を表示  -->

    @if ( session('flash_message') && $login_user->target_weight && $login_user->target_fat_per)
  <div class="log_complete">
    <p class="message">{{ session('flash_message') }}</p>
    <p>目標体重まであと<span>{{ $login_user->target_weight -  $log->weight}}</span>kg</p>
    <p>目標体脂肪率まであと、<span>{{ $login_user->target_fat_per - $log->fat_per }}</span>%</p>
  </div>
  @endif




  <div class="body_info">
    <div class="target_info info_list">
      <h3>目標</h3>
      <p>
        体重
        <span class="red_text">{{ $login_user->target_weight }}</span>
        <span class="unit">kg</span>
      </p>
      <p>
        体脂肪
        <span class="red_text">{{ $login_user->target_fat_per }}</span>
        <span class="unit">%</span>
      </p>
    </div>
    <form action="{{ route('body.create')}} " method="POST">
      @csrf
      <div class="info_list">
        <h3>記録</h3>
        <p class="log_form">
          体重
          <input type="text" name="weight" value="{{ ($log->weight == 0 ) ? '' : $log->weight }}">
          <span class="unit">kg</span>

        </p>
          <!-- フォームエラーメッセージ -->
          @error('weight')
          <p class="error_message">{{ $message }}</p>
          @enderror
        <p class="log_form">
          体脂肪
          <input type="text" name="fat_per" value="{{ ($log->fat_per == 0 ) ? '' : $log->fat_per }}">
          <span class="unit">%</span>
          


        </p>
        @error('fat_per')
          <p class="error_message">{{ $message }}</p>
          @enderror
      </div>


      <input class="green_btn" type="submit" value="入力完了">
    </form>
  </div>



  <!-- <div class="log_complete">
    <p class="message">入力が完了しました！</p>
    <p>目標体重まであと4kg</p>
    <p>目標体脂肪率まであと、-4%</p>
  </div> -->
  



  <!-- //目標までの数値を表示  -->

  <div class="chart">
    <canvas id="myChart"></canvas>
  </div>
  <div class="chart">
    <canvas id="myChart2"></canvas>
  </div>
  </div>
</main>
@endsection