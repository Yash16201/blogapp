<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog data</title>
</head>
<body>
    <form action="http://localhost/blogapp/userController/signUp" method="post">
        <label for="name">Enter your name</label><br>
        <input type="text" name="name"><br>

        <label for="gender">Enter your gender</label><br>
        <input type="radio" name="gender" value="Male">Male <br>
        <input type="radio" name="gender" value="Female">Female <br>
        <input type="radio" name="gender" value="Other">Other <br>

        <label for="contact">Enter your contact</label> <br>
        <input type="text" name="contact"> <br>

        <label for="password">Enter your password</label> <br>
        <input type="password" name="password"> <br>

        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>