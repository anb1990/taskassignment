@extends('layouts.general')

@section('title', 'Add Task')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Task</h4>

    </div>
    <div class="card-body">
        <form id="storeForm"  method="POST">
            @csrf <!-- There is no need for this here wile request will by handeled using authToken but i put it for in case another web process -->
            <input type="hidden" name="project_id" value="{{ $projectId }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group align-items-center">
                    <label for="Name" class="mr-2">Name</label>
                    <input type="text" id="name" name="name" class="form-control"  required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group align-items-center">
                    <label for="Name" class="mr-2">Status</label>
                    <select id="name" name="status" class="form-control"  required>
                        @foreach($taskStatusOptions as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
            
            <div class="row">
            <div class="col-md-6">
                <div class="form-group align-items-center">
                    <label for="Name" class="mr-2">Description</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>
            </div>
           
                
        </div>
            <hr>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group align-items-center">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </div>
            </div>
        </form>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-secondary" onclick="window.history.back();">Back</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="responseMessage" class="mt-3 text-center">

                    @if ($errors->has('message'))
                    <div class="alert alert-danger">
                        {{ $errors->first('message') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('storeForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        
        
        //let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/api/tasks/store', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer {{$authToken}}',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {

                document.getElementById('responseMessage').innerHTML = `<div class="alert alert-success">Added successful!</div>`;

            } else {

                document.getElementById('responseMessage').innerHTML = `<div class="alert alert-danger">Add failed: ${result.message || 'Unknown error occurred.'}</div>`;
            }
        } catch (error) {
            document.getElementById('responseMessage').innerHTML = `<div class="alert alert-danger">Add failed: Network error or server issue.</div>`;
        }
    });
        </script>
@endsection



