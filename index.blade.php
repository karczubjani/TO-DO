@extends('layouts.app')


@section('styles')
    <style>
        #outer{
            width: auto;
            text-align: center;
        }

        .inner{
            display: inline-block;
        }
     </style>   
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kezelőfelület') }} és <a class="btn btn-sm btn-info" href="{{ route('todos.create') }}"> TO-DO létrehozása </a></div>

                <div class="card-body">

                    @if (Session::has('alert-success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('alert-success') }}
                        </div>
                    @endif

                    @if (Session::has('alert-info'))
                        <div class="alert alert-info" role="alert">
                            {{ Session::get('alert-info') }}
                        </div>
                    @endif


                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    @if (Session::has('errormsg'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('errormsg') }}
                        </div>
                    @endif
                    
                    
                        @if(count($todos) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>Cím</th>
                                    <th>Leírás</th>
                                    <th>Állapot</th>
                                    <th> Műveletek </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($todos as $todo)
                                        <tr>
                                            <td>
                                                {{ $todo->title }}
                                            </td>
                                            <td>
                                                {{ $todo->description }}
                                            </td>
                                            <td>
                                                @if( $todo->is_completed == 1 )
                                                    <a class="btn btn-sm btn-success" href="">Befejezve</a>
                                                @else
                                                    <a class="btn btn-sm btn-danger" href="">Folyamatban...</a>
                                                @endif
                                            </td>
                                            <td id="outer">
                                                <a class="inner btn btn-sm btn-success" href="{{ route('todos.show', $todo->id) }}">Megtekint</a>
                                                <a class="inner btn btn-sm btn-info" href="{{ route('todos.edit', $todo->id) }}">Szerkeszt</a>
                                                <form method="post" action="{{ route('todos.destroy') }}" class="inner">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                                    <input type="submit" class="btn btn-sm btn-danger" value="Töröl">
                                                </form>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                    <h4>Nem található TO-DO</h4>    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
