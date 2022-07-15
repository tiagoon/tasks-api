<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:14',
        ]);

        try {
            $todo = User::find(auth()->user()->id);
            $todo->name = $request->name;
            $todo->phone = $request->phone;
            $todo->save();

            return response()->json([
                'message' => 'Perfil atualizado com sucesso!'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Erro ao atualizar '
            ], 400);
        }
    }

    public function destroy()
    {
        $todo = User::find(auth()->user()->id);
        $todo->delete();

        return response()->json([
            'message' => 'Conta excluída com sucesso!'
        ]);
    }
}
