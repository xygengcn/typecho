<?php

/**
 * 这是XY笔记简约主题.
 *
 * @author 庚哥哥
 *
 * @version 1.0
 *
 * @see http://xygeng.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
$this->need('header.php');

?>
<div id="body" class="container" onclick="showOut()">
    <div id="owner">
        <div class="avatar">
            <img src="<?php if ($this->options->AvatarUrl): ?>
                <?php $this->options->AvatarUrl();?>
                <?php else: ?>
                <?php $this->options->themeUrl('static/images/avatar.jpg');?>
                <?php endif?>
            " alt="">
        </div>
        <div class="links">
            <ul>
                <li>
                    <a href="<?php $this->options->weibo()?>" target="_blank">
                        <i class="icon icon-weibo">&#xf18a;</i>
                    </a>
                </li>
                <li><a href="<?php $this->options->qq()?>" target="_blank"><i class="icon icon-qq">&#xf1d6;</i></a></li>
                <li><a href="<?php $this->options->gitee()?>" target="_blank"><i class="icon icon-git">&#xf1d3;</i></a>
                </li>
                <li><a href="<?php $this->options->github()?>" target="_blank">
                        <i class="icon icon-github-squared">&#xf300;</i> </a>
                </li>
            </ul>
        </div>
    </div>
    <div id='index' role='index'>
        <?php if($this->options->announcement!=""):?>
        <div class='navbar'><i class="icon icon-folder-open">&#xe806;</i>最新公告</div>
        <section class="announcement post"><?php $this->options->announcement() ?></section>
        <?php endif?>
        <div class='navbar'><i class="icon icon-folder-open">&#xe806;</i>最热笔记</div>
        <div class="swiper-container" id="hots">
            <div class="swiper-wrapper">
                <?php foreach (getHotPosts() as $value): ?>
                <div class="swiper-slide">
                    <div class="swiper-card">
                        <div class="card-img"> <a title="<?php _e($value['title']);?>"
                                href="<?php _e($value['permalink'])?>" rel='bookmark'>
                                <img src="<?php getCover($value['content'], $this->options->themeUrl);?>">
                            </a></div>
                        <div class="card-info">
                            <h2><a title="<?php _e($value['title']);?>"
                                    href="<?php _e($value['permalink'])?>"><?php _e($value['title'])?></a></h2>
                            <div class="card-meta">
                                <span><i class="icon icon-calendar">&#xe808;</i><?php _e($value['date'])?></span>
                                <span><i class="icon icon-comment">&#xe809;</i><?php _e($value['commentsNum'])?></span>
                                <span><i class="icon icon-fire">&#xe810;</i><?php _e($value['views'])?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <div class="swiper-btn">
                <span class="btn-prev"><i class="icon icon-left-dir">&#xe811;</i></span>
                <span class="btn-next"><i class="icon icon-right-dir">&#xe812;</i></span>
            </div>
        </div>
        <div class='navbar'><i class="icon icon-folder-open">&#xe806;</i>最新笔记</div>
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
                    <?php if ($this->order == 1): ?>
                    <b style="color:#04B872;">【置顶】</b>
                    <?endif?>
                    <a class='p-title' title="<?php $this->title();?>" href="<?php $this->permalink();?>"
                        rel='bookmark'><i class="icon icon-doc-text">&#xf0f6;</i><?php $this->title();?></a>
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
                    <div class="entry">
                        <?php if ($this->fields->intro): ?>
                        <?php $this->fields->intro()?>
                        <?php else: ?>
                        <?php $this->excerpt(200, '......');?>
                        <?php endif;?>
                    </div>
                </div>
            </div>

        </article>
        <?php endwhile;?>
        <?php $this->need('pageBar.php');?>
    </div><!-- end #main-->
</div>
<script>
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 40,
    freeMode: false,
    navigation: {
        nextEl: '.btn-next',
        prevEl: '.btn-prev',
    },
    breakpoints: {
        468: {
            slidesPerView: 2,
            spaceBetween: 20,

        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 20
        }
    }
});
</script>
<?php
$this->need('footer.php');
?>