<?php

if (isset($_POST['IgUsername']) and !empty($_POST['IgUsername'])) {
    $IgUsername = $_POST['IgUsername'];
    $MobileLink = "instagram://user?username=" . $IgUsername;
    $DesktopLink = "https://www.instagram.com/" . $IgUsername;

    function isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    if (isMobile()) {
        header('Location: ' . $MobileLink);
    } else {
        header('Location: ' . $DesktopLink);
    }
} else {
    echo 'enter IG username koko';
}
