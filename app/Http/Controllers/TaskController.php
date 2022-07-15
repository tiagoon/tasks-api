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
            'title' => 'required|string|min:3'
        ]);

        try {
            $request->user()->tasks()->create([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            return response()->json(['message' => 'Tarefa criada com sucesso'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro ao criar tarefa ' . $th->getMessage()], 500);
        }
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean',
        ]);

        try {
            $task = $request->user()->tasks()->findOrFail($id);
            $task->update([
                'title' => $request->title,
                'completed' => $request->completed,
                'updated_at' => now(),
            ]);
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
