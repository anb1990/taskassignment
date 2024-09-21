@extends('layouts.general')

@section('title', 'Task Delete')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Task Delete</h4>

    </div>
    <div class="card-body">
        <form id="destroyForm"  method="POST">
            @csrf <!-- There is no need for this here wile request will by handeled using authToken but i put it for in case another web process -->
            <input type="hidden" name="id" value="{{ $task->id }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group align-items-center">
                    Are you sure you wan to remove `{{ $task->name }}` task?
                </div>
            </div>
          

        </div>
            <div class="col-md-6">
                <div class="form-group align-items-center">
                    <button type="submit" class="btn btn-primary btn-block">yes</button>
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



<script>
    document.getElementById('destroyForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        
        //let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/api/tasks/destroy/', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer {{$authToken}}',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {

                document.getElementById('responseMessage').innerHTML = `<div class="alert alert-success">Removed successful!</div>`;

            } else {

                document.getElementById('responseMessage').innerHTML = `<div class="alert alert-danger">Remove failed: ${result.message || 'Unknown error occurred.'}</div>`;
            }
        } catch (error) {
            document.getElementById('responseMessage').innerHTML = `<div class="alert alert-danger">Remove failed: Network error or server issue.</div>`;
        }
    });
        </script>
@endsection



