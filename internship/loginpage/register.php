<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav>
        <h1>
            <B><em>Login</em></B>
        </h1>
        <p>Please enter your email Address and password</p>
        
        <form action="login.php" method="POST"></form>
            <label>
                <input type="text" name="name" placeholder="Enter Your name">
                <br>
                <br>
                <input type="email" name="email" placeholder="enter your email">
            
                <input type="password" name="password" placeholder="Enter Your password">
                <br>
                <br>
                <input type="password" name=" confirm password" placeholder=" enter your confirm Password">
            </label>
        </form>
   
    <div>
        <h4>                        
       <a href="Forget Password">Forget Password</a>
        </h4>
        <button class="b" type="submit">Login</button>
    </div>
    <div class="two">
        <p> Dont have an account?   <a class="as" href="id">Register</a></p>
    </div>
    </nav>
</body>
</html>