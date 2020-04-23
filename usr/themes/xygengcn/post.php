<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
?>
<?php $this->need('header.php');?>
<div id="body" class="container" onclick="showOut()">
    <div id="main" role="main">
        <article>
            <h1 class="post-title">
                <a href="<?php $this->permalink()?>"><?php $this->title()?></a>
            </h1>
            <div class="post-info">
                <span><i class="icon icon-user">&#xe802;</i>：<?php $this->author();?></span>
                <span><i class="icon icon-calendar">&#xe808;</i> ： <?php $this->date('Y/m/d');?></span>
                <span><i class="icon icon-anchor">&#xf13d;</i>：<?php $this->category(',');?></span>
                <span><i class="icon icon-comment">&#xe809;</i>：<?php $this->commentsNum();?></span>
                <span><i class="icon icon-eye">&#xe804;</i> <span class="i-name">：<?php $this->views();?></span>
            </div>
            <div class="post-content">
                <?php $this->content();?>
            </div>
        </article>
        <?php if ($this->tags): ?>
        <div class="post-tags">
            <div class='navbar'><i class="icon icon-tags">&#xe805;</i>笔记标签</div>
            <div class="content"><?php $this->tags('', true, '');?></div>
        </div>
        <?php endif;?>
        <?php $this->need('comment.php');?>
    </div><!-- end #main-->
</div>
<?php $this->need('footer.php');?>