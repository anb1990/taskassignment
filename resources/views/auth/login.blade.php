<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="card-title text-center mb-4">Login</h3>
                    <form id="loginForm"  method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <center>or</center>
                <a href ="{{ route('auth.register') }}" class="btn btn-primary btn-block">Register</a>
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


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        <script>
    /*document.getElementById('loginForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    // 'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {

                localStorage.setItem('authToken', result.token);

                document.getElementById('responseMessage').innerHTML = `<div class="alert alert-success">Login successful!</div>`;

                window.location.href = 'projects';
            } else {

                document.getElementById('responseMessage').innerHTML = `<div class="alert alert-danger">Login failed: ${result.message || 'Unknown error occurred.'}</div>`;
            }
        } catch (error) {
            document.getElementById('responseMessage').innerHTML = `<div class="alert alert-danger">Login failed: Network error or server issue.</div>`;
        }
    });*/
        </script>
    </body>
</html>