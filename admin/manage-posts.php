<?php
include 'common.php';
include 'header.php';
include 'menu.php';

$stat = Typecho_Widget::widget('Widget_Stat');
$posts = Typecho_Widget::widget('Widget_Contents_Post_Admin');
$isAllPosts = ('on' == $request->get('__typecho_all_posts') || 'on' == Typecho_Cookie::get('__typecho_all_posts'));
?>
<div class="main">
    <div class="body container manage-posts">
        <?php include 'page-title.php';?>
        <div class="row typecho-page-main" role="main">
            <div class="col-mb-12 typecho-list">
                <div class="clearfix">
                    <ul class="typecho-option-tabs right">
                        <?php if ($user->pass('editor', true) && !isset($request->uid)): ?>
                        <li class="<?php if ($isAllPosts): ?> current<?php endif;?>"><a
                                href="<?php echo $request->makeUriByRequest('__typecho_all_posts=on'); ?>"><?php _e('所有');?></a>
                        </li>
                        <li class="<?php if (!$isAllPosts): ?> current<?php endif;?>"><a
                                href="<?php echo $request->makeUriByRequest('__typecho_all_posts=off'); ?>"><?php _e('我的');?></a>
                        </li>
                        <?php endif;?>
                    </ul>
                    <ul class="typecho-option-tabs">
                        <li<?php if (!isset($request->status) || 'all' == $request->get('status')): ?> class="current"
                            <?php endif;?>><a href="<?php $options->adminUrl('manage-posts.php'.(isset($request->uid) ? '?uid=' . $request->uid : ''));?>"><?php _e('可用');?></a></li>
                            <li<?php if ('waiting' == $request->get('status')): ?> class="current" <?php endif;?>><a
                                    href="<?php $options->adminUrl('manage-posts.php?status=waiting'.(isset($request->uid) ? '&uid=' . $request->uid : ''));?>"><?php _e('待审核');?>
                                    <?php if (!$isAllPosts && $stat->myWaitingPostsNum > 0 && !isset($request->uid)): ?>
                                    <span class="balloon"><?php $stat->myWaitingPostsNum();?></span>
                                    <?php elseif ($isAllPosts && $stat->waitingPostsNum > 0 && !isset($request->uid)): ?>
                                    <span class="balloon"><?php $stat->waitingPostsNum();?></span>
                                    <?php elseif (isset($request->uid) && $stat->currentWaitingPostsNum > 0): ?>
                                    <span class="balloon"><?php $stat->currentWaitingPostsNum();?></span>
                                    <?php endif;?>
                                </a></li>
                                <li<?php if ('draft' == $request->get('status')): ?> class="current" <?php endif;?>><a
                                        href="<?php $options->adminUrl('manage-posts.php?status=draft'. (isset($request->uid) ? '&uid=' . $request->uid : ''));?>"><?php _e('草稿');?>
                                        <?php if (!$isAllPosts && $stat->myDraftPostsNum > 0 && !isset($request->uid)): ?>
                                        <span class="balloon"><?php $stat->myDraftPostsNum();?></span>
                                        <?php elseif ($isAllPosts && $stat->draftPostsNum > 0 && !isset($request->uid)): ?>
                                        <span class="balloon"><?php $stat->draftPostsNum();?></span>
                                        <?php elseif (isset($request->uid) && $stat->currentDraftPostsNum > 0): ?>
                                        <span class="balloon"><?php $stat->currentDraftPostsNum();?></span>
                                        <?php endif;?>
                                    </a></li>
                    </ul>
                </div>

                <div class="typecho-list-operate clearfix">
                    <form method="get">
                        <div class="operate">
                            <label><input type="checkbox" class="typecho-table-select-all" /><span><?php _e('全选');?></span></label>
                             <a class="btn-opt" lang="<?php _e('你确认要删除这些文章吗?');?>" href="<?php $security->index('/action/contents-post-edit?do=delete');?>"><?php _e('删除所选');?></a>
                        </div>
                        <div class="search" role="search">
                            <?php if ('' != $request->keywords || '' != $request->category): ?>
                            <a href="<?php $options->adminUrl('manage-posts.php'. (isset($request->status) || isset($request->uid) ? '?' .
        (isset($request->status) ? 'status=' . htmlspecialchars($request->get('status')) : '') .
        (isset($request->uid) ? '?uid=' . htmlspecialchars($request->get('uid')) : '') : ''));?>" class="btn-opt"><?php _e('&laquo; 取消筛选');?></a>
                            <?php endif;?>
                            <select name="category">
                                <option value=""><?php _e('所有分类');?></option>
                                <?php Typecho_Widget::widget('Widget_Metas_Category_List')->to($category);?>
                                <?php while ($category->next()): ?>
                                <option value="<?php $category->mid();?>"
                                    <?php if ($request->get('category') == $category->mid): ?> selected="true"
                                    <?php endif;?>><?php $category->name();?></option>
                                <?php endwhile;?>
                            </select>
                            <input type="text" class="text-s" placeholder="<?php _e('请输入关键字');?>"
                                value="<?php echo htmlspecialchars($request->keywords); ?>" name="keywords" autocomplete="off"/>
                            
                            <button type="submit" class="btn btn-s"><?php _e('筛选');?></button>
                            <?php if (isset($request->uid)): ?>
                            <input type="hidden" value="<?php echo htmlspecialchars($request->get('uid')); ?>"
                                name="uid" />
                            <?php endif;?>
                            <?php if (isset($request->status)): ?>
                            <input type="hidden" value="<?php echo htmlspecialchars($request->get('status')); ?>"
                                name="status" />
                            <?php endif;?>
                        </div>
                    </form>
                </div><!-- end .typecho-list-operate -->

                <form method="post" name="manage_posts" class="operate-form">
                    <div class="typecho-table-wrap">
                        <table class="typecho-list-table">
                            <colgroup>
                                <col width="20" />
                                <col width="" />
                                <col width="10%" />
                                <col width="10%" />
                                <col width="15%" />
                                <col width="10%" />
                                <col width="6%" />
                                <col width="6%" />
                                <col width="133" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?php _e('标题');?></th>
                                    <th><?php _e('作者');?></th>
                                    <th><?php _e('分类');?></th>
                                    <th><?php _e('日期');?></th>
                                    <th><?php _e('状态');?></th>
                                    <th><?php _e('评论'); ?></th>
                                    <th><?php _e('浏览'); ?></th>
                                    <th><?php _e('操作');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($posts->have()): ?>
                                <?php while ($posts->next()): ?>
                                <tr id="<?php $posts->theId();?>">
                                    <td><input type="checkbox" value="<?php $posts->cid();?>" name="cid[]" /></td>
                                    
                                    <td>
                                        <a
                                            href="<?php $options->adminUrl('write-post.php?cid=' . $posts->cid);?>"><?php $posts->title();?></a>

                                    </td>
                                    <td><a
                                            href="<?php $options->adminUrl('manage-posts.php?uid=' . $posts->author->uid);?>"><?php $posts->author();?></a>
                                    </td>
                                    <td><?php $categories = $posts->categories;?>
                                        <?php foreach ($categories as $key => $val): ?>
                                        <a
                                            href="'<?php $options->adminUrl('manage-posts.php?category=' . $val['mid'] . (isset($request->uid) ? '&uid=' . $request->uid : '') . (isset($request->status) ? '&status=' . $request->status : ''));?>"><?php _e($val['name'])?></a>
                                        <?php endforeach;?>
                                    </td>
                                    <td>
                                        <?php if ($posts->hasSaved): ?>
                                        <span class="description">
                                            <?php $modifyDate = new Typecho_Date($posts->modified);?>
                                            <?php _e('保存于 %s', $modifyDate->word());?>
                                        </span>
                                        <?php else: ?>
                                        <?php $posts->dateWord();?>
                                        <?php endif;?>
                                    </td>
                                    <td>
                                        <?php if ($posts->hasSaved || 'post_draft' == $posts->type): ?>
                                        <?php echo '<em class="status">' . _t('草稿') . '</em>'; ?>
                                        <?php elseif ('hidden' == $posts->status): echo '<em class="status">' . _t('隐藏') . '</em>';?>
                                        <?php elseif ('waiting' == $posts->status): echo '<em class="status">' . _t('待审核') . '</em>';?>
                                        <?php elseif ('private' == $posts->status): echo '<em class="status">' . _t('私密') . '</em>';?>
                                        <?php elseif ($posts->password): echo '<em class="status">' . _t('密码保护') . '</em>';?>
                                        <?php else:echo '<em class="status">' . _t('正常') . '</em>';?>
                                        <?php endif;?>
                                    </td>
                                    <td><a href="<?php $options->adminUrl('manage-comments.php?cid=' . ($posts->parentId ? $posts->parentId : $posts->cid));?>"
                                            class="commentsNum balloon-button size-<?php echo Typecho_Common::splitByCount($posts->commentsNum, 1, 10, 20, 50, 100); ?>"
                                            title="<?php $posts->commentsNum();?> <?php _e('评论');?>"><?php $posts->commentsNum();?></a>
                                    </td>
                                    <td><a href="<?php $posts->permalink();?>"><?php $posts->views();?></a></td>
                                    <td>
                                        <a href="<?php $options->adminUrl('write-post.php?cid=' . $posts->cid);?>"
                                            class="edit-btn">编辑</a>
                                        <?php if ('post_draft' != $posts->type): ?>
                                        <a href="<?php $posts->permalink();?>"
                                            title="<?php _e('浏览 %s', htmlspecialchars($posts->title));?>"
                                            class="view-btn">浏览</a>
                                        <?php endif;?>
                                    </td>
                                </tr>
                                <?php endwhile;?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="9">
                                        <h6 class="typecho-list-table-title"><?php _e('没有任何文章');?></h6>
                                    </td>
                                </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </form><!-- end .operate-form -->

                <div class="typecho-list-operate clearfix">
                    <form method="get">
                        <div class="operate">
                            <label><input type="checkbox" class="typecho-table-select-all" /><span><?php _e('全选');?></span></label>
                             <a class="btn-opt" lang="<?php _e('你确认要删除这些文章吗?');?>" href="<?php $security->index('/action/contents-post-edit?do=delete');?>"><?php _e('删除所选');?></a>
                        </div>

                        <?php if ($posts->have()): ?>
                        <ul class="typecho-pager">
                            <?php $posts->pageNav();?>
                        </ul>
                        <?php endif;?>
                    </form>
                </div><!-- end .typecho-list-operate -->
            </div><!-- end .typecho-list -->
        </div><!-- end .typecho-page-main -->
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'table-js.php';
include 'footer.php';
?>