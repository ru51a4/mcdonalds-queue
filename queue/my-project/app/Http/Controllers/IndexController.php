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
     * Страница ЛК сотрудника
     */
    public function index()
    {
        $tasks = Tasks::where(['status' => 1, 'user_id' => Auth::user()->id])
            ->whereIn('type', Auth::user()->getTypeTaskIds())
            ->first();
        $t = $tasks ?? null;
        $disabled = !Tasks::where(['status' => 0])
            ->whereIn('type', Auth::user()->getTypeTaskIds())
            ->exists();
        return view('home', compact('t', 'disabled'));
    }

    /**
     * Страница Дешбоард
     */
    public function dashboard()
    {
        $tasks = Tasks::where(['status' => 0])
            ->get();
        $tasks_currrent = Tasks::where(['status' => 1])
            ->get();

        return view('dashboard', compact('tasks', 'tasks_currrent'));
    }

    /**
     * Контроллер - закончить текущий талон && получить следующий талон
     */
    public function shiftTask()
    {
        $tasks = Tasks::where(['status' => 1, 'user_id' => \Auth::user()->id])
            ->whereIn('type', Auth::user()->getTypeTaskIds())
            ->first();
        if ($tasks) {
            $tasks->user_id = Auth::user()->id;
            $tasks->status = 2;
            $tasks->save();
        }
        $tasks = Tasks::where(['status' => 0])
            ->whereIn('type', Auth::user()->getTypeTaskIds())
            ->first();
        if (!$tasks) {
            return redirect('home');
        }
        $tasks->user_id = Auth::user()->id;
        $tasks->status = 1;
        $tasks->save();

        return redirect('home');
    }

    /**
     * Ручка - закончить текущий талон.
     */
    public function leave()
    {
        $tasks = Tasks::where(['status' => 1, 'user_id' => Auth::user()->id])
            ->whereIn('type', Auth::user()->getTypeTaskIds())
            ->first();
        if ($tasks) {
            $tasks->user_id = Auth::user()->id;
            $tasks->status = 2;
            $tasks->save();
        }

        return redirect('home');
    }

    /**
     * Страница Взять талон
     */
    public function gget()
    {
        $tasks = TypeTask::all();
        return view('gget', compact('tasks'));
    }

    /**
     * Ручка - создания талона
     */
    public function new($id)
    {
        $task = new Tasks();
        $task->type = $id;
        $task->uuid = functions::generateMcDonaldCode();
        $task->status = 0;
        $task->save();
        return view('code', ['code' => $task->uuid]);
    }

    /**
     * Страница Настройки
     */
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

    /**
     * Ручка создать тип талонов
     */
    public function add(Request $request)
    {
        $task = new TypeTask();
        $task->name = $request->name;
        $task->save();
        return redirect('setting');
    }

    /**
     * Ручка - переключения возможности обработки типа талона сотрудником
     */
    public function toggle(TypeTask $task)
    {
        Auth::user()
            ->type()
            ->toggle($task);
        return redirect('setting');
    }

    /**
     * Ручка удаления типа талона
     */
    public function delete(TypeTask $task)
    {
        foreach ($task->taskss as $t) {
            $t->delete();
        }
        $task->delete();
        return redirect('setting');
    }


}
