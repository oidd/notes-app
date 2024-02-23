<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="src/Static/css/homeStyles.css"> -->
    <?php include $elementsPath . "links.php"?>
    <link rel="stylesheet" href="src/Static/css/loginStyles.css">
    <title>Login</title>
</head>
<body>
    <div class="main-window">
        <div class="welcome-window">
            <div class="inner">
                <div class="title">
                    Login
                </div>
                <div class="lower-items">
                    <div class="error-message">
                        <?php 
                            if (isset($err))
                                echo $err;
                        ?>
                    </div>
                    <form method="POST">
                        <input name="username" type="text" placeholder="login" required>
                        <input name="password" type="password" placeholder="password" required>
                        <button type="submit" class="button">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>