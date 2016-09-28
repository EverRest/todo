<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            return view('tasks.index', [
                'tasks' => $this->tasks->forUser($request->user()),
                'status'=>'success',
            ]);    
        } catch (Exception $e) {
            return ['status'=>'errors']; 
        }
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'task' => 'required|min:5',
            ]);
                
            $this->validate($request, [
                'status' => 'required',
            ]);

            $request->user()->tasks()->create([
                'task' => $request->task,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);

            return redirect('/tasks');
                //,[
                //'status'=>'success',
            //]);
        } catch (Exception $e) {
           //return ['status'=>'errors',];
        }    
    }

    /**
    * Update the task by id
    *
    * @param  Request  $request
    * @param  Task  $task
    * @return Response
    */
    public function update(Request $request, Task $task)
    {
        try {
            return view('task.update', [
                'task' => $task,
                'status' => 'sucess'
            ]);
        } catch (Exception $e) {
            return ['status'=>'errors'];
        }
    }

    /**
    * Save changes after updating
    *
    * @param  Request  $request
    * @return Response
    */
    public function editTask(Request $request) 
    {
        try {
           $this->validate($request, [
                'task' => 'required|min:5',
            ]);
              
            $this->validate($request, [
                'status' => 'required',
            ]);
            
            Task::where('id',$request->id)->update(['task'=>$request->task,'status'=>$request->status]);

            return redirect('/tasks');
        } catch (Exception $e) {
            return ['status'=>'errors'];
        }
    }

    /**
     * Delete all tasks by id's
     *
     * @param  Request  $request
     * @param  $ids
     * @return Response
     */
    public function deleteIds(Request $request, $ids)
    {
        foreach ($ids as $id) {
            DB::table('tasks')->where('id', $id)->delete();
        }

        return redirect('/tasks');
    }
    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function delete(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');

    }
}
