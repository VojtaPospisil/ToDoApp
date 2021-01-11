<?php

namespace App\Http\Controllers\Admin;

use App\Status;
use App\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            Redirect::to('admin.login')->send();
        }

        // Prozatím akltualizuje status pro prošlé úkoly
        $unfinished = Task::select('id')->where('due_date', '=', Carbon::today()->toDateString())->get()->toArray();
        Task::whereIn('id', $unfinished)->update(['status_id' => Status::UNFINISHED]);

        // Nedokončené úkoly + Úkoly do dnešního data
        $todayTasks = Task::today();
        $unfinishedTasks = Task::unfinished();

        return view('overview.index', compact('todayTasks', 'unfinishedTasks'));
    }
}
