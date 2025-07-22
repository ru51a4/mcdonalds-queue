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
        $tasks = \App\Models\Tasks::where(['status' => 1, 'user_id' => \Auth::user()->id])->get();
        $t = $tasks[0] ?? null;
        
        return view('home', compact('t'));
    }  
    public function dashboard()
    {
        $tasks = \App\Models\Tasks::where(['status' => 0])->get();
        $tasks_currrent = \App\Models\Tasks::where(['status' => 1])->get();
        
        return view('dashboard', compact('tasks','tasks_currrent'));
    }

     public function shiftTask()
    {
        $tasks = \App\Models\Tasks::where(['status' => 1, 'user_id' => \Auth::user()->id])->get();
        if(count($tasks)){ 
        $tasks[0]->user_id = \Auth::user()->id;
        $tasks[0]->status = 2;
        $tasks[0]->save();
        
        }
        $tasks = \App\Models\Tasks::where(['status' => 0])->get();
        if(!count($tasks)){
         return redirect('index');        
        }
        $tasks[0]->user_id = \Auth::user()->id;
        $tasks[0]->status = 1;
        $tasks[0]->save();

        return redirect('home');
    }

    public function gget()
    {
        $tasks =  \App\Models\TypeTask::all();
        return view('gget', compact('tasks'));
    }


    public function new($id)
    {
        $generateMcDonaldCode = function ($length = 6) {
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

    public function test()
    {

    }


}
