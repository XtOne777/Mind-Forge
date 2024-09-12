<html>
<head>
    <meta charset="utf-8"/>
    <title>DiFuture</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Nunito:wght@400;500;600;700;800;1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,200&display=swap" rel="stylesheet">
</head>
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
    }

    .main { 
        overflow: hidden;
        position: relative;
        min-width: 393px;
        max-width: 393px;
        min-height: 852px;
        max-height: 852px;
        border: 1px solid #fff;
        margin-left: auto;
        margin-right: auto;
        margin-top: 1%;
        margin-bottom: 1%;
        background-color: 0C1015;
        padding: 0;
    }

    .upper-box {
        display: block;
        min-width: 393px;
        min-height: 63px;
        max-width: 393px;
        max-height: 63px;
    }
    .upper-box-data {
        margin: 12px 17px 13px 15px;
        display: flex;
    }
    .user-box {
        width: 170px;
        height: 48px;
        position: relative;
        display: flex;
    }
    .money-box {
        margin-left: 12.24px;
        margin-top: 9px; 
        position: relative;
        display: flex;
        width: 141px;
        height: 33px;
    }
    .settings {
        margin-top: 13px;
        margin-left: 13.38px;
    }
    .nav-bar {
        min-width: 365px;
        min-height: 94px;
        max-width: 365px;
        max-height: 94px;
        background-color: #0C1015;
        position: absolute;
        bottom: 0;
        display: flex;
        padding-left: 14px;
        padding-right: 14px;
        border-radius: 30px 30px 0px 0px;
    }
    
    .nav-bar-items {
        display: flex;
        justify-content: center;
        width: 365px;
    }

    .nav-bar-items a {
        margin: auto;
    }
    button {
        border: 0;
        background-color: #00000000;
        margin: 0;
        padding: 0;
    }

    .main-window {
        position: relative;
        background-color: #1B232F;
        background-size: cover;
        min-height: 852px;
    }

    .background-window {
        position: absolute;
        margin-top: 119px;
        min-width: 393px;
        min-height: 100px;
        background: url('./pictures/habit/Habit Back.svg') no-repeat; 
        background-size: cover;
        height: 658px;
    }
</style>
<?php
    session_start();
    if (!isset($_SESSION["id"])) {
        header("Location: index.php");
    }
    $id = $_SESSION["id"];
    $conn = mysqli_connect("localhost", "root", "", "mindforge");
    $result = $conn -> query("SELECT * FROM Player WHERE id='$id'");
?>
<body class="body-style">
    <div class="main">

        <div class="upper-box">
            <div class="upper-box-data">

                <div class="user-box">
                    <img src="./pictures/Profile.svg">
                    <img style="position: absolute; margin-left: 3px; margin-top: 3px;" src="./pictures/habit/Avatar.png">
                    <?php
                        $dat = mysqli_fetch_assoc($result);
                        $username = $dat["name"];
                        $xp = $dat["xp"];
                        $lvl = intval($xp ** 0.5);
                        $xp_bar = 87 * ($xp - $lvl ** 2) / (($lvl + 1) ** 2 - $lvl ** 2);
                        echo "<div style='font-size: 12px; color: white; font-weight: 700; position: absolute; margin-left: 52px; margin-top: 8px;'>$username</div>
                              <div style='font-size: 12px; color: white; font-weight: 700; position: absolute; margin-left: 51px; margin-top: 28px; min-width: 17px; max-width: 17px; display: flex; justify-content: center;'>$lvl</div>
                              <div style='position: absolute; margin-left: 80px; margin-top: 33px; min-width: $xp_bar" . "px; min-height: 7px; background-color: #00A67C'></div>";
                    ?>
                </div>

                <div class="money-box">
                    <img src="./pictures/money.svg">
                    <?php
                    $money = $dat["money"];
                    echo "<div style='font-size: 14px; color: white; font-weight: 700; position: absolute; margin-left: 21px; margin-top: 8px; min-width: 121px; max-width: 121px; display: flex; justify-content: center;'>$money</div>";
                    ?>
                </div>
                

                <div class="settings">
                    <button><img src="./pictures/habit/settings.svg"></button>
                </div>
                    
            </div>
        </div>
        <div class="main-window">
            <div class="background-window"></div>
        </div>
        <div class="nav-bar">
            <div class="nav-bar-items">
                <a href="habits.php"><img src="./pictures/habit/check circle selected.svg"></a>
                <a href="shop.php"><img src="./pictures/habit/shop 1.svg"></a>
                <a href="battle.php"><img src="./pictures/habit/battles.svg"></a>
                <a href="leadearboard.php"><img src="./pictures/habit/trophy 1.svg"></a>
                <a href="profile.php"><img src="./pictures/habit/user 1.svg"></a>
            </div>
        </div>
    </div>
<?php
    // CREATE TABLE DailyTasks ( id integer AUTO_INCREMENT PRIMARY KEY, user_id integer, name varchar(255)  , type_value int(1), max_value integer, logo varchar(50), day integer, FOREIGN KEY (user_id) REFERENCES player(id))
    $conn = mysqli_connect("localhost", "root", "", "mindforge");
    $id = $_SESSION["id"];
    $result = $conn -> query("SELECT * FROM dailytasks WHERE user_id = '$id'");
    // INSERT INTO dailytasks(user_id, name, type_value, max_value, logo, day) VALUES(1, 'Running', 0, 20, 'path', 0);
    while ($row = mysqli_fetch_assoc($result)){
        if ($row["day"] == 0){
            switch ($row["logo"]){
                case "meditate":
                    $logo = "path";
                    break;  
                case "bycicle":
                    $logo = "path";
                    break;
                case "book":
                    $logo = "path";
                    break;
                case "research":
                    $logo = "path";
                    break;
                default:
                    $logo = "path";
                    break;
            }
            if ($row["type_value"] == 0) { // Time based
                echo "";
            }
            elseif ($row["type_value"] == 1) { // Value based
                
            }
            elseif ($row["type_value"] == 3) { // Check box

            }
        }
    }
?>
<!-- Код ниже нуждается в изменение, а так же дополнение в визуале. Так же нужно будет добавить script + trigger + backend/SQL -->
<style>
    .dailytask {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
        border: 0;
        padding: 20px;
        background-color: #555555;
        border-radius: 16px;
        width: 400px;
        height: 150px;

        visibility: hidden;
    }
    .block {
        box-sizing: border-box;
    }
    .up-task {
        display: flex;
        height: 75%;
        width: 100%;
        flex: 1;
    }
    .bottom-task {
        padding-top: 16px;
        height: 25%;
        display: flex;
        justify-content: space-between;
    }
    .bottom-task button {
        cursor: pointer;    
        background-color: #444444;
        border: 0;
        border-radius: 16px;
        width: 25%;
        height: 100%;
    }
    .logo {
        width: 112.5px;
        height: 112.5px;
        background-color: #123456;
    }
    .right {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .right .block1 {
        height: 25%;
    }
    .right .block2 {
        height: 75%;
    }
</style>
<div class="dailytask" id="">
    <div class="up-task">
        <div class="block logo">logo</div>
        <div class="right">
            <div class="block1"><b>Name</b></div>
            <div class="block2">mew 3</div>
        </div>
    </div>
    <div class="bottom-task">
        <button style="background-color: green">Save</button>
        <button style="background-color: yellow">Maximum</button>
        <button style="background-color: red">Close</button>
    </div>
</div>
</body>
</html>