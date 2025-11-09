<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login biasa light.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">
</head>
<body>

<form action="/login" method="POST">

    <div class="wrapper">
            <h1>Log in</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <?php if (isset($errors['username'])): ?>
                <label style="color: red"><?php echo $errors['username']; ?></label>
                <?php endif; ?>
                <i class="bx bxs-user"></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>

            <div class="remember-forgot">
                <!-- <label><input type="checkbox">Remember me</label> -->
                <a href="frgot pass light.html">Forgot password</a>
            </div>

            <button type="submit" class="btn" id="sbmt">login</button>

            <div class="register-link">
                <p>Don't have account? <a href="register light.html">Sign up</a></p>
            </div>
    </div>
</form>

</body>
</html>

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "poppins", sans-serif;
    }



    body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #2c3338;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .wrapper h1{
        font-size: 36px;
        text-align: center;
        color:  #A3A2A2;
    }

    .wrapper .input-box{
        color: #A3A2A2;
        width: 100%;
        height: 50px;
        margin: 30px 0;
    }

    .input-box input{
        width: 100%;
        height: 100%;
        background: #434A52;
        border: none;
        outline: none;
        border: 2px solid rgba(78, 78, 78, 0.2);
        border-radius: 10px;
        font-size: 16px;
        color: #000000;
        padding: 20px 40px 20px 20px;
    }

    .input-box input::placeholder{
        color: #A3A2A2;
    }

    .input-box i{
        position: relative;
        left: 90%;
        bottom: 70%;
        font-size: 20px;
    }

    .wrapper .remember-forgot{
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 15px;
    }
    .remember-forgot label input{
        accent-color:#000000;
        margin-left: 9px;
    }

    .remember-forgot a{
        color: #BCBABA;
        text-decoration: none;
        position: relative;
        left: 90px;
    }

    .wrapper .btn{
        width: 100%;
        height: 45px;
        background-color: #ea4c88;
        border: none;
        outline: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size:  16px;
        color: #fff;
        font-weight: 600;
    }
    .wrapper .register-link{
        font-size: 14.5px;
        text-align: center;
        margin-top: 20px;
    }

    .register-link p a{
        color: #BCBABA;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;
    }

    .remember-forgot label{
        color: #676767;

    }

    .register-link p{
        color: #676767;
    }
    .wrapper .btn:hover {
        color: #fff;
        background-color: #3b4148;
    }
    html{
        filter: invert(1) hue-rotate(180deg);
    }

</style>