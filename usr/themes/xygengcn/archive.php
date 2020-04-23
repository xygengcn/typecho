<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
?>
<?php $this->need('header.php');?>
<div id="body" class="container" onclick="showOut()">
    <div id="main" role="main">
        <div class='navbar'><i class='fa fa-folder-open'></i>
            <?php $this->archiveTitle(array('category' => _t('%s'), 'search' => _t('搜索 “%s”'), 'tag' => _t('%s'),
    'author' => _t('%s 发布的文章')), '', '');?>
        </div>
        <?php if ($this->have()): ?>
        <?php while ($this->next()): ?>
        <article class='post'>
            <?php if ($this->options->isCover): ?>
            <div class="cover">
                <a class='p-title' title="<?php $this->title();?>" href="<?php $this->permalink();?>" rel='bookmark'>
                    <img src="<?php getCover($this->content, $this->options->themeUrl);?>" alt="">
                </a>
            </div>
            <?php endif?>
            <div class="post-wrap">
                <div class='title'>
                    <a class='p-title' title="<?php $this->title();?>" href="<?php $this->permalink();?>"
                        rel='bookmark'><i class='fa fa-file-text-o'></i><?php $this->title();?></a>
                </div>
                <div class='info'>
                    <div class='white'>
                        <span class='date'><?php $this->date('Y-m-d');?></span>
                        <span class='dot'> - </span>
                        <span class='category'><?php $this->category(',');?></span>
                        <span class='dot'> - </span>
                        <span class='comment'><?php $this->commentsNum('0条评论', '1 条评论', '%d 条评论');?></span>
                        <span class='dot'> - </span>
                        <span><?php $this->views();?>次围观</span>
                    </div>
                </div>
                <br class="clearfix" />
                <div class="content">
                    <div class="entry"> <?php $this->excerpt(300, '......');?></div>
                </div>
            </div>
        </article>
        <?php endwhile;?>
        <?php else: ?>
        <article class="post">
            <div class="content"><?php _e('没有找到内容');?></div>
        </article>
        <?php endif;?>

        <?php $this->need('pageBar.php');?>
    </div><!-- end #main -->
</div>
<?php $this->need('footer.php');?>