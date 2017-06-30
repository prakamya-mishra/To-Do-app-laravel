<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tdod List App</title>
    {{-- Bootstrap css --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    {{-- Bootstrap js --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="col-md-offset-2 col-md-8">
        <div class="row">
            <h1>To-Do List</h1>
        </div>

        {{-- Display success message --}}
        @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>Success:</strong>{{Session::get('success')}}
            </div>
        @endif
        {{-- Display error message --}}
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row" style="margin-top:10px;margin-bottom:10px;">
            <form action="{{ route('tasks.store') }}" method="POST">
            {{ csrf_field() }}
                <div class="col-md-9">
                    <input type="text" name="newTaskName" class="form-control">
                </div>
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary btn-block" value="Add Task">
                </div>
            </form>
        </div>
        <div class="row">
            @if(count($storedTasks)>0)
                <table class="table">
                    <thead>
                        <th>name</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach($storedTasks as $storedTask)
                            <tr>
                                <td>{{ $storedTask->name }}</td>
                                <td>
                                    <form action="{{ route('tasks.destroy',['tasks'=>$storedTask->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" class="btn btn-danger" value="Delete">
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