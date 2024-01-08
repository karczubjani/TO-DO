<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    
    public function index()
    {
        $todos = Todo::all();
        return view('/todos.index', [
            'todos' => $todos
        ]);
    }
    public function create()
    {
        return view('/todos.create');
    }

    public function store(TodoRequest $request)
    {

        User::find(Auth::user()->id)->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => 0
        ]);

        // Todo::create([
        //   'title' => $request->title,
        //   'description' => $request->description,
        //   'is_completed' => 0
        // ]);

         $request->session()->flash('alert-success', 'Todo sikeresen létrehozva');

         return redirect()->route('todos.index');
    }

    function user(){
        return $this->belongsTo(User::class);
    }

    public function show($id)
    {
        $todo = Todo::find($id);
        if(! $todo){
            request()->session()->flash('error', 'Todo sikeresen létrehozva');
            return redirect()->route('todos.index')->withErrors([
                'error' => 'Todo nem található'
            ]);
        }
        return view('todos.show', ['todo'=>$todo]);
    }

    public function edit($id)
    {
        $todo = Todo::find($id);
        if(! $todo){
            request()->session()->flash('error', 'Todo nem található');
            return redirect()->route('todos.index')->withErrors([
                'error' => 'Todo nem található'
            ]);
        }
        return view('todos.edit', ['todo'=>$todo]);
    }

    public function update(TodoRequest $request)
    {
        $todo = Todo::find($request->todo_id);
        if(! $todo){
            request()->session()->flash('error', 'Todo nem található');
            return redirect()->route('todos.index')->withErrors([
                'error' => 'Todo nem található'
            ]);
        }

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->is_completed
        ]);

        $request->session()->flash('alert-info', 'Todo sikeresen módosítva');
        return redirect()->route('todos.index');
    }

    public function destroy(Request $request)
    {
        $todo = Todo::find($request->todo_id);
        if(! $todo){
            request()->session()->flash('error', 'Todo nem található');
            return redirect()->route('todos.index')->withErrors([
                'error' => 'Todo nem található'
            ]);
        }
        $todo->delete();
        $request->session()->flash('alert-info', 'Todo sikeresen törölve');
        return redirect()->route('todos.index');
    }
}
