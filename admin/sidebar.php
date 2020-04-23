<?php
if (!defined('__TYPECHO_ADMIN__')) {
    exit;
}
?>
<div class="sidebar">
    <div class="logo">
        <h2><i class="icon icon-laptop">&#xf109;</i>管理后台</h2>
    </div>
    <div class="menu">
    
        <?php $menu->output();?>
    </div>
</div>