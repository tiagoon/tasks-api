<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->orderBy('created_at', 'desc')->get();
        return response($tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:140'
        ]);

        try {
            $request->user()->tasks()->create([
                'title' => $request->title
            ]);
            return response()->json(['message' => 'Tarefa criada com sucesso'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao criar tarefa ' . $th->getMessage()], 500);
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'string|min:3|max:140',
            'completed' => 'boolean',
        ]);

        $data = [
            'updated_at' => now(),
        ];

        if (isset($request->title)) {
            $data['title'] = $request->title;
        }

        if (isset($request->completed)) {
            $data['completed'] = $request->completed;
        }

        try {
            $task = $request->user()->tasks()->findOrFail($id);
            $task->update($data);
            return response()->json(['message' => 'Tarefa atualizada com sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao atualizar tarefa ' . $th->getMessage()], 500);
        }
    }

    public function destroy($id, Request $request)
    {
        try {
            $task = $request->user()->tasks()->findOrFail($id);
            $task->delete();
            return response()->json(['message' => 'Tarefa deletada com sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao deletar tarefa ' . $th->getMessage()], 500);
        }
    }
}
