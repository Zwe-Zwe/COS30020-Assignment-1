<nav>
    <div class="nav-container">
        <div class="nav-left">
            <h2>Herbarium for Plant Biodiversity</h2>
        </div>
        <div class="nav-middle">
            <a href="index.php"><img src="img/logo.png" alt="Logo" class="nav-logo" id="default-logo"></a>
            <a href="index.php"><img src="img/logo-alter.png" alt="Logo" class="nav-logo" id="scrolled-logo"></a>
        </div>
        <div class="nav-right">
            <a href="main_menu.php" class="nav-link">Menu</a>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <!-- Show user icon based on gender if gender is set -->
                <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Male'): ?>
                    <div class="user-container">
                        <img src="img/man.png" alt="User Icon" class="nav-icon">
                        <a href="logout.php" class="nav-link logout-link">Logout</a>
                    </div>
                <?php elseif (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Female'): ?>
                    <div class="user-container">
                        <img src="img/woman.png" alt="User Icon" class="nav-icon">
                        <a href="logout.php" class="nav-link logout-link">Logout</a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <!-- Show login link if not logged in -->
                <a href="login.php" class="nav-link">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>