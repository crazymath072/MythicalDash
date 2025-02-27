<?php
use MythicalDash\SettingsManager;

include(__DIR__ . '/../requirements/page.php');
if (isset($_GET['code']) && !$_GET['code'] == "") {
    $user_query = "SELECT * FROM mythicaldash_redeem WHERE code = ?";
    $stmt = mysqli_prepare($conn, $user_query);
    mysqli_stmt_bind_param($stmt, "s", $_GET['code']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $code = mysqli_real_escape_string($conn, $_GET['code']);
        $redeemdb = $conn->query("SELECT * FROM `mythicaldash_redeem` WHERE `mythicaldash_redeem`.`code` = '" . $code . "'")->fetch_array();
        $newcoins = $session->getUserInfo("coins") + $redeemdb['coins'];
        $newram = $session->getUserInfo("ram") + $redeemdb['ram'];
        $newdisk = $session->getUserInfo("disk") + $redeemdb['disk'];
        $newcpu = $session->getUserInfo("cpu") + $redeemdb['cpu'];
        $new_server_limit = $session->getUserInfo("server_limit") + $redeemdb['server_limit'];
        $newports = $session->getUserInfo("ports") + $redeemdb['ports'];
        $newdatabases = $session->getUserInfo("databases") + $redeemdb['databases'];
        $newbackups = $session->getUserInfo("backups") + $redeemdb['backups'];
        $conn->query("UPDATE `mythicaldash_users` SET `coins` = '" . $newcoins . "' WHERE `mythicaldash_users`.`api_key` = '" . mysqli_real_escape_string($conn, $_COOKIE['token']) . "';");
        $conn->query("UPDATE `mythicaldash_users` SET `ram` = '" . $newram . "' WHERE `mythicaldash_users`.`api_key` = '" . mysqli_real_escape_string($conn, $_COOKIE['token']) . "';");
        $conn->query("UPDATE `mythicaldash_users` SET `disk` = '" . $newdisk . "' WHERE `mythicaldash_users`.`api_key` = '" . mysqli_real_escape_string($conn, $_COOKIE['token']) . "';");
        $conn->query("UPDATE `mythicaldash_users` SET `cpu` = '" . $newcpu . "' WHERE `mythicaldash_users`.`api_key` = '" . mysqli_real_escape_string($conn, $_COOKIE['token']) . "';");
        $conn->query("UPDATE `mythicaldash_users` SET `server_limit` = '" . $new_server_limit . "' WHERE `mythicaldash_users`.`api_key` = '" . mysqli_real_escape_string($conn, $_COOKIE['token']) . "';");
        $conn->query("UPDATE `mythicaldash_users` SET `ports` = '" . $newports . "' WHERE `mythicaldash_users`.`api_key` = '" . mysqli_real_escape_string($conn, $_COOKIE['token']) . "';");
        $conn->query("UPDATE `mythicaldash_users` SET `databases` = '" . $newdatabases . "' WHERE `mythicaldash_users`.`api_key` = '" . mysqli_real_escape_string($conn, $_COOKIE['token']) . "';");
        $conn->query("UPDATE `mythicaldash_users` SET `backups` = '" . $newbackups . "' WHERE `mythicaldash_users`.`api_key` = '" . mysqli_real_escape_string($conn, $_COOKIE['token']) . "';");
        if ($redeemdb['uses'] > 1) {
            $newuses = $redeemdb['uses'] - 1;
            $conn->query("UPDATE `mythicaldash_redeem` SET `uses` = '" . $newuses . "' WHERE `mythicaldash_redeem`.`code` = '" . $code . "';");
        } else {
            $conn->query("DELETE FROM mythicaldash_redeem WHERE `mythicaldash_redeem`.`code` = '" . $code . "'");
        }
        header('location: /earn/redeem?s=We updated your resources!');
    } else {
        header("location: /earn/redeem?e=We cannot find this code in the database");
        $conn->close();
        die();
    }
}
?>
<!DOCTYPE html>

<html lang="en" class="dark-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-semi-dark"
    data-assets-path="<?= $appURL ?>/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <?php include(__DIR__ . '/../requirements/head.php'); ?>
    <title>
        <?= SettingsManager::getSetting("name") ?> - Redeem
    </title>
    <link rel="stylesheet" href="<?= $appURL ?>/assets/vendor/css/pages/page-help-center.css" />
</head>

<body>
    <div id="preloader" class="discord-preloader">
        <div class="spinner"></div>
    </div>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include(__DIR__ . '/../components/sidebar.php') ?>
            <div class="layout-page">
                <?php include(__DIR__ . '/../components/navbar.php') ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Earn /</span> Redeem</h4>
                        <?php include(__DIR__ . '/../components/alert.php') ?>
                        <div id="ads">
                            <?php
                            if (SettingsManager::getSetting("enable_ads") == "true") {
                                ?>
                                <?= SettingsManager::getSetting("ads_code") ?>
                                <br>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <div class="card-title">Redeem a coupon code</div>
                                    </div>
                                    <div class="card-body text-center">
                                        <form method='GET'>
                                            <h4>Please enter the coupon code you would like to redeem below!</h4>
                                            <input type="text" class="form-control mb-4" placeholder="DO2NMNd02" value="<?php if (isset($_GET['code'])) {
                                                echo $_GET['code'];
                                            } ?>" name="code">
                                            <br>
                                            <button name="submit" class="btn btn-primary">Redeem</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ads">
                            <?php
                            if (SettingsManager::getSetting("enable_ads") == "true") {
                                ?>
                                <br>
                                <?= SettingsManager::getSetting("ads_code") ?>
                                <br>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php include(__DIR__ . '/../components/footer.php') ?>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
    </div>
    <?php include(__DIR__ . '/../requirements/footer.php') ?>
    <script src="<?= $appURL ?>/assets/js/dashboards-ecommerce.js"></script>

</body>

</html>