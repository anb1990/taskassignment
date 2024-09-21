<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Register</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="registerForm">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group" class="form-control" required>
                        <label for="password">Role</label>
                        <select id="select" name="role" class="form-control" >
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
                <center>or</center>
                <a href ="{{ route('auth.login') }}" class="btn btn-primary btn-block">Login</a>
                <div id="responseMessage" class="mt-3"></div>
            </div>
        </div>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                });

                const result = await response.json();

                const responseMessage = document.getElementById('responseMessage');
                if (response.ok) {
                    responseMessage.innerHTML = `<div class="alert alert-success" role="alert">Registration successful</div>`;
                } else {
                    responseMessage.innerHTML = `<div class="alert alert-danger" role="alert">Registration failed: ${result.message || 'Please check your input and try again.'}</div>`;
                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('responseMessage').innerHTML = `<div class="alert alert-danger" role="alert">An error occurred. Please try again later.</div>`;
            }
        });
    </script>
</body>
</html>