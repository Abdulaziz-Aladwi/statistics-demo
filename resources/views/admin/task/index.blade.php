@extends('admin.base')

@section('title')
    {{ $title }}
@endsection

@section('body')
    <div class="card">
        <div class="card-header">
            <a href="{{route('admin.tasks.create')}}">
                    <button class="btn btn-sm btn-primary"><i class="fa fa-plus mr-2"></i>Add Task</button>
            </a>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Admin</th>
                        <th>Assigned Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $key => $task)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ Str::limit($task->description, 20) }}</td>
                            <td>{{ $task->assigner->name }}</td>
                            <td>{{ $task->assignee->name }}</td>
                        </tr>
                    @endforeach

                </tbody>
                
            </table>
        </div>

        <!-- /.card-body -->
        <div>
            {{ $tasks->links() }}
        </div>
        
    </div>
@endsection
