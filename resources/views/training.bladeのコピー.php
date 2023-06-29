@extends('layout.header')

@section('title', 'トレーニング')

@section('content')
  <main>
  <h2>{{ $today }}</h2>
    <p>トレーニングを記録してください</p>
      <form action="{{ route('training.create') }}" method="POST">
      @csrf
      @foreach($categories as $category)
      <section>
        
          <h2>{{ $category->name }}</h2>
          <ul>
            @if($category->name != '有酸素運動' )
              @foreach($parts as $part)
                <li>
                  <h3>{{ $part->name }}</h3>
                  @foreach($types as $type)
                    @if($type->part_id == $part->id && $type->category_id == $category->id)
                      <p><input type="checkbox" name="log[{{ $type->id }}][num]" value="{{ $type->id }}"><label for="">{{ $type->name }}</label></p>
                      @if($category->name == 'ウェイトトレーニング')
                        <input type="text" name="log[{{ $type->id }}][weight]">kg
                      @endif
                      <input type="text" name="log[{{ $type->id }}][count]">回
                      <input type="text" name="log[{{ $type->id }}][sets]">セット
                    @endif
                  @endforeach
                  
                </li>
              @endforeach
            @else
              
                
                @foreach($types as $type)
                  @if( $type->category->name == '有酸素運動' )
                  <li>
                    <p><input type="checkbox" name="[{{ $type->id }}][num]" value="{{ $type->id }}">{{ $type->name }}</p>
                    <input type="text" name="exercise[{{ $type->id }}][time]">分
                    <input type="text" name="exercise[{{ $type->id }}][distance]">km
                  </li>
                  @endif
                @endforeach
                
              
            @endif
            
          </ul>
          
          
      </section>
      @endforeach
      <textarea name="comment" id="" cols="30" rows="10" placeholder="">{{ $log_comment }}</textarea>
      <input type="submit" value="入力完了">
        </form>
  </main>
  
</body>
</html>
@endsection