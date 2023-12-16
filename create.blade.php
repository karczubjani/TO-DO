@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> TO-DO létrehozása vagy 
                        <a class="btn btn-sm btn-info" href="{{route('todos.index')}}"> Vissza </a> 
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('todos.store') }}">
                    @csrf
                        <div class="mb-3">
                            <label class="form-label">Cím</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Leírás</label>
                            <textarea name="description" class="form-control" cols="50" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Küld</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
