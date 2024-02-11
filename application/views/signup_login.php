<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
		<title>Authentication II</title>
	</head>
	<body>
         <!-- Display error message if present -->
<?php   if (isset($error))
        {   ?>
            <p><?= $error ?></p>
<?php   }   ?>
<?php   if (isset($success))
        {   ?>
            <p style="color: green"><?= $success ?></p>
<?php   }   ?>
        <div>
            <!-- Registration -->
            <form action="/users/signup" method="post">
                <h1>Sign Up</h1>
                <input type="hidden" name="action" value="register">      
                <!-- FIrstname -->
                <label for="first_name">Firstname: </label>
                <input type="text" name="first_name" placeholder="Firstname">
                <!-- Lastname -->
                <label for="last_name">Lastname: </label>
                <input type="text" name="last_name" placeholder="Lastname">
                <!-- Email address -->
                <label for="email">Email address: </label>
                <input type="text" name="email" placeholder="email@gmail.com">
                <!-- Contact number -->
                <label for="contact_number">Contact Number: </label>
                <input type="text" name="contact_number" placeholder="09xxxxxxxxx">
                <!-- Password -->
                <label for="password">Password: </label>
                <input type="password" name="password" placeholder="atleast 8 characters">
                <label for="confirm_password">Confirm Password: </label>
                <input type="password" name="confirm_password" placeholder="********">
                <input type="submit" value="Submit">
            </form>
            <!-- Login -->
            <form action="/users/login" method="post" id="login_form">
                <h1>Login</h1>
                <input type="hidden" name="action" value="login">
                <!-- contact number -->
                <label for="contact_number">Contact number: </label>
                <input type="text" name="contact_number" placeholder="Contact number">
                <!-- password -->
                <label for="password">Password: </label>
                <input type="password" name="password" placeholder="Password">
                <input type="submit" value="Submit"> 
            </form>
        </div>
	</body>
</html>
