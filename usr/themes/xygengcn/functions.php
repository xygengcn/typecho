<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
require_once 'function.php';
//编辑文章时显示
if ($_SERVER['SCRIPT_NAME'] == "/admin/write-post.php") {
    function themeFields($layout)
    {
        $intro = new Typecho_Widget_Helper_Form_Element_Textarea('intro', null, null, _t('文章摘要'), _t('给文章加入特定的摘要，在首页显示'));
        $layout->addItem($intro);
    }
}

function themeInit()
{
    Typecho_Plugin::factory('Widget_Archive')->___test = ['theme_plugin', 'test'];
}
//$this->options->AvatarUrl
//主题设置面板
function themeConfig($form)
{
    $AvatarUrl = new Typecho_Widget_Helper_Form_Element_Text('AvatarUrl', null, null, _t('博主头像'), null);
    $form->addInput($AvatarUrl);
    $qq = new Typecho_Widget_Helper_Form_Element_Text('qq', null, null, _t('QQ链接'), null);
    $form->addInput($qq);
    $weibo = new Typecho_Widget_Helper_Form_Element_Text('weibo', null, null, _t('微博链接'), null);
    $form->addInput($weibo);
    $github = new Typecho_Widget_Helper_Form_Element_Text('github', null, null, _t('Github链接'), null);
    $form->addInput($github);
    $gitee = new Typecho_Widget_Helper_Form_Element_Text('gitee', null, null, _t('Gitee链接'), null);
    $form->addInput($gitee);
    $isCover = new Typecho_Widget_Helper_Form_Element_Radio('isCover', array('0' => _t('关闭'), '1' => _t('开启')), 'disable', _t('文章封面'));
    $form->addInput($isCover);
    $announcement = new Typecho_Widget_Helper_Form_Element_Textarea('announcement', null, null, _t('公告'), null);
    $form->addInput($announcement);
}

//获取最热笔记
function getHotPosts($limit = 10)
{
    $db = Typecho_Db::get();
    $response = array();
    $result = $db->fetchAll($db->select()->from('table.contents')
            ->where('status = ?', 'publish')
            ->where('type = ?', 'post')
            ->where('created <= unix_timestamp(now())', 'post')
            ->limit($limit)
            ->order('views', Typecho_Db::SORT_DESC)
    );
    if ($result) {
        foreach ($result as $val) {
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
            $val['title'] = htmlspecialchars($val['title']);
            $val['date'] = $val['date']->format("Y-m-d");
            array_push($response, $val);
        }

    }
    return $response;
}
//获取logo
function getCover($content, $url)
{
    $temp = rand(1, 6);
    $img = $url . "/static/images/cover/cover$temp.png";
    preg_match_all("/\<img.*?src\=(\'|\")(.*?)(\'|\")[^>]*>/i", $content, $matches);
    $imgCount = count($matches[0]);
    if ($imgCount >= 1) {
        $img = $matches[2][0];
    }

    echo $img;
}