<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/users.css">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="">
        <title>Authentication</title>
    </head>
    <body class="night-mode">
        <fieldset class="night-mode">
            <legend>Basic Information</legend>
            <p>First name: <span><?= $user->first_name ?></span></p>
            <p>Last name: <span><?= $user->last_name ?></span></p>
            <p>Contact number: <span><?= $user->contact_number ?></span></p>
            <p>Created at: <span><?= $user->created_at ?></span></p>
        </fieldset>
        <a href="<?= base_url('users/logout'); ?>" id="logout" class="blue-button">Logout</a>
    </body>
</html>