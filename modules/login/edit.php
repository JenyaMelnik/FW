<?php

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    q("
        UPDATE `fw_users` SET
        `facebook_id` = ''
        WHERE `id` = " . $_SESSION['user']['id'] . "
        LIMIT 1
    ");

    q("
        DELETE FROM `fw_users2socials`
        WHERE `user_id` = " . $_SESSION['user']['id'] . "
        AND `social_id` = " . $_GET['id'] . "
        LIMIT 1
    ");

    $_SESSION['notice'] = 'Соц. сеть откреплена';
    redirect('/login/edit');
}

$queryUserData = q("
    SELECT GROUP_CONCAT(`fw_socials`.`social_name`) as `socials_name`, GROUP_CONCAT(`fw_socials`.`social_id`) as `socials_id`
    FROM `fw_users` 
    LEFT JOIN `fw_users2socials` ON `fw_users2socials` . `user_id` = `fw_users` . `id`
    LEFT JOIN `fw_socials` ON `fw_socials` . `social_id` = `fw_users2socials` . `social_id`
    WHERE `fw_users`.`id` = " . $_SESSION['user']['id'] . "
    GROUP BY `fw_users`.`id`;
");

if ($queryUserData->num_rows) {
    $userData = $queryUserData->fetch_assoc();

    $userSocialsId = explode(',', $userData['socials_id']);
    $userSocialsName = explode(',', $userData['socials_name']);

    $i = 0;
    foreach ($userSocialsId as $socialId) {
        $userSocials[$socialId] = $userSocialsName[$i];
        $i++;
    }
}
// ====================================================================================================================

$queryAllSocials = q("
    SELECT `social_id`, `social_name`
    FROM `fw_socials`
");

if ($queryAllSocials->num_rows) {
    while ($social = $queryAllSocials->fetch_assoc()) {
        $allSocials[$social['social_id']] = $social['social_name'];
    }
}

// ====================================================================================================================
if (isset($_POST['edit'],
    $_POST['login'],
    $_POST['email'])) {

    if ($_POST['login'] == $_SESSION['user']['login']
        && $_POST['email'] == $_SESSION['user']['email']
    ) {

        $_SESSION['notice'] = 'Вы ничего не изменили';

    } else {

        $errors = [];

        if (empty($_POST['login'])) {
            $errors['login'] = 'Вы не ввели логин';
        } elseif (!preg_match('#^[\wё\s-]+$#u', $_POST['login'])) {
            $errors['login'] = 'Недопустимые символы!';
        } elseif (mb_strlen($_POST['login']) < 2) {
            $errors['login'] = 'Логин должен быть не менее двух символа';
        } elseif (mb_strlen($_POST['login']) > 20) {
            $errors['login'] = 'Логин должен быть не более 20 символов';
        }

        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Вы не верно ввели email';
        }

        if (!count($errors)) {
            if ($_POST['login'] != $_SESSION['user']['login']) {
                $checkLogin = q("
					SELECT `id` FROM `fw_users`
 					WHERE `login` = '" . es(trim($_POST['login'])) . "'
            		LIMIT 1
				");
                if (mysqli_num_rows($checkLogin)) {
                    $errors['login'] = 'Пользователь с таким Логином уже существует';
                }
            }

            if ($_POST['email'] != $_SESSION['user']['email']) {
                $checkEmail = q("
					SELECT `id` FROM `fw_users`
 					WHERE `email` = '" . es(trim($_POST['email'])) . "'
            		LIMIT 1
				");
                if (mysqli_num_rows($checkEmail)) {
                    $errors['email'] = 'Пользователь с таким email уже существует';
                }
            }
        }

        if (!count($errors)) {
            q("
            	UPDATE `fw_users` 
            	SET `login` = '" . es(trim($_POST['login'])) . "',
             	    `email` = '" . es(trim($_POST['email'])) . "'
             	WHERE  `id` = " . (int)$_SESSION['user']['id'] . "
      		");

            $_SESSION['user']['login'] = $_POST['login'] ?? $_SESSION['user']['login'];
            $_SESSION['user']['email'] = $_POST['email'] ?? $_SESSION['user']['email'];

            $_SESSION['notice'] = 'Ваши данные отредактированы';
            redirect('login/edit');
        }
    }
}
