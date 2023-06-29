@extends('layout.header')

@section('title', 'トレーニング')

@section('content')



<main id="training">
  <div class="wrapper">
  <h2 class="today">{{ $today }}</h2>
  <form action="{{ route('training.create') }}" method="POST">
    @csrf
    <div id="app" v-cloak>
      <!-- タブ選択ボタン -->
      <div class="tabgroup">
        <ul class="tabnav">
          <li @click="select('1')" v-bind:class="{'active': show == '1'}">
            ウェイト
          </li>
          <li @click="select('2')" v-bind:class="{'active': show == '2'}">
            自重トレ
          </li>
          <li @click="select('3')" v-bind:class="{'active': show == '3'}">
            有酸素運動
          </li>
        </ul>



        <div class="tabcontent">

          @include('layout.error')

          <div v-show="show == '1'" class="tabcontent-list" id="my_log">
            @foreach($parts as $part)
            <div class="training_group">
              <h3 class="">{{ $part->name  }}</h3>
              <div class="open-form type_list">
                @foreach($types as $type)
                @if($type->category->name == 'ウェイトトレーニング' && $type->part_id == $part->id )
                <p class="type_name">
                  <input class="training_check" type="checkbox" id="check{{ $type->id }}" name="log[{{ $type->id }}][num]" value="{{ $type->id }}" {{ old('log.'.$type->id.'.num') ? 'checked' : '' }}>
                  <label for="check{{ $type->id }}">{{ $type->name }}</label>
                </p>
                <div class="form_item_list  {{ old('log.'.$type->id.'.num') ? 'open' : '' }}" id="text_form{{ $type->id }}">
                  <div class="form_item">
                    <input type="text" name="log[{{ $type->id }}][weight]" value="{{ old('log.'.$type->id.'.weight') }}"><span>kg</span>
                  </div>
                  <div class="form_item">
                    <input type="text" name="log[{{ $type->id }}][count]" value="{{ old('log.'.$type->id.'.count') }}"><span>回</span>
                  </div>
                  <div class="form_item">
                    <input type="text" name="log[{{ $type->id }}][sets]" value="{{ old('log.'.$type->id.'.sets') }}"><span>セット</span>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
            </div>

            @endforeach
          </div>

          <div v-show="show == '2'" class="tabcontent-list" id="my_log">
            @foreach($parts as $part)
            <div class="training_group">
              <h3 class="">{{ $part->name  }}</h3>
              <div class="open-form type_list">
                @foreach($types as $type)
                @if($type->category->name == '自重' && $type->part_id == $part->id )
                <p class="type_name">
                  <input type="hidden" name="log[{{ $type->id }}][weight]" value="0">
                  <input type="checkbox" class="training_check" name="log[{{ $type->id }}][num]" id="check{{ $type->id }}" value="{{ $type->id }}" {{ old('log.'.$type->id.'.num') ? 'checked' : '' }}>
                  <label for="check{{ $type->id }}">{{ $type->name }}</label>
                </p>
                <div class="form_item_list {{ old('log.'.$type->id.'.num') ? 'open' : '' }}" id="text_form{{ $type->id }}">
                  <div class="form_item">
                    <input type="text" name="log[{{ $type->id }}][count]" value="{{ old('log.'.$type->id.'.count') }}">回
                  </div>
                  <div class="form_item">
                    <input type="text" name="log[{{ $type->id }}][sets]" value="{{ old('log.'.$type->id.'.sets') }}">セット
                  </div>
                </div>
                @endif
                @endforeach
              </div>
            </div>
            @endforeach

          </div>

          <div v-show="show == '3'" class="tabcontent-list" id="my_log">
            <div class="training_group">
              @foreach($types as $type)
              @if($type->category->name == '有酸素運動')
              <p class="type_name">
                <input id="check{{ $type->id }}" class="training_check" type="checkbox" name="exercise[{{ $type->id }}][num]" value="{{ $type->id }}" {{ old('exercise.'.$type->id.'.num') ? 'checked' : '' }}>
                <label for="check{{ $type->id }}">{{ $type->name }}</label>
              </p>
              <div class="form_item_list {{ old('exercise.'.$type->id.'.num') ? 'open' : '' }}" id="text_form{{ $type->id }}">
                <div class="form_item">
                  <input type="text" name="exercise[{{ $type->id }}][time]" value="{{ old('exercise.'.$type->id.'.time') }}">分
                </div>
                <div class="form_item">
                  <input type="text" name="exercise[{{ $type->id }}][distance]" value="{{ old('exercise.'.$type->id.'.distance') }}">km
                </div>
              </div>
              @endif
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="training_comment">
      <textarea class="log_comment" name="comment" id="" cols="30" rows="10" placeholder="">{{ $log_comment }}</textarea>
      <input class="green_btn" type="submit" value="入力完了">
    </div>

  </form>
  </div>
</main>
@endsection