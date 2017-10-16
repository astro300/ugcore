<?php
Route::post('/select-carreraFacultad/{faculty}','Ajax\SelectController@carreraFacultad')
    ->where(['faculty'=> '[0-9]+']);


Route::post('/catalog/dataBySelectSingle/{father}',function ($father=0){

    $data=\UGCore\Core\Entities\Comun\SelectsBasics::where('father','=',$father)
        ->orderBy('code','DESC')
        ->select('description as name','id')->pluck('name','id')->toArray();

    return response()->json(['data'=>$data],200);
})->where(['father'=>'[0-9]+']);