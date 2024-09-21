@extends('layouts.datatable')

@section('title', 'Projects')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Projects List</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('projects.store') }}" class="btn btn-primary" onclick="">Add</a>
            </div>
        </div>
        <hr>
        <table id="projects-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('projects.update', $project->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('projects.destroy', $project->id) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
