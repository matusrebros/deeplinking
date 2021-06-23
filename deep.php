<?php

if (isset($_GET['IgUsername']) and !empty($_GET['IgUsername'])) {
    $RootDomain = 'https://deep.dpmarketing.sk/';
    $IgUsername = $_GET['IgUsername'];
    $hash = substr(md5($IgUsername), 0, 8);

    $link = mysqli_connect("mysql80.r1.websupport.sk:3314", "yk4i43mm", "Oo5ajK83p=", "yk4i43mm");

    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $ig_username = mysqli_real_escape_string($link, $_REQUEST['IgUsername']);
    $db_hash = mysqli_real_escape_string($link, $hash);

    $sql = "INSERT INTO `urls` (`ig_username`, `hash`)
			SELECT '$ig_username', '$db_hash' FROM DUAL
			WHERE NOT EXISTS (SELECT * FROM `urls`
		  	WHERE `ig_username`='$ig_username' AND `hash`='$db_hash' LIMIT 1)";
    if (mysqli_query($link, $sql)) {
		if ( mysqli_affected_rows($link) > 0 ) {
			echo "Pridané" . "<br>";
			echo "Deeplink URL: <a href=". $RootDomain . $hash .">". $RootDomain . $hash . "</a>";
		} else {
			echo "IG je už v DB";
		}
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    mysqli_close($link);
} else {
    echo 'Daj tam IG username koko';
}
