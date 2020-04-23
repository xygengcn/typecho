<?php
include 'common.php';
include 'header.php';
include 'menu.php';

$stat = Typecho_Widget::widget('Widget_Stat');
?>
<div class="main dashboard">
    <div class="row">
        <div class="col-mb-12 col-wd-4 col-6">
            <div class="card shortcut">
                <div class="card-header">快捷方式</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-mb-4">
                            <a href="<?php $options->adminUrl('write-post.php');?>">
                                <i class="icon icon-edit">&#xe80c;</i>
                                <cite><?php _e('新建文章');?></cite>
                            </a>
                        </div>
                        <div class="col-mb-4">
                            <a href="<?php $options->adminUrl('manage-posts.php');?>">
                                <i class="icon icon-doc-text">&#xf0f6;</i>
                                <cite><?php _e('文章管理');?></cite>
                            </a>
                        </div>
                        <div class="col-mb-4">
                            <a href="<?php $options->adminUrl('manage-pages.php');?>">
                                <i class="icon icon-menu">&#xf0c9;</i>
                                <cite><?php _e('页面管理');?></cite>
                            </a>
                        </div>
                        <div class="col-mb-4">
                            <a href="<?php $options->adminUrl('themes.php');?>">
                                <i class="icon icon-adjust">&#xe80f;</i>
                                <cite><?php _e('更换外观');?></cite>
                            </a>
                        </div>
                        <div class="col-mb-4">
                            <a href="<?php $options->adminUrl('plugins.php');?>">
                                <i class="icon icon-puzzle">&#xe80d;</i>
                                <cite> <?php _e('插件管理');?></cite>
                            </a>
                        </div>
                        <?php if ($user->pass('administrator', true)): ?>
                        <div class="col-mb-4">
                            <a href="<?php $options->adminUrl('options-general.php');?>">
                                <i class="icon icon-cog">&#xe80e;</i>
                                <cite> <?php _e('系统设置');?></cite>
                            </a>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-mb-12 col-wd-4 col-6">
            <div class="card total">
                <div class="card-header">网站概要</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-mb-6">
                            <div class="num">
                                <h3>文章数量</h3>
                                <span><?php $stat->myPublishedPostsNum();?></span>
                            </div>
                        </div>
                        <div class="col-mb-6">
                            <div class="num">
                                <h3>分类数量</h3>
                                <span><?php $stat->categoriesNum()?></span>
                            </div>
                        </div>
                        <div class="col-mb-6">
                            <div class="num">
                                <h3>评论数量</h3>
                                <span><?php $stat->publishedCommentsNum()?></span>
                            </div>
                        </div>
                        <div class="col-mb-6">
                            <div class="num">
                                <h3>页面数量</h3>
                                <span><?php $stat->publishedPagesNum()?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-mb-12 col-wd-4 col-6">
            <div class="card latest-post">
                <div class="card-header"><?php _e('最近回复');?></div>
                <div class="card-body">
                    <?php Typecho_Widget::widget('Widget_Comments_Recent', 'pageSize=10')->to($comments);?>
                    <?php if ($comments->have()): ?>
                    <ul>
                        <?php while ($comments->next()): ?> 
                        <li>
                            <a href="<?php $comments->permalink();?>"
                                class="title"> <span>[<?php $comments->date('Y-n-j');?>]</span><?php _e($comments->author);?>:
                            <?php $comments->excerpt(15, '...');?>
                            </a>
                        </li>
                        <?php endwhile;?>
                    </ul>
                    <?php else: ?>
                    <div class="blank">暂无回复</div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="col-mb-12 col-wd-8 col-6">
            <div class="card">
                <div class="card-header">数据概览</div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-mb-12 col-wd-4 col-6">
            <div class="card latest-post">
                <div class="card-header"><?php _e('最近文章');?></div>
                <div class="card-body">
                    <?php Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize=5')->to($posts);?>
                    <?php if ($posts->have()): ?>
                    <ul>
                        <?php while ($posts->next()): ?>
                        <li>
                            <a href="<?php $posts->permalink();?>" class="title">
                                <span>[<?php $posts->date('Y-n-j');?>]</span><?php $posts->title();?>
                            </a>
                        </li>
                        <?php endwhile;?>
                    </ul>
                    <?php else: ?>
                    <div class="blank">暂无文章</div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
?>
<?php include 'footer.php';?>