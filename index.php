<?php
$actual_hash = ltrim($_SERVER['REQUEST_URI'], '/');

$conn = new mysqli("mysql80.r1.websupport.sk:3314", "yk4i43mm", "Oo5ajK83p=", "yk4i43mm");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ig_username FROM urls WHERE hash = '$actual_hash'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $MobileLink = "instagram://user?username=" . $row["ig_username"];
        $DesktopLink = "https://www.instagram.com/" . $row["ig_username"];

        function isMobile()
        {
            return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        }

        if (isMobile()) {
            header("HTTP/1.1 301 Moved Permanently");
            header('Location: ' . $MobileLink);
            exit();
        } else {
			header("HTTP/1.1 301 Moved Permanently");
            header('Location: ' . $DesktopLink);
            exit();
        }
    }
} else {
    echo "Zlá URL";
}
$conn->close();
