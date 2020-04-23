<?php
include 'common.php';
include 'header.php';
include 'menu.php';

$stat = Typecho_Widget::widget('Widget_Stat');
?>

<div class="main">
    <div class="body container profile">
        <?php include 'page-title.php';?>
        <div class="row">
            <div class="col-mb-12 col-tb-12 col-wd-4">
                <div class="card info">
                    <div class="card-header"><?php _e('个人概要');?></div>
                    <div class="card-body">
                        <div class="avatar">
                            <img src="<?php _e(Typecho_Common::gravatarUrl($user->mail, 220, 'X', 'mm', $request->isSecure()));?>"
                                alt="<?php $user->screenName()?>">
                            <a href="http://gravatar.com/emails/"> <button>修改头像</button></a>
                        </div>
                        <div class="more">
                            <ul>
                                <li><span>昵称：</span><?php $user->screenName();?></li>
                                <li><span>账号：</span><?php $user->name();?></li>
                                <li><span>文章：</span><?php $stat->myPublishedPostsNum()?></li>
                                <li><span>评论：</span><?php $stat->myPublishedCommentsNum()?></li>
                                <?php if ($user->logged > 0) {$logged = new Typecho_Date($user->logged);?>
                                <li><span>最后登陆：</span><?php _e($logged->word())?></li>
                                <?php }?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-mb-12 col-tb-12 col-wd-8">
                <div class="card">
                    <div class="card-header"><?php _e('基本资料');?></div>
                    <div class="card-body">
                        <?php Typecho_Widget::widget('Widget_Users_Profile')->profileForm()->render();?>
                    </div>
                </div>
            </div>
            <div class="col-mb-12 col-tb-12 col-wd-6">
                <div class="card" style="min-height:0">
                    <div class="card-header"><?php _e('密码修改');?></div>
                    <div class="card-body">
                        <?php Typecho_Widget::widget('Widget_Users_Profile')->passwordForm()->render();?>
                    </div>
                </div>
            </div>

            <div class="col-mb-12 col-tb-12 col-wd-6">
                <div class="card setting">
                    <div class="card-header"><?php _e('撰写设置');?></div>
                    <div class="card-body">
                        <?php if ($user->pass('contributor', true)): ?>
                        <?php Typecho_Widget::widget('Widget_Users_Profile')->optionsForm()->render();?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <?php Typecho_Widget::widget('Widget_Users_Profile')->personalFormList();?>
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'form-js.php';
Typecho_Plugin::factory('admin/profile.php')->bottom();
include 'footer.php';
?>