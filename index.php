<?php require('header.php'); ?>
    <main>
        <h1 class="form-group">Registration</h1>
        <p class="form-group">Order your table!</p>
        <hr class="my-4">
        <p>
          <strong>You should login to order table!
        </p>
        <a class="btn btn-dark" href="register.php">Register</a>
        <a class="btn btn-dark" href="login.php">Login</a>
            
        </form>
        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <?php include_once('config.php') ?>
          <script src="https://www.google.com/recaptcha/api.js?render=<?= SITEKEY ?>"></script>
          <script>
            grecaptcha.ready(() => {
              grecaptcha.execute("<?= SITEKEY ?>", { action: "register" })
              .then(token => document.querySelector("#recaptchaResponse").value = token)
              .catch(error => console.error(error));
            });
          </script>
    </main>


<?php require('footer.php'); ?>