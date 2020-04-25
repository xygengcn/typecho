<?php
if (!defined('__TYPECHO_ADMIN__')) {
    exit;
}
?>
<div class="sidebar">
    <div class="logo">
        <a href="<?php $options->adminUrl('index.php');?>"><h2><i class="icon icon-laptop">&#xf109;</i>管理后台</h2></a>
    </div>
    <div class="menu">
    
        <?php $menu->output();?>
    </div>
</div>