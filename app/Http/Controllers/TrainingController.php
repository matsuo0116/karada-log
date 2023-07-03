<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Type;
use App\Models\Category;
use App\Models\Exercise;
use App\Models\Part;
use App\Models\Log;
use App\Models\LogTypes;
use Carbon\Carbon;
use App\Http\Requests\TrainingRequest;

class TrainingController extends Controller
{
    public function new(TrainingRequest $request) {
        $login_user = $request->user();
        $categories = Category::all();
        $parts = Part::whereNotIn('name',['その他'])->get();
        $types = Type::all();

        // 最新のログを取得
        $today = Carbon::today()->endOfDay();
        $latestLog = Log::whereDate('created_at',$today)->where('user_id',$login_user->id)->latest()->first();
        if(isset($latestLog)){
            $log_comment = $latestLog->comment;
        } else {
            $log_comment = null;
        }
        $today = now()->format('Y年m月d日');
        $data = [
            'types' => $types,
            'categories' => $categories ,
            'parts' => $parts,
            'log_comment' => $log_comment,
            'today' => $today
        ];
        return view('training', $data);
    }

    public function create(TrainingRequest $request){   
        $login_user = $request->user();
        $logArray = $request->input('log');
        
        // $type = $request->input('type');
        
        // 今日の投稿かつ最新のものを取得
        $today = Carbon::today()->endOfDay();
        $latestLog = Log::whereDate('created_at',$today)->where('user_id',$login_user->id)->latest()->first();
        
         

        
        if(!$latestLog) {
            // 今日の投稿がなければlogを新規作成
            $log = new Log();
            $log->user_id = $login_user->id;
            $log->comment = $request->input('comment');
            //コメント欄が空欄の場合のバリデーションなど

            $log->save();
            $logId = $log->id;
        
        } else {
            // 今日の投稿があればコメントを上書き
            $logId = $latestLog->id;
            $latestLog->comment = $request->input('comment');
            $latestLog->save();
        }

        //トレーニングの入力内容をフォームから受け取りデータベースに保存
        $max_weight = [];
        foreach ($logArray as $item) {
            if(isset($item['num'])){
                $training = new LogTypes();
                $training->log_id = $logId; 
                $training->type_id = $item['num'];
                
                // 最高重量を更新した際の動き
                $my_max_weight = 0;
                $my_max_weight = LogTypes::where('type_id',$item['num'])->where('user_id', $login_user->id)->max('weight');
                if($item['weight'] > $my_max_weight ){
                    $max_weight['message'] = '最高重量を更新しました！';
                    $max_weight[$training->type->name] = $item['weight'];
                    
                } else {
                    $max_weight[$training->type->name] = '';
                }

                $training->weight = $item['weight'] ?? '0';
                $training->count = $item['count'];
                $training->sets = $item['sets'];
                $training->user_id = $login_user->id;
                $training->save();
            }
        }

        $new_exercise = $request->input('exercise');
        if($new_exercise !== null) {
            foreach ($new_exercise as $item){
                if(isset($item['num'])){
                    $exercise = new Exercise();
                    $exercise->log_id = $logId;
                    $exercise->type_id = $item['num'];
                    $exercise->time = $item['time'];
                    $exercise->distance = $item['distance'];
                    $exercise->save();
                }
            }
        }
        
        
        //今週のトレーニング回数を取得
        $last_week = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $today = Carbon::now()->endOfDay();
        $training_count = LogTypes::whereBetWeen('created_at',[$last_week, $today])
        ->where('user_id', $login_user->id)
        ->count(DB::raw('DISTINCT DATE(created_at)'));
        
        return redirect('/')->with('flash_message',
            [ 'training_count' => $training_count,
              'max_weight' => $max_weight  ]);
        
        
    }
}
