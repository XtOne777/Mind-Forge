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
    .character-zone {
        min-width: 393px;
        min-height: 336px;
        max-width: 393px;
        max-height: 336px;
        background-image: url('./pictures/Profile/background.svg');
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

    .inventory {
        width: 393px;
        height: 441.14px;
        background-color: #1B232F;
    }
    .nav-items {
        width: 393px;
        height: 55px;
    }
    .player {
        width: 113px;
        height: 150px;
        position: absolute;
        margin-left: 139px;
        margin-top: 104px;
    }
    .stats {
        width: 120px;
        height: 74px;

        position: absolute;
        display: flex;
        margin-left: 128px;
        margin-top: 12px;
    }
    .skill-tree {
        width: 102px;
        height: 32px;

        position: absolute;
        margin-left: 145px;
        margin-top: 279px;
    }
    button {
        border: 0;
        background-color: #00000000;
        margin: 0;
        padding: 0;
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
                    <img style="position: absolute; margin-left: 3px; margin-top: 3px;" src="./pictures/Profile/Avatar.png">
                    <?php
                        $dat = mysqli_fetch_assoc($result);
                        $username = $dat["name"];
                        $xp = $dat["xp"];
                        $lvl = intval($xp ** 0.5);
                        $xp_bar = 87 * ($xp - $lvl ** 2) / (($lvl + 1) ** 2 - $lvl ** 2);
                        echo "<div style='font-size: 12px; color: white; font-weight: 700; position: absolute; margin-left: 52px; margin-top: 8px;'>$username</div>
                              <div style='font-size: 12px; color: white; font-weight: 700; position: absolute; margin-left: 51px; margin-top: 28px; min-width: 17px; max-width: 17px; display: flex; justify-content: center;'>$lvl</div>
                              <div style='position: absolute; margin-left: 80px; margin-top: 33px; min-width: $xp_bar" . "px; min-height: 7px; background-color: #00A7FE'></div>";
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
                    <button><img src="./pictures/Profile/settings.svg"></button>
                </div>
                    
            </div>
        </div>
        <div class="character-zone">
            
            <div class="player">
                <img src="./pictures/Profile/Body.svg">
            </div>

            <div class="stats">
                <img src="./pictures/Profile/player_stats.svg">
                <?php
                $attack = intval($lvl * 1.5);
                $hp = intval($lvl * 2.8);
                echo "<div style='font-size: 16px; color: white; font-weight: 700; position: absolute; margin-left: 20px; margin-top: 9px; min-width: 100px; max-width: 100px; display: flex; justify-content: center;'>$attack</div>
                      <div style='font-size: 16px; color: white; font-weight: 700; position: absolute; margin-left: 20px; margin-top: 42px; min-width: 100px; max-width: 100px; display: flex; justify-content: center;'>$hp</div>";
                ?>
            </div>

            <div class="skill-tree">
                <a href="skill_tree.php"><img src="./pictures/Profile/Skill tree.svg"></a>
            </div>

        </div>

        <div class="inventory">
            <div class="nav-items">
                <img src="./pictures/Profile/Nav items.svg">
            </div>
        </div>

        <div class="nav-bar">
            <div class="nav-bar-items">
                <a href="habits.php"><img src="./pictures/Profile/check circle.svg"></a>
                <a href="shop.php"><img src="./pictures/Profile/shop 1.svg"></a>
                <a href="battle.php"><img src="./pictures/Profile/battles.svg"></a>
                <a href="leadearboard.php"><img src="./pictures/Profile/trophy 1.svg"></a>
                <a href="profile.php"><img src="./pictures/Profile/user selected.svg"></a>
            </div>
        </div>
    </div>
</body>
</html>