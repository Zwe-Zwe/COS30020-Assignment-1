<?php include_once "head.php" ?>
<body id="reg-body">
<?php include_once "header.php" ?>
    <div class="container d-flex justify-content-center" id="reg-container">
        <form class="p-2" id="reg-form">
            <legend class="text-center display-7 mb-3 mt-3">Create an account</legend>
            <div class="row mb-3 p-3">
                <div class="col-md-6 mb-3 form-outline">
                    <input type="text" id="first-name" class="custom-input" placeholder="First Name">
                </div>
                <div class="col-md-6 form-outline">
                    <input type="text" id="last-name" class="custom-input" placeholder="Last Name">
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col-md-6 mb-3">
                    <label class="mb-3" for="date-of-birth">Date of Birth: </label>
                    <input type="date" class="custom-input" id="date-of-birth">
                </div>
                <div class="col-md-6 ml-3">
                    <p class="mb-4">Gender: </p>
                    <label class="form-check-label" for="male">Male</label>
                    <input class="form-check-input" type="radio" name="options" id="male" value="Male">
                    <label class="form-check-label" for="female">Female</label>
                    <input class="form-check-input" type="radio" name="options" id="female" value="Female"> 
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col-md-6 mb-3">
                    <input type="text" id="email" class="custom-input" placeholder="Email">
                </div>
                <div class="col-md-6">
                    <input type="text" id="home-town" class="custom-input" placeholder="Home Town">
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col-md-6 mb-3">
                    <input type="password" id="password" class="custom-input" placeholder="Password">
                </div>
                <div class="col-md-6">
                    <input type="password" id="confirm-password" class="custom-input" placeholder="Confirm Password">
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col-md-6 mb-3 d-flex justify-content-center ">
                    <input type="submit" class="btn btn-primary rounded-0 d-flex custom-btn" value="Submit">
                </div>
                <div class="col-md-6 mb-3 d-flex justify-content-center">
                    <input type="reset" class="btn btn-primary rounded-0 d-flex custom-btn" value="Reset">
                </div>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>