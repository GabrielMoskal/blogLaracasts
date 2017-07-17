<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    public function index() {
        $tasks = Task::all();

        return view("tasks.index", compact('tasks'));
    }

    public function show(Task $task) {
        return view('tasks.show', compact('task'));
    }

    /*
    public function show($id) {
        $task = Task::find($id);

        return view('tasks.show', compact('task'));
    }
    */

    /**
     * Alternative version of Route::get
     */
    //Route::get('/', function () {
    //    return view('welcome')->with('name', 'Laracasts');
    //});

    /**
     * Alternative version of Route::get
     */
    //Route::get('/', function () {
    //    $name = 'Jeffrey';
    //    $age = 31;
    //
    //    return view('welcome', compact('name', 'age'));
    //});

}
