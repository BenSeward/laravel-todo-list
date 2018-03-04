@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-offset-1 col-md-10">
      <div class="row">
        <h1>To Do List</h1>
      </div>
      @if(Session::has('success'))
        <div class="alert alert-success">
          <strong>Success:</strong> {{ Session::get('success') }}
        </div>
      @endif


      @if(count($errors) > 0 )
        <div class="alert alert-danger">
          <strong>Error:</strong>
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="row">

        <form class="col-md-12" action="{{ route('tasks.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="col-md-9">
            <input type="text" name="newTaskName" class="form-control">
          </div>
          <div class="col-md-3">
            <input type="submit" class="btn btn-primary btn-block" value="Add Task">
          </div>
        </form>

      </div>
      @if(count($storedTasks) > 0)
      <table class="table">
        <thead>
          <th>Task Number</th>
          <th>Name</th>
          <th>Status</th>
          <th>Edit</th>
          <th>Delete</th>
        </thead>

        <tbody>
          @foreach($storedTasks as $storedTask)
          <tr>
            <th>{{ $storedTask->id }}</th>
            <td>{{ $storedTask->name }}</td>
            <td>{{ $storedTask->status }}</td>
            <td><a class="btn btn-default" href="{{ route('tasks.edit', ['tasks' => $storedTask->id]) }}">Edit</a></td>
            <td>
              <form action="{{ route('tasks.destroy', ['tasks' => $storedTask->id]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input class="btn btn-danger" type="submit" name="" value="Delete">
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif

      <div class="row text-center">
        {{ $storedTasks->links() }}
      </div>
    </div>
  </div>
@endsection
