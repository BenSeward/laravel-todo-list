<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>My to-do List App</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
      <div class="col-md-offset-2 col-md-8">
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

          <form class="" action="{{ route('tasks.store') }}" method="POST">
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
            <th>Edit</th>
            <th>Delete</th>
          </thead>

          <tbody>
            @foreach($storedTasks as $storedTask)
            <tr>
              <th>{{ $storedTask->id }}</th>
              <td>{{ $storedTask->name }}</td>
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
  </body>
</html>