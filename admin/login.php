<?php
include 'common.php';

if ($user->hasLogin()) {
    $response->redirect($options->adminUrl);
}
$rememberName = htmlspecialchars(Typecho_Cookie::get('__typecho_remember_name'));
Typecho_Cookie::delete('__typecho_remember_name');

include 'header.php';
?>
<div class="login-wrap">
    <div class="login-content">
        <h1><a href="<?php $options->siteUrl()?>" class="login-logo">Typecho</a></h1>
        <form action="<?php $options->loginAction();?>" method="post" name="login" role="form">
            <p>
                <label for="name">
                    <i class="icon icon-user">&#xe802;</i>
                    <input type="text" class="login-input" id="name" name="name" value="<?php echo $rememberName; ?>"
                        placeholder="<?php _e('用户名');?>" autofocus />
                </label>
            </p>
            <p>
                <label for="password">
                    <i class="icon icon-lock">&#xe803;</i>
                    <input type="password" class="login-input" id="password" name="password"
                        placeholder="<?php _e('密码');?>" />
                </label>
            </p>
            <p>
                <label for="remember"><input type="checkbox" name="remember" class="checkbox" value="1" id="remember"
                        checked="checked" />
                    <?php _e('自动登录');?></label>
            </p>
            <p class="submit">
                <button type="submit" class="login-btn"><?php _e('登录');?></button>
                <input type="hidden" name="referer" value="<?php echo htmlspecialchars($request->get('referer')); ?>" />
            </p>
        </form>

        <p class="reg">

            <?php if ($options->allowRegister): ?>
            <a href="<?php $options->registerUrl();?>"><button class="login-btn"><?php _e('用户注册');?></button></a>
            <?php endif;?>
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