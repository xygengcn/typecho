<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}?>

<div class="pageBar">
    <?php $this->pageNav('上一页', '下一页', 3, '...', array('wrapTag' => 'ul', 'wrapClass' => 'page-ul', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next'));?>
</div>