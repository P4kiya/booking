<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.png') }}">

    <!-- Materialize CSS -->

    <link rel="stylesheet" href="{{ asset('/assets/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/materialize-custom.css') }}') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">

                
                <div class="loginbox">

                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Connecter</h1>
                            <p class="account-subtitle">Access to dashboard</p>

                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Username</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" name="password" required>
                                        <span class="fas fa-eye toggle-password"></span>
                                    </div>
                                </div>
                                
                                <button class="btn btn-lg btn-block btn-primary w-100" type="submit">Connecte</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/assets/js/jquery-3.6.1.min.js') }}"></script>

    <!-- Materialize JS -->
    <script src="{{ asset('/assets/js/materialize.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('/assets/js/feather.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('/assets/js/script.js') }}"></script>

</body>

</html>

