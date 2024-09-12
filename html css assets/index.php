<html>
<head>
    <meta charset="utf-8"/>
    <title>MindForge</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Nunito:wght@400;500;600;700;800;1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,200&display=swap" rel="stylesheet">
</head>

<body class="body-style">
    <?php include_once('start.php');?>    
    <style>
        .body-style {
            margin: 0px;
            padding: 0px;
            background-color: #262626;
            font-family: 'Montserrat', sans-serif;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            font-size: 1vw;
            background: url('./pictures/Main Back.png') no-repeat; 
            background-size: cover;
            margin: 0px; padding: 0px;
            color: white;
        }
        a {
            text-decoration: none;
            color: white;
        }

        .header-center {
            margin: 0 auto;
        }

        .header-right {
            position: absolute;
            left: 92.5%
        }

        .reg_form {
            width: 350px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 60px;
            padding-bottom: 40px;
            background-color: #00000033;
            border-radius: 60px;
        }
        h1 {
            text-align: center;
        }
        input {
            border: 1px #BBB solid;
            color: black;
            background-color: #fff;
            border-radius: 6px;
            padding: 10px 12px 10px 12px;
            width: 100%;
        }
        .submit {
            width: 60%;
        }
        p {
            font-size: 16px;    
        }
    </style>
    <div class="main">
        <!-- Login form -->
        <div class="reg_form">
            <h1>Login</h1>
            <form class="reg_form_form" action="index.php" method="post">
                <!-- Name input -->
                <br><input required type="text" name="name" placeholder="Login"><br>
                <!-- Surname input -->
                <br><input required type="text" name="Password" placeholder="Password"><br>
                <p style="margin: 20px 0px 20px 0px">Doesn't have account? <a href="register.php"><b><u>Register here</u></b></a></p>
                <input class="submit" name="submit" type="submit" value="Login">
            </form>
            <?php
                # Connecting session to get id
                session_start();
                # If submit button was clicked, starts this code
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    # Obtaining data from form
                    $name = $_POST["name"];
                    $pass = $_POST["Password"];
                    # Checks if account exists in database
                    $conn = mysqli_connect("localhost", "root", "", "mindforge");
                    $result = $conn -> query("SELECT * FROM Player WHERE name='$name' AND pas='$pass'");
                    $d = mysqli_fetch_assoc($result);
                    if ($d) {
                        # Connecting to account
                        $_SESSION["id"] = $d["id"];
                    }
                    else {
                        echo "<script> alert('Account doesn't exists'!'); </script>";
                    }
                }
                # Redirect to home page
                if (isset($_SESSION["id"])) {
                    $i = $_SESSION["id"];

                    echo "<script>window.location.replace('Profile.php');</script>";
                }
            ?>
        </div>
        
    </div>
</body>
<body>