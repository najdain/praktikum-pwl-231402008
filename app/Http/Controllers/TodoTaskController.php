<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TodoTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('home', [
            'tasks' => $tasks,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'task' => 'required|min:5',
            ],
            [
                'task.required' => 'Tugas harus diisi',
                'task.min'      => 'Tugas minimal 5 karakter',
            ]
        );

        Task::create([
            'task'    => $request->task,
            'tanggal' => NOW(),
        ]);

        return redirect('/');
    }

    // public function deleteTask($id)
    // {
    //     $task = Task::findOrFail($id);
    //     $task->delete();
        
    //     return redirect('/');
    // } 
    
    public function deleteTask( $task)
    {
        Task::where('id', $task)->delete();
        return redirect('/');
    }
    
}
