<?php

namespace App\Http\Controllers;

use App\Service\functions;
use Auth;
use App\Models\Tasks;
use App\Models\TypeTask;
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
        foreach (Auth::user()->type as $t) {
            $ids[] = $t->id;
        }
        $tasks = Tasks::where(['status' => 1, 'user_id' => Auth::user()->id])->whereIn('type', $ids)->get();
        $t = $tasks[0] ?? null;
        $disabled = Tasks::where(['status' => 0])->whereIn('type', $ids)->count() == 0;
        return view('home', compact('t', 'disabled'));
    }

    public function dashboard()
    {
        $tasks = Tasks::where(['status' => 0])->get();
        $tasks_currrent = Tasks::where(['status' => 1])->get();

        return view('dashboard', compact('tasks', 'tasks_currrent'));
    }

    public function shiftTask()
    {
        $ids = [];
        foreach (Auth::user()->type as $t) {
            $ids[] = $t->id;
        }
        $tasks = Tasks::where(['status' => 1, 'user_id' => \Auth::user()->id])->whereIn('type', $ids)->get();
        if (count($tasks)) {
            $tasks[0]->user_id = Auth::user()->id;
            $tasks[0]->status = 2;
            $tasks[0]->save();

        }
        $tasks = Tasks::where(['status' => 0])->whereIn('type', $ids)->get();
        if (!count($tasks)) {
            return redirect('home');
        }
        $tasks[0]->user_id = Auth::user()->id;
        $tasks[0]->status = 1;
        $tasks[0]->save();

        return redirect('home');
    }

    public function leave()
    {
        $ids = [];
        foreach (Auth::user()->type as $t) {
            $ids[] = $t->id;
        }
        $tasks = Tasks::where(['status' => 1, 'user_id' => Auth::user()->id])->whereIn('type', $ids)->get();
        if (count($tasks)) {
            $tasks[0]->user_id = Auth::user()->id;
            $tasks[0]->status = 2;
            $tasks[0]->save();
        }

        return redirect('home');
    }

    public function gget()
    {
        $tasks = TypeTask::all();
        return view('gget', compact('tasks'));
    }


    public function new($id)
    {
        $task = new Tasks();
        $task->type = $id;
        $task->uuid = functions::generateMcDonaldCode();
        $task->status = 0;
        $task->save();
        return view('code', ['code' => $task->uuid]);
    }

    public function setting()
    {
        $tasks = TypeTask::all();
        $tt = Auth::user()->type;
        $t = [];
        foreach ($tt as $item) {
            $t[$item->id] = true;
        }
        return view('setting', compact('tasks', 't'));
    }

    public function add(Request $request)
    {
        $task = new TypeTask();
        $task->name = $request->name;
        $task->save();
        return redirect('setting');
    }

    public function toggle(TypeTask $task)
    {
        Auth::user()->type()->toggle($task);
        return redirect('setting');
    }


    public function delete(TypeTask $task)
    {
        foreach ($task->taskss as $t) {
            $t->delete();
        }
        $task->delete();
        return redirect('setting');
    }


}
