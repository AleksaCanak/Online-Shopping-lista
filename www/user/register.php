<?php
// require all libs
require_once('../lib/lib.php');

Session::guestGuard();

// include header
include_once('../views/header.php');

// form handler
if (Request::isSubmitted()) {
    if (Request::hasAllKeys($_POST, ['email', 'password', 'confirm_password', 'first_name', 'last_name', 'address', 'phone_number'])) {
        $info = Request::getFromPost(['email', 'password', 'confirm_password', 'first_name', 'last_name', 'address', 'phone_number']);
        if (User::passwordsMatch($info['password'], $info['confirm_password'])) {
            $user = User::createUser($info['email'], $info['password'], $info['first_name'], $info['last_name'], $info['address'], $info['phone_number']);
            if ($user) {
                Response::showSuccess("User created. Check your email to activate your account.");
            } else {
                Response::showError("Email already taken");
            }
        } else {
            Response::showError("Passwords don't match");
        }
    } else {
        Response::showError("Please fill in all fields");
    }
}

?>

<div class="container">
    <form action="/user/register.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input class="form-control" type="text" name="first_name" placeholder="First Name" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input class="form-control" type="text" name="last_name" placeholder="Last Name" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input class="form-control" type="text" name="address" placeholder="Address" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input class="form-control" type="text" name="phone_number" placeholder="Phone Number" required>
        </div>

        <input class="btn btn-primary mt-3" type="submit" name="submit" value="Register">
    </form>
</div>

<?php
// include footer
include_once('../views/footer.php');
?>
