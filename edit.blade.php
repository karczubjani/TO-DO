@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">TO-DO App</div>

                <div class="card-body">
                    <h4>Szerkesztés</h4>
                <form method="post" action="{{ route('todos.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                    <div class="mb-3">
                        <label class="form-label">Cím</label>
                        <input type="text" name="title" class="form-control" value="{{ $todo->title }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Leírás</label>
                        <textarea name="description" class="form-control" cols="50" rows="5">
                            {{ $todo->description }}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Státusz</label>
                        <select name="is_completed" class="form-control">
                            <option disabled selected> Válasszon </option>
                            <option value="0"> Folyamatban... </option>
                            <option value="1"> Befejezve </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"> Update </button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
