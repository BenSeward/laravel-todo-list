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
          <form class="" action="{{ route('tasks.update', [$taskUnderEdit->id]) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            <div class="form-group">
              <input class="form-control input-lg" type="text" name="updatedTaskName" value="{{ $taskUnderEdit->name }}">
            </div>

            <div class="form-group">
              <select class="form-control form-control-lg" name="updateTaskStatus" default="{{ $taskUnderEdit->status }}">
                /* need to add some kind of check here for security */
                <option value="incomplete">Incomplete</option>
                <option value="complete">Complete</option>
              </select>
            </div>

            <div class="form-group">
              <input class="btn btn-success btn-lg" type="submit" name="" value="Save Changes">
              <a class="btn btn-danger btn-lg pull-right" href="{{ route( 'tasks.index' )}}">Go back</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </body>
</html>
