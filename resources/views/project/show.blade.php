@extends('layouts.datatable')

@section('title', 'Project')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Project Details</h4>
        
    </div>
    <div class="card-body">
<div class="row">
            <div class="col-md-4">
                <div class="form-group align-items-center">
                    <label for="ID" class="mr-2">ID:</label>
                    <span id="IDValue">{{ $project->id }}</span>
                </div>
                </div>
            <div class="col-md-4">
                <div class="form-group align-items-center">
                    <label for="Name" class="mr-2">Name:</label>
                    <span id="DescriptionValue">{{ $project->name }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group align-items-center">
                    <label for="Description" class="mr-2">Description:</label>
                    <span id="DescriptionValue">{{ $project->description }}</span>
                </div>
            </div>
        </div>
        <hr>
        <div>
        <h4>Project Tasks</h4>
        
    </div>
         <div class="row">
            <div class="col-md-12">
                <a href="{{ route('tasks.store', ['projectId' => $project->id]) }}" class="btn btn-primary" >Add</a>
            </div>
        </div>
        <hr>
        <table id="projects-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{ route('tasks.update', $task->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('tasks.destroy', $task->id) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <div class="row">
            <div class="col-md-12">
        <button class="btn btn-secondary" onclick="window.history.back();">Back</button>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#projects-table').DataTable();
    });
</script>
@endpush


