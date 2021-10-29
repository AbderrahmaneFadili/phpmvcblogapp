<!-- Header -->
<?php require APPROOT . "/views/inc/header.php"; ?>
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2 class="mt-3">Login</h2>
                <p>Please fill in your credentials to log in</p>
                <form method="POST" action="<?php echo URLROOT; ?>users/login">


                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email <sup>*</sup></label>
                        <input type="text" name="email" class="form-control form-control-lg <?php echo !empty($data['email_err']) ? "is-invalid" : "" ?>" value='<?php echo $data['email'] ?>' />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password <sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo !empty($data['password_err']) ? "is-invalid" : "" ?>" value='<?php echo $data['password'] ?>' />
                    </div>

                    <!-- Submit button -->
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Login" class='btn btn-success btn-block'>
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>users/register" class='btn btn-light'>No account? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php require APPROOT . "/views/inc/footer.php"; ?>