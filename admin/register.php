<?php
include 'common.php';

if ($user->hasLogin() || !$options->allowRegister) {
    $response->redirect($options->siteUrl);
}
$rememberName = htmlspecialchars(Typecho_Cookie::get('__typecho_remember_name'));
$rememberMail = htmlspecialchars(Typecho_Cookie::get('__typecho_remember_mail'));
Typecho_Cookie::delete('__typecho_remember_name');
Typecho_Cookie::delete('__typecho_remember_mail');

$bodyClass = 'login-body';

include 'header.php';
?>
<div class="login-wrap">
    <div class="login-content">
        <h1><a href="<?php $options->siteUrl()?>" class="login-logo">Typecho</a></h1>
        <form action="<?php $options->registerAction();?>" method="post" name="register" role="form">
            <p>
                <label for="name">
                    <i class="icon icon-user">&#xe802;</i>
                    <input type="text" id="name" name="name" placeholder="<?php _e('用户名');?>"
                        value="<?php echo $rememberName; ?>" class="login-input" autofocus />
                </label>

            </p>
            <p>
                <label for="mail">
                    <i class="icon icon-mail">&#xe801;</i>
                    <input type="email" id="mail" name="mail" placeholder="<?php _e('Email');?>"
                        value="<?php echo $rememberMail; ?>" class="login-input" />
                </label>

            </p>
            <p class="submit">
                <button type="submit" class="login-btn"><?php _e('注册');?></button>
            </p>
        </form>
        <p class="reg">
            <a href="<?php $options->adminUrl('login.php');?>"><button class="login-btn"><?php _e('登录');?></button></a>
        </p>
    </div>
</div>
<?php
include 'common-js.php';
?>
<script>
$(document).ready(function() {
    $('#name').focus();
});
</script>
<?php
include 'footer.php';
?>