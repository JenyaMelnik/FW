<?php
if (isset($_SESSION['notice'])) { ?>
    <p><b> <?= $_SESSION['notice'] ?> </b></p>
    <br>
    <?php unset($_SESSION['notice']);
} ?>

<form action="" method="post" enctype="multipart/form-data">
    <div>
        <table>
            <tr>
                <td width="300">Ваш логин:</td>
                <td><input type="text" name="login"
                           value="<?= htmlspecialchars($_SESSION['user']['login'] ?? '') ?>">
                </td>
                <td> <?= (htmlspecialchars($errors['login'] ?? '')) ?></td>
            </tr>
            <tr>
                <td>Ваш email:</td>
                <td><input type="text" name="email" value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>">
                </td>
                <td> <?= (htmlspecialchars($errors['email'] ?? '')) ?></td>
            </tr>
            <tr>
                <td>Прикрепленные социальные сети:</td>
                <td>
                    <?php
                    if (isset($userSocials)) {
                        foreach ($userSocials as $socialId => $socialName) { ?>
                            <b> <?= $socialName; ?> </b>
                            <a href="<?= createUrl('/login/edit') ?>?action=delete&id=<?= (int)$socialId; ?>"
                               onclick="return confirmDelete('Открепить социальный аккаунт?');">ОТКРЕПИТЬ</a>
                            <br>
                        <?php }
                    } else { ?>
                        <p>Нет прикрепленных социальных сетей.</p>
                    <?php } ?>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>Прикрепить новую сеть:</td>
                <td>
                    <?php
                    if (isset($allSocials)) {
                        foreach ($allSocials as $socialId => $socialName) { ?>
                            <a href="/" onclick="<?php if ($socialId === 1) {
                                echo 'add_fb_account();';
                            } elseif ($socialId === 2) {
                                echo 'add_vk_account();';
                            }?>return false;">
                                <?= $socialName; ?>
                            </a><br>
                        <?php }
                    }
                    ?>
                </td>
                <td id="additionResult"></td>
            </tr>
        </table>
        <br>
        <input type="submit" name="edit" value="Сохранить изменения">
    </div>
</form>
