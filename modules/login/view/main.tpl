<?php if(!isset($_SESSION['user']['id'])) { ?>
	<div align="center">
        <div>
            Авторизируйтесь с помощью учетной записи Facebook:
            <fb:login-button size="large" scope="public_profile,email" onlogin="checkLoginState();">
            </fb:login-button>
        </div>
        <div id="status">
        </div>
		<h1>Авторизация на сайте</h1>
		<?php if(!empty($form->error)) { ?>
			<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?php echo $form->error; ?></div>
		<?php } ?>
		<?php echo $form->view(); ?>
	</div>
	<style>
		.form-login td {
			vertical-align:middle;
		}
	</style>
<?php } else { ?>
	<div>Вы авторизированы. Здравствуйте, ID: <?=htmlspecialchars($_SESSION['user']['id']);?></div>
<?php } ?>