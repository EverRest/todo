@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Update Task</h3>
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{url('task/' . $task->id)}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        
                        <!-- Task -->
                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="task" id="task-task" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-6">
                            <select name="status" id="task-status" class="form-control">
                              <option value="to_do">To do</option>
                              <option value="done">Done</option>
                            </select>   
                            </div>                            
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default btn-success">
                                    <i class="fa fa-btn fa-plus"></i>Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
