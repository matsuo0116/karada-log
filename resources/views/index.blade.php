@extends('layout.header')

@section('title', '日々のトレーニングの記録を簡単に！')

@section('content')

<div id="app" v-cloak>

<!-- 最高重量更新の際のメッセージ -->
@if (session('flash_message'))
    <div v-show="!modal" id="" class="window encourage">

      <div class="window_bg" v-on:click="modalClose"></div>
      <div class="window_content">
        <h3>お疲れ様です！</h3>
        @foreach(session('flash_message')['max_weight'] as $key => $value )
        @if($key == 'message')
        <p class="highlight">{{ $value }}</p>
        @elseif($value)
        <p class="max_weight">{{ $key }}{{ $value }}kg</p>
        @endif
        @endforeach

        <p class="highlight">今週{{ session('flash_message')['training_count'] }}回目のトレーニングを完了しました！</p>
      </div>

    </div>

    @endif

<div class="circle_link notification">
    <!-- お知らせボタン -->
    @auth


      <a href="{{ route('notification') }}" class="green_btn {{ ($notification > 0) ? 'inform': '' }}"><i class="fa-solid fa-bell" style="color: #ffffff;"></i></a>
 
 
    @endauth
  </div>
  
    <div class="circle_link new_log">
      <button v-on:click="newLogCreate" class="green_btn">＋</a>
    </div>
    <div v-show="newLog" class="new_log_link window">

      <div class="window_bg" v-on:click="newLogCreate"></div>
      <div class="window_content">
        <a href="{{ route('training.new') }}" class="green_btn">今日のトレーニングを記録</a>
        <a href="{{ route('body') }}" class="green_btn">今日のカラダログを記録</a>
      </div>

    </div>
      
<main id="top">
  

    <!-- タブ選択ボタン -->
    <div class="tabgroup">
      <ul class="tabnav">
        <li @click="select('1')" v-bind:class="{'active': show == '1'}">
          マイ履歴
        </li>
        <li @click="select('2')" v-bind:class="{'active': show == '2'}">
          タイムライン
        </li>
      </ul>

      <!-- マイ履歴 -->
      <div class="tabcontent">
        <div v-if="show == '1'" class="tabcontent-list" id="my_log">
          <section>
            @guest
            <p class="welcome_message">カラダログは、毎日のトレーニングと体の記録と管理を楽にするWebサービスです。<br>今日から理想の体に近づけるよう一緒に頑張りましょう。日々のトレーニングと体の変化を記録しましょう！</p>
            <a class="green_btn" href="{{ route('register') }}">登録して<br>トレーニングを記録する</a>
            @endguest

            @auth
            <ul class="log_list">
              @foreach ($my_logs as $log)
              <li>
                <a href="{{ route('log.show', [ 'id' => $log->id ]) }}">
                  <h2>{{ $log->created_at->format('Y年m月d日')}}</h2>
                  @if($log->weight && $log->fat_per )
                  <h3>カラダログ</h3>
                  <p>体重:{{ $log->weight }}kg / 体脂肪:{{ $log->fat_per }}%</p>

                  @endif

                  <h3>トレーニング</h3>
                  <ul class="training_list">
                    @foreach($log->types as $type)
                    <li>
                      {{ $type->name }}
                      {{ $type->pivot->weight != null ? $type->pivot->weight.'kg' : ''}}
                      {{ $type->pivot->count }}回
                      {{ $type->pivot->sets }}セット
                    </li>
                    @endforeach
                    @foreach($log->exercises as $exercise)
                    <li>
                      {{ $exercise->type->name }}
                      {{ $exercise->time }}分
                      {{ $exercise->distance }}km
                    </li>
                    @endforeach
                  </ul>





                  <p>{{ $log->comment }} </p>
                </a>
              </li>
              @endforeach
            </ul>
            @endauth
          </section>
        </div>

        <!-- タイムライン・コミュニティ機能 -->
        <div v-else-if="show == '2'" class="tabcontent-list" id="timeline">
          <section>
            <ul class="log_list">
              @foreach ($logs as $log)
              <li>
                <a href="{{ route('log.show', [ 'id' => $log->id ]) }}" class="log_link">
                  <div class="icon">
                    @if($log->user->avatar == null)
                    <img class="prof_img" src="/storage/uploads/no_image.png" alt="">
                    @else
                    <img class="prof_img" src="{{ asset($log->user->avatar) }}" alt="">
                    @endif
                  </div>
                  <div class="text">
                    <div class="log_user">
                      <p>{{ $log->user->name }}</p>
                      <span>{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                    @if($log->weight && $log->fat_per )
                    <h3>カラダログ</h3>
                    <p>体重:{{ $log->weight }}kg / 体脂肪:{{ $log->fat_per }}%</p>

                    @endif
                    <ul class="training_list">
                      <h3>トレーニング</h3>
                      @foreach($log->types as $type)
                      <li>
                        {{ $type->name }}
                        {{ $type->pivot->weight != null ? $type->pivot->weight.'kg' : ''}}
                        {{--{{ $type->pivot->weight.'kg'}}--}}
                        {{ $type->pivot->count }}回
                        {{ $type->pivot->sets }}セット
                      </li>
                      @endforeach
                      @foreach($log->exercises as $exercise)
                      <li>
                        {{ $exercise->type->name }}
                        {{ $exercise->time }}分
                        {{ $exercise->distance }}km
                      </li>
                      @endforeach
                    </ul>


                    <p>{{ $log->comment }} </p>
                  </div>

                </a>
                <!-- いいねボタン -->
                @auth
                <div id="like">
                  <form action="{{ route('like.add', ['id' => $log->id ]) }}" method="post">
                    @csrf
                    <button type="submit" class="like-button {{ $my_like[$log->id] ? 'like' : 'dislike' }}">いいね♡</button>
                    <span>{{ $like_counts[$log->id] }}</span>
                  </form>
                </div>
                @endauth
              </li>
              @endforeach
            </ul>







          </section>
        </div>

      </div>
    </div>
    

  


  




</main>
</div>
@endsection