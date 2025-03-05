<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    $tasks = Task::orderBy('created_at', 'asc')->get();


    return view('tasks.index')->withTasks($tasks);
});

Route::post('/task', function (Request $request) {
     $validator = Validator::make($request->all(),[
        'name' => 'required|max:255'
     ]);

     if($validator->fails()) {
        return redirect('/')
        ->withInput()
        ->withErrors($validator);
     }

     Task::create([
        'name' => $request->name
     ]);

     return redirect('/');

});

Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
    return redirect('/');
});


// Route::get('/', funtion () {
//     return view('/');
// });

// Route::post('/task', function(Request $request) {
//  return redirect('/');
// });

// Route::delete('/task/{task}', function(Task $task) {
//     return redirect('/');
// });


