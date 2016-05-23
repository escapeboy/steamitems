<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => '/', 'uses' => function () {
	$start = microtime();
     $items = \Cache::remember('items', 24*60, function(){
     	return \App\Models\Items::all();
     });
     $current_page = Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
     $perPage = request()->get('perPage', 10);
     
    $data['types'] = $items->pluck('type')->unique();
    if(request()->has('type')){
        $items = $items->whereLoose('type', request()->get('type'));
    }
    $total_items = $items->count();
    $items = $items->slice(($current_page-1) * $perPage, $perPage);
    $items = new Illuminate\Pagination\LengthAwarePaginator($items->all(), $total_items, $perPage);
    $data['items'] = $items
    ->setPath(request()->url())
    ->appends(request()->except(['page']));
    $end = microtime();
    $data['time'] = $end-$start;
    return view('welcome', $data);
}]);
