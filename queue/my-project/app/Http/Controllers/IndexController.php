<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use App\Models\Post;
use App\Models\Status;
use App\Models\User;
use App\Service\Auth;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;


class IndexController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return Responsable
     */
    public function index()
    {
        $ids = [];
        foreach(\Auth::user()->type as $t){
            $ids[] = $t->id;
        }
        $tasks = \App\Models\Tasks::where(['status' => 1, 'user_id' => \Auth::user()->id])->whereIn('type', $ids)->get();
        $t = $tasks[0] ?? null;
        $disabled = \App\Models\Tasks::where(['status' => 0])->whereIn('type', $ids)->count() == 0;     
        return view('home', compact('t', 'disabled'));
    }  
    public function dashboard()
    {
        $tasks = \App\Models\Tasks::where(['status' => 0])->get();
        $tasks_currrent = \App\Models\Tasks::where(['status' => 1])->get();
        
        return view('dashboard', compact('tasks','tasks_currrent'));
    }

     public function shiftTask()
    {   
        $ids = [];
        foreach(\Auth::user()->type as $t){
            $ids[] = $t->id;
        }
        $tasks = \App\Models\Tasks::where(['status' => 1, 'user_id' => \Auth::user()->id])->whereIn('type', $ids)->get();
        if(count($tasks)){ 
        $tasks[0]->user_id = \Auth::user()->id;
        $tasks[0]->status = 2;
        $tasks[0]->save();
        
        }
        $tasks = \App\Models\Tasks::where(['status' => 0])->whereIn('type', $ids)->get();
        if(!count($tasks)){
         return redirect('home');        
        }
        $tasks[0]->user_id = \Auth::user()->id;
        $tasks[0]->status = 1;
        $tasks[0]->save();

        return redirect('home');
    }

    public function leave()
    {
         $ids = [];
        foreach(\Auth::user()->type as $t){
            $ids[] = $t->id;
        }
        $tasks = \App\Models\Tasks::where(['status' => 1, 'user_id' => \Auth::user()->id])->whereIn('type', $ids)->get();
        if(count($tasks)){ 
          $tasks[0]->user_id = \Auth::user()->id;
          $tasks[0]->status = 2;
          $tasks[0]->save();
        }

        return redirect('home');
    }

    public function gget()
    {
        $tasks =  \App\Models\TypeTask::all();
        return view('gget', compact('tasks'));
    }


    public function new($id)
    {
        $generateMcDonaldCode = function ($length = 4) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $code = '';
        
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $code;
    };
        $task = new \App\Models\Tasks();
        $task->type = $id;
        $task->uuid = $generateMcDonaldCode();
        $task->status = 0;
        $task->save();
        return view('code', ['code'=>$task->uuid]);
    }

    public function setting()
    {
        $tasks = \App\Models\TypeTask::all();
        $tt = \Auth::user()->type;
        $t = [];
        foreach($tt as $item){
            $t[$item->id] = true;
        }
        return view('setting', compact('tasks', 't'));
    }

    public function add(Request $request)
    {
        $task = new \App\Models\TypeTask();
        $task->name = $request->name;
        $task->save();
        return redirect('setting');
    }
    public function toggle(\App\Models\TypeTask $task)
    {
       \Auth::user()->type()->toggle($task);
       return redirect('setting');
    }


    public function delete(\App\Models\TypeTask $task)
    {
        foreach($task->taskss as $t){
            $t->delete();
        }   
        $task->delete();
        return redirect('setting');
    }


}
