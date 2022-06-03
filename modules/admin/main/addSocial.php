<?php

if (isset($_POST['id'])) {
    $queryUser = q("
        SELECT * FROM `fw_users`
        WHERE `facebook_id` = '" . es($_POST['id']) . "'
        LIMIT 1
    ");

    if ($queryUser->num_rows) {
        echo json_encode('exist');
        exit();
    } else {
        q("
            UPDATE `fw_users` SET
            `facebook_id` = '" . $_POST['id'] . "'
            WHERE `id` = " . $_SESSION['user']['id'] . "
        ");

    }


}


if(isset($_POST['login'],$_POST['pass'])) {
	$auth = new \FW\User\Authorization;
	if($auth->authByLoginPass($_POST['login'],$_POST['pass'],true)) {
		redirect($_GET['route']);
	} else {
		$error = $auth->getErrorMess();
		$_SESSION['wrong-form']['time'] = time();
		$_SESSION['wrong-form']['key'] = (isset($_SESSION['wrong-form']['key']) ? ($_SESSION['wrong-form']['key']+1) : 1);
	}
}
