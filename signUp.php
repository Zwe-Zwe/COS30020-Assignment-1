<?php include_once "head.php" ?>
<body>
    <div class="signup-container">
    <h1>Create an Account</h1>
        <form class="signup-form" action="process_signup.php" method="POST">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first_name" required>

            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="last_name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Sign Up</button>

            <div class="form-footer">
                <p>Already have an account? <a href="login.html">Log In</a></p>
            </div>
        </form>
    </div>
</body>
</html>