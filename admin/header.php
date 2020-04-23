<?php
if (!defined('__TYPECHO_ADMIN__')) {
    exit;
}
//
// <link rel="stylesheet" href="' . Typecho_Common::url('style.css?v=' . $suffixVersion, $options->adminStaticUrl('css')) . '">

$header = '<link rel="stylesheet" href="' . Typecho_Common::url('normalize.css?v=' . $suffixVersion, $options->adminStaticUrl('css')) . '">
<link rel="stylesheet" href="' . Typecho_Common::url('grid.css?v=' . $suffixVersion, $options->adminStaticUrl('css')) . '">
<link rel="stylesheet" href="' . Typecho_Common::url('style.css?v=' . $suffixVersion, $options->adminStaticUrl('css')) . '">
<link rel="stylesheet" href="' . $options->adminUrl . '/css/admin.css">
<!--[if lt IE 9]>
<script src="' . Typecho_Common::url('html5shiv.js?v=' . $suffixVersion, $options->adminStaticUrl('js')) . '"></script>
<script src="' . Typecho_Common::url('respond.js?v=' . $suffixVersion, $options->adminStaticUrl('js')) . '"></script>
<![endif]-->';

/** 注册一个初始化插件 */
$header = Typecho_Plugin::factory('admin/header.php')->header($header);

?>
<!DOCTYPE HTML>
<html class="no-js">

<head>
    <meta charset="<?php $options->charset();?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php _e('%s - %s', $menu->title, $options->title);?></title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" type="image/x-icon" href="<?php $options->adminUrl('img/favicon.png');?>"
        rel="external nofollow" />
    <link rel="bookmark" href="<?php $options->adminUrl('img/favicon.png');?>" />
    <meta name="apple-mobile-web-app-title" content="XY笔记">
    <link rel="apple-touch-icon-precomposed" sizes="180x180"
        href="<?php $options->adminUrl('img/favicon-apple.png');?>">
    <?php echo $header; ?>
</head>

<body>

    <!--[if lt IE 9]>
        <div class="message error browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>');?>.</div>
    <![endif]-->