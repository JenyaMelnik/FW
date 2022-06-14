<?php
/**
 * @var $form
 */
?>
<div align="center">
    <div>
        Зарегистрируйтесь с помощью учетной записи Facebook:
        <a class="fb_login_btn" onclick="fb_login();return false;">
            <img src="/skins/img/facebook.jpg" height="40" width="240">
        </a>
    </div>
    <div id="status">
    </div>
    <h1>Регистрация</h1>
    <?php if (!empty($error)) { ?>
        <div style="font-size:18px; color:#900; font-weight:bold; border:1px solid #CCC; background-color:white; margin:10px;"><?php echo $error; ?></div>
    <?php } ?>
    <?php if (isset($status) && $status == 'ok') { ?>
        <div>Вы успешно зарегистрировались. На ваш почтовый адрес отправлен код подтверждения.</div>
    <?php } else { ?>
        <?php echo $form->view(); ?>
    <?php } ?>
</div>
