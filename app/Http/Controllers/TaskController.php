<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::orderBy('created_at','DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // unused
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // make sure title is defined and fits in length
        if(strlen($request->input('title')) < 2 || strlen($request->input('title')) > 140) {
            abort(400,"Title not valid");
        }

        $task = new Task;
        $task->title = $request->input('title');
        $task->body = null !== $request->input('body') ? $request->input('body') : $task->body;
        $task->labels = null !== $request->input('labels') ? $request->input('labels') : $task->labels;
        $task->save();
        
        return $task->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // unused
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // unused
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // make sure title is defined and fits in length
        if(strlen($request->input('title')) < 2 || strlen($request->input('title')) > 140) {
            abort(400,"Title not valid");
        }

        $task = Task::find($id);
        $task->title = $request->input('title');
        $task->body = null !== $request->input('body') ? $request->input('body') : $task->body;
        $task->labels = null !== $request->input('labels') ? $request->input('labels') : $task->labels;
        $task->save();
        
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        
        return "success";
    }
    
    /**
     * Search for a set of resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $term = $request->input('term');
        $tasks = Task::where('title','like',"%$term%")
                    ->orWhere('body','like',"%$term%")
                    ->orWhere('labels','like',"%$term%")
                    ->get();
        return $tasks;
    }
}
