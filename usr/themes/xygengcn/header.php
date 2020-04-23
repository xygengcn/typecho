<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="<?php $this->options->charset();?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport"
        content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>
        <?php $this->archiveTitle(array('category' => _t('%s-分类'), 'search' => _t('包含关键字“ %s ”的文章'), 'tag' => _t('%s-标签'), 'author' => _t('%s 发布的文章')), '', ' - ');?>
        <?php $this->options->title();?>
        <?php _e(" - %s", $this->options->description);?>
    </title>
    <meta name="description" content="<?php $this->options->description()?>">
    <meta name="Keywords" content="<?php $this->options->keywords()?>">
    <!-- logo图标 -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php $this->options->themeUrl('static/images/favicon.png');?>"
        rel="external nofollow" />
    <link rel="bookmark" href="<?php $this->options->themeUrl('static/images/favicon.png');?>" />
    <meta name="apple-mobile-web-app-title" content="<?php $this->options->title();?>">
    <link rel="apple-touch-icon-precomposed" sizes="180x180"
        href="<?php $this->options->themeUrl('static/images/favicon-apple.png');?>">
    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/style.css');?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/swiper.min.css');?>">
    <!-- <link rel="stylesheet" href="<?php $this->options->themeUrl('static/fonts/css/animation.css');?>"> -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('static/highlight/prism.css');?>">
    <script src="<?php $this->options->themeUrl('static/highlight/prism.js');?>"></script>
    <script src="<?php $this->options->themeUrl('static/js/qrcode.min.js')?>"></script>
    <script src="<?php $this->options->themeUrl('static/js/swiper.min.js')?>"></script>
    <script src="<?php $this->options->themeUrl('static/js/script.js')?>"></script>
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header();?>
</head>

<body>
    <header id="nav">
        <div class="container nav-container">
            <div class="nav-logo">
                <a href="<?php $this->options->siteUrl();?>">
                    <img src="<?php $this->options->themeUrl('static/images/logo.png')?>" alt="">
                </a>
            </div>
            <div class="nav-bar" onclick="navOpen()"><i class="icon icon-menu">&#xf0c9;</i></div>
            <!-- 移动端菜单-->
            <div class="nav-drawer" id="nav-menu-drawer">
                <div class="nav-cover" onclick="navClose()"></div>
                <ul class="nav-ul">
                    <li class="nav-li"><a href="<?php $this->options->siteUrl();?>">首页</a></li>
                    <?php $this->widget('Widget_Metas_Category_List')->to($category);?>
                    <?php while ($category->next()): ?>
                    <li class="nav-li">
                        <a href="<?php $category->permalink();?>" lay-unselect><?php $category->name();?>
                        </a>
                    </li>
                    <?php endwhile;?>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages);?>
                    <?php while ($pages->next()): ?>
                    <li class="nav-li">
                        <a href="<?php $pages->permalink();?>" lay-unselect><?php $pages->title();?>
                        </a>
                    </li>
                    <li class="nav-li" id="msearchShow">
                        <a href="javascript:mshowIn();"><i class="icon icon-search">&#xe800;</i></a>
                    </li>
                    <li class="nav-li">
                        <a href="javascript:;" onclick="switchNight(this)"><i class="icon icon-moon">&#xf186;</i></a>
                    </li>
                    <?php endwhile;?>
                </ul>
            </div>
            <div class="nav-category">
                <ul class="nav-ul">
                    <li class="nav-li"><a href="<?php $this->options->siteUrl();?>">首页</a></li>
                    <?php $this->widget('Widget_Metas_Category_List')->to($category);?>
                    <?php while ($category->next()): ?>
                    <li class="nav-li">
                        <a href="<?php $category->permalink();?>" lay-unselect><?php $category->name();?>
                        </a>
                    </li>
                    <?php endwhile;?>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages);?>
                    <?php while ($pages->next()): ?>
                    <li class="nav-li">
                        <a href="<?php $pages->permalink();?>" lay-unselect><?php $pages->title();?>
                        </a>
                    </li>
                    <?php endwhile;?>
                    <li class="nav-li" id="searchShow">
                        <a href="javascript:showIn();"><i class="icon icon-search">&#xe800;</i></a>
                    </li>
                    <li class="nav-li">
                        <a href="javascript:;" onclick="switchNight(this)"><i class="icon icon-moon">&#xf186;</i></a>
                    </li>
                </ul>
            </div>
            <div id="searchBar">
                <form id="searchForm" method="get" action="<?php $this->options->siteUrl();?>">
                    <input type="text" id="s" name="s" class="text" placeholder="<?php _e('输入关键字搜索');?>"
                        autocomplete="off" value="<?php $this->is('search') ? $this->archiveTitle("") : ''?>" />
                    <button class="search-btn" type="submit">
                        <i class="icon icon-search">&#xe800;</i>
                    </button>
                </form>
                <div class="tags tagcloud">
                    <?php Typecho_Widget::widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=20')->to($tags);?>
                    <?php if ($tags->have()): ?>
                    <?php while ($tags->next()): ?>
                    <a href="<?php $tags->permalink();?>"><?php $tags->name();?></a>
                    <?php endwhile;?>
                    <?php endif;?>
                </div>
                <div class="close" onclick="showOut()"></div>
            </div>
        </div>
    </header><!-- end #header -->