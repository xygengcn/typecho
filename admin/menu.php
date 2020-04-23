<?php if (!defined('__TYPECHO_ADMIN__')) {
    exit;
}
Typecho_Plugin::factory('admin/menu.php')->navBar();?>
<div class="html">
    <div class="sidebar">
        <?php include 'sidebar.php'?>
    </div>
    <div class="wrap">
        <div class="nav" role="navigation">
            <div class="nav-menu"><a href="<?php $options->siteUrl();?>"><i class="icon icon-home">&#xe80a;</i> </a>
            </div>
            <div class="operate">
                <a href="<?php $options->adminUrl('profile.php');?>" class="author"
                    title="<?php $user->screenName();?>">
                    <i class="icon icon-user">&#xe802;</i>
                </a>
                <a class="exit" title="<?php if ($user->logged > 0) {$logged = new Typecho_Date($user->logged); _e('最后登录: %s', $logged->word());}?>" href="<?php $options->logoutUrl();?>"><?php _e('登出');?></a>
            </div>
        </div> 