<?php
session_start();
//if ($_SESSION['email']) {
//    header('Location: role.php');
//}

//session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tUa9qXGi+0e6Q8lG1zTPYY39MlZvA7AjOx4fU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-yGBsXpPFFLEGD2Z/J6a3chIpN4I/XFdbn2jkPJH2eZxGc2gwdS04Mw9laYfh9Y4u" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script> <!-- Replace 'your-fontawesome-kit.js' with your actual FontAwesome kit URL -->

    <title>our shop</title>
</head>
<body >

<nav class="navbar navbar-expand-lg" style="background-color: #508D69;">
    <div class="container">
        <a class="navbar-brand text-white" href="#">
            OPEP
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>

<main class="signup-form">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <section class="container information-processing-form rounded-2">
        <div class="row d-flex align-items-center">
            <div class="col-sm-6 d-block">
                <img src="https://img.freepik.com/free-vector/sign-concept-illustration_114360-5267.jpg?w=740&t=st=1702829302~exp=1702829902~hmac=f2bfa290a39dce45feca868f1225cb5aa4b563f1eb6687bd8c58866a19d2f70a" width="100%" class="rounded-5">
            </div>
            <div class="col">
                <h1 class="text-center text-success display-2 " style="font-weight: 400">Sign Up</h1>
                <form method="post"  action="../controller/controller.php" class="p-5">
                    <div class="form-floating mb-3">
                        <input id="email" type="text" name="uid" class="form-control shadow-none border-success" required autocomplete="email" placeholder="...">
                        <label for="email" class="text-black-50">Enter your name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="email" type="email" name="email" class="form-control shadow-none border-success" required autocomplete="email" placeholder="...">
                        <label for="email" class="text-black-50">Enter your email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="password" type="password" name="password" class="form-control shadow-none border-success" required autocomplete="new-password" placeholder="...">
                        <label for="password" class="text-black-50">Enter your password</label>

                    </div>
                    <div class="form-floating mb-3">
                        <input id="password-confirm" type="password" class="form-control shadow-none border-success" name="password-repeat" required autocomplete="new-password" placeholder="...">
                        <label for="password-confirm" class="text-black-50">Confirm your password.</label>
                    </div>
                    <button class="btn btn-success w-100 mb-2" name="signup-submit" type="submit">Next</button>
                    <span>You are have account? </span><a href="#" class="text-decoration-none text-success">Sign in !</a>
                </form>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
