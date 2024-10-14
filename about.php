<?php
session_name('Zwe_Het_Zaw');
session_start();
include_once 'head.php' ?>
<body>
    <?php include_once 'header.php' ?>
    <div class="container about-container">
        <h2 class="d-flex justify-content-center mb-5">About This Web Application</h2>
        <table class="table table-bordered mb-5">
            <thead class="table-light">
                <tr>
                    <th>Section</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PHP Version</td>
                    <td>PHP Version: 8.2.12</td>
                </tr>
                <tr>
                    <td>Tasks Completed</td>
                    <td>
                        <ul>
                            <li>Task 1: First Page</li>
                            <li>Task 2: Main Menu Page</li>
                            <li>Task 3: Plants Classification Page</li>
                            <li>Task 4: Tutorial Page</li>
                            <li>Task 5: Contribution Page</li>
                            <li>Task 6: View Plant Detail Page</li>
                            <li>Task 7: Profile Page</li>
                            <li>Task 8: Update Profile Page</li>
                            <li>Task 9: Account Registration Page</li>
                            <li>Task 10: Process Registration Page</li>
                            <li>Task 11: Login Page</li>
                            <li>Task 12: About Page</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Tasks Not Completed</td>
                    <td>All tasks have been completed.</td>
                </tr>
                <tr>
                    <td>Frameworks/3rd Party Libraries Used</td>
                    <td>
                        <ul>
                            <li>Bootstrap version 5.3.0</li>
                            <li>DOMPdf version 3.0.0</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>Video Presentation</td>
                    <td><a href="#" class="btn btn-primary">Link to YouTube</a></td>
                </tr>
            </tbody>
        </table>
        <div class="btn-container d-flex justify-content-center">
            <a href="index.php" class="btn btn-success">Back to Home Page</a>
        </div>
    </div>
    <?php include_once "footer.php" ?>
</body>
</html>