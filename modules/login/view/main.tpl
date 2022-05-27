<?php if (!isset($_SESSION['user']['id'])) { ?>
    <div align="center">
        <div>
            Авторизируйтесь с помощью учетной записи Facebook:
            <a class="fb_login_btn" onclick="fb_login();return false;">
                <img src="/skins/img/facebook.jpg" height="40" width="240">
            </a>
        </div>
        <div id="status">
        </div>
        <h1>Авторизация на сайте</h1>
        <?php if (!empty($form->error)) { ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                <?php echo $form->error; ?>
            </div>
        <?php } ?>
        <?php echo $form->view(); ?>
    </div>
    <style>
        .form-login td {
            vertical-align: middle;
        }
    </style>
<?php } else { ?>
    <div>Вы авторизированы. Здравствуйте, ID: <?= htmlspecialchars($_SESSION['user']['id']); ?></div>
<?php } ?>
