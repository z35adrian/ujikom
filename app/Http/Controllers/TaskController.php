<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Tampilkan semua task
    public function index()
    {
        $tasks = Task::all();
        return view('home', compact('tasks')); // View: home.blade.php
    }

    // Simpan task baru
    public function store(Request $request)
    {
        $task = new Task();
        $task->task_name = $request->task_name;
        $task->deadline = $request->deadline;
        $task->priority = $request->priority;
        $task->completed = false; // Default task belum selesai
        $task->save();

        return redirect()->route('home')->with('success', 'Task berhasil ditambahkan!');
    }

    // Update status task (selesai/belum selesai)
    // TaskController.php
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // Hanya update kolom 'completed'
        $task->completed = $request->has('completed') ? true : false;
        $task->save();

        return redirect()->back()->with('success', 'Task updated successfully.');
    }


    // Hapus task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('home')->with('success', 'Task berhasil dihapus!');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function updateTask(Request $request, Task $task)
    {
        $task->task_name = $request->task_name;
        $task->deadline = $request->deadline;
        $task->priority = $request->priority;
        $task->save();

        return redirect()->route('home')->with('success', 'Task berhasil diubah!');
    }
}