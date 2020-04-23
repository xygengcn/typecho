<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}?>
<?php $this->need('header.php');?>
<div id="body" class="container" onclick="showOut()">
    <div id="main" role="main">
        <article class="article">
            <h1 class="article-title">
                <a itemprop="url" href="<?php $this->permalink();?>"><?php $this->title();?></a></h1>
            <div class="article-content">
                <?php $this->content();?>
            </div>
        </article>
        <?php $this->need('comments.php');?>
    </div><!-- end #main-->
</div>
<?php $this->need('footer.php');?>