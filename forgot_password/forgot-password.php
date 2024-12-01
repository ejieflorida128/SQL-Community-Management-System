
<!DOCTYPE html>
<html lang="en">
<?php include_once('header.php') ?>
<body>
    <h1 id="page-title" class="text-center">Forgot Password Page</h1>
    <hr id="title_hr" class="mx-auto">
    <div id="login-wrapper">
        <div class="text-muted"><small><em>Please Fill all the required fields</em></small></div>
        <?php if(isset($error) && !empty($error)): ?>
            <div class="message-error"><?= $error ?></div>
        <?php endif; ?>
        <form action="send.php" method="POST">
            <div class="input-field">
                <label for="email" class="input-label">Email</label>
                <input type="email" id="email" name="gmail" required="required">
            </div>
            <div class="input-field ">
                <a href="login.php" tabindex="-1" style = "text-decoration: none;"><small><strong>Go back to login page</strong></small></a>
            </div>
            <button class="login-btn">Reset Password</button>
        </form>
    </div>
</body>
</html>