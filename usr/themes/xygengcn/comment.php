<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}?>

<div id="comments">
    <div class="navbar"><i class="icon icon-chat">&#xe807;</i><?php _e('读者疑问');?></div>
    <?php $this->comments()->to($comments);?>
    <?php if ($comments->have()): ?>
    <div class="content">
        <?php $comments->listComments();?>
    </div>
    <?php endif;?>
</div>
<!-- 发布评论 -->
<div id="commentpost">
    <?php if ($this->allow('comment')): ?>
    <div id="<?php $this->respondId();?>" class="respond">
        <div class="cancel-comment-reply">
            <?php $comments->cancelReply('没有疑问，不需提问了');?>
        </div>
        <form method="post" action="<?php $this->commentUrl();?>" id="comment-form" role="form">
            <div class="form-info">
                <?php if ($this->user->hasLogin()): ?>
                <div class="admin_info">
                    <a href="<?php $this->options->profileUrl();?>">
                        <?php $this->user->screenName();?>
                    </a>
                    <a href="<?php $this->options->logoutUrl();?>" title="Logout">
                        <?php _e('注销');?>
                    </a>
                </div>
                <?php else: ?>
                <label for="author" class="required">
                    <input type="text" name="author" id="author" class="text" placeholder="留下你的笔名吧!"
                        value="<?php $this->remember('author');?>" required />
                </label>
                <label for="mail" <?php if ($this->options->commentsRequireMail): ?> class="required" <?php endif;?>>
                    <input type="email" name="mail" id="mail" class="text" placeholder="别忘了留下你的邮箱!"
                        value="<?php $this->remember('mail');?>" <?php if ($this->options->commentsRequireMail): ?>
                        required<?php endif;?> />
                </label>

                <label for="url" <?php if ($this->options->commentsRequireURL): ?> class="required" <?php endif;?>>
                    <input type="url" name="url" id="url" class="text" placeholder="留下地址，以后拜访！"
                        value="<?php $this->remember('url');?>" <?php if ($this->options->commentsRequireURL): ?>
                        required<?php endif;?> /></label>
                <?php endif;?>
            </div>
            <label for="textarea" class="required">
                <textarea rows="5" name="text" id="textarea" class="textarea" placeholder="写下你的疑问？"
                    required><?php $this->remember('text');?></textarea>
            </label>
            <button type="submit" class="submit"><?php _e('提交疑问');?></button>
        </form>
    </div>
    <?php else: ?>
    <h3><?php _e('此笔记不需提问');?></h3>
    <?php endif;?>
</div>


<!-- 评论列表样式 -->
<?php function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
<li class="content-li" id="<?php $comments->theId();?>">
    <div class="content-info">
        <?php $comments->gravatar('40', '');?>
        <div class="content-info-author">
            <p><?php $comments->author();?></p>
            <p><?php $comments->date('Y-m-d H:i:s');?></p>
        </div>
        <div class="comment-reply"><?php $comments->reply("回答此问题");?></div>
    </div>
    <div class="content-text">
        <?php $comments->content();?>
    </div>
    <?php if ($comments->children) {?>
    <div class="comment-children">
        <?php $comments->threadedComments($options);?>
    </div>
    <?php }?>
</li>
<?php }?>