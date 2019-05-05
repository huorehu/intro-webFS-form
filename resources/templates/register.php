<?php

if (isset($_SESSION['authorize-err'])): ?>
    <p class="error-msg"><?php echo $_SESSION['authorize-err'] ?></p>
<?php endif; ?>

<form method="post" action="handler.php" class="register">
    <input type="hidden" name="form-name" value="register">
    <div class="register__email">
        <label for="email">Enter your email</label>
        <input class="register__field" type="email" id="email" name="email" placeholder="arya@westeros.com">
        <?php
        if (isset($_SESSION['email'])): ?>
        <p class="error-msg"><?php echo $_SESSION['email'] ?></p>
        <?php endif; ?>
    </div>
    <div class="register__password">
        <label for="password">Choose secure password</label>
        <p class="register__password-tip">Must be at least 8 characters</p>
        <input class="register__field" type="password" id="password" name="password" placeholder="password">
        <?php
        if (isset($_SESSION['password'])): ?>
            <p class="error-msg"><?php echo $_SESSION['password'] ?></p>
        <?php endif; ?>
    </div>
    <div class="register__checkbox">
        <input type="checkbox" id="checkbox">
        <label for="checkbox">Remember me</label>
    </div>
    <div><input class="button" id="submit" type="submit" value="Sign Up"></div>
</form>
