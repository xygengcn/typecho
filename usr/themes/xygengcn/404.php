<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
?>
<?php $this->need('header.php');?>
<div id="body" class="container" onclick="showOut()">
    <div class="error-page">
        <h1>404</h1>
        <h2>你迷路了</h2>
        <a href="<?php $this->options->siteUrl();?>">回到首页</a>
    </div>

</div><!-- end #content-->
<?php $this->need('footer.php');?>