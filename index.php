<?php
    include('config.php');
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <?php include('const/stylesheet.php'); ?>

    <link rel="manifest" href="manifest.json">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="login" class="h1"><b>Silicon Events</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="dataHandler" method="POST">
                    <input type="hidden" name="intent" value="_login">
                    <div class="input-group mb-3">
                        <input type="textl" class="form-control" placeholder="Username" name="_username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="_password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" id="submitBtn">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <?php include('const/js.php'); ?>

    <?php
        if(isset($_GET['error'])){
            if(strcmp($_GET['error'], 'incorrectCredentials')==0){
                echo "<script>toastr.error('Incorrect Account Credentials / No such account found');</script>";
            }
        }
    ?>

    <script>
        window.addEventListener('load', () => {
            registerSW();
        });

        // Register the Service Worker
        async function registerSW() {
            if ('serviceWorker' in navigator) {
                try {
                await navigator
                        .serviceWorker
                        .register('serviceworker.js');
                }
                catch (e) {
                    console.log('SW registration failed');
                }

            }
        }
    </script>
</body>

</html>
