<?php
/**
 * 自定义页面模板
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
$this->need('header.php');?>

<div id="body" class="container" onclick="showOut()">
</div>


<?php $this->need('footer.php');?>