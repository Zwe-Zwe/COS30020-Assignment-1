<?php include_once "head.php" ?>
<body id="reg-body">
<?php include_once "header.php" ?>
    <div class="container d-flex justify-content-center" id="login-container">
        <form id="login-form">
            <legend class="text-center display-7 ml-3 mb-3 mt-3">Please Login</legend>
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="text" id="email" class="custom-input" placeholder="Email">
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col">
                    <input type="password" id="password" class="custom-input" placeholder="Password">
                </div>
            </div>
            <div class="row p-3">
                <div class="col d-flex justify-content-center ">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Login">
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col d-flex justify-content-center ">
                    <p class="">Don't have an account? <a class="login-a" href="registration.php">Register</a></p>
                </div>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>