<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function chartGet(Request $request) {
        
        $login_user = $request->user();

        //何日分表示するか
        $days = 30;
        $days--;

        //体重をデータベースから取得
        $last_week = Carbon::today()->subDays($days);
        $logs = Log::select('weight','fat_per','created_at')
        ->where('user_id',$login_user->id)
        ->where('created_at', '>=',$last_week)
        ->orderBy('created_at', 'desc')
        ->get();

        //配列に格納
        $data1 = [];
        $data2 = [];
        //遡ってテーブルからログを取得
        for($i=0; $i<=$days; $i++){
            $date = new Carbon('-'.$i.' day'); 
            $found1 = false;
            $found2 = false;
            foreach($logs as $row){
                
                //体重・体脂肪のデータが存在していれば配列に追加
                if($row->weight && $row->created_at->toDateString() == $date->toDateString()){
                    array_unshift($data1,$row->weight) ;
                    $found1 = true;
                    // break;
                }
                if($row->fat_per && $row->created_at->toDateString() == $date->toDateString()){
                    array_unshift($data2,$row->fat_per) ;
                    $found2 = true;
                    // break;
                }
            }

            //データがなければnullを追加
            if(!$found1){
                array_unshift($data1, null);
            }
            if(!$found2){
                array_unshift($data2, null);
            }
        }



        
        //JavaScriptに配列を送る
        return  [
            'data1' => $data1,
            'data2' => $data2,
        ];
    }
}
