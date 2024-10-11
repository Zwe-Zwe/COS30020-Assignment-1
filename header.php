<nav>
    <div class="nav-container">
        <div class="nav-left">
            <h2>HERBARIUM FOR PLANT BIODIVERSITY</h2>
        </div>
        <div class="nav-middle">
            <a href="index.php"><img src="img/logo.png" alt="Logo" class="nav-logo" id="default-logo"></a>
            <a href="index.php"><img src="img/logo-alter.png" alt="Logo" class="nav-logo" id="scrolled-logo"></a>
        </div>
        <div class="nav-right">
            <a href="main_menu.php" class="nav-link nav-menu">Menu</a>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <!-- Show profile image from session if the user is logged in -->
                <?php if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])): ?>
                    <div class="user-container">
                        <img src="img/profile_images/<?= htmlspecialchars($_SESSION['profile_image']); ?>" alt="User Profile" class="nav-icon">
                        <div class="user-content">
                            <a href="view_profile.php" class="nav-link logout-link">Profile</a>
                            <a href="logout.php" class="nav-link logout-link">Logout</a> 
                        </div>     
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <!-- Show login link if not logged in -->
                <a href="login.php" class="nav-link nav-menu">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
