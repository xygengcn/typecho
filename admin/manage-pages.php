<?php
include 'common.php';
include 'header.php';
include 'menu.php';

$stat = Typecho_Widget::widget('Widget_Stat');
?>
<div class="main">
    <div class="body container">
        <?php include 'page-title.php'; ?>
        <div class="row typecho-page-main" role="main">
            <div class="col-mb-12 typecho-list">
                <div class="typecho-list-operate clearfix">
                    <form method="get">
                        <div class="operate">
                            <label><input type="checkbox" class="typecho-table-select-all" /><span><?php _e('全选');?></span></label>
                             <a class="btn-opt" lang="<?php _e('你确认要删除这些文章吗?');?>" href="<?php $security->index('/action/contents-post-edit?do=delete');?>"><?php _e('删除所选');?></a>
                        </div>

                        <div class="search" role="search">
                            <?php if ('' != $request->keywords): ?>
                            <a href="<?php $options->adminUrl('manage-pages.php'); ?>"><?php _e('&laquo; 取消筛选'); ?></a>
                            <?php endif; ?>
                            <input type="text" class="text-s" placeholder="<?php _e('请输入关键字'); ?>" value="<?php echo htmlspecialchars($request->keywords); ?>" name="keywords" autocomplete="off"/>
                            <button type="submit" class="btn btn-s"><?php _e('筛选'); ?></button>
                        </div>
                    </form>
                </div><!-- end .typecho-list-operate -->
            
                <form method="post" name="manage_pages" class="operate-form">
                <div class="typecho-table-wrap">
                    <table class="typecho-list-table">
                        <colgroup>
                            <col width="20"/>
                            <col width=""/>
                            <col width="20%"/>
                            <col width="10%"/>
                            <col width="16%"/>
                            <col width="8%"/>
                            <col width="6%"/>
                            <col width="133"/>
                        </colgroup>
                        <thead>
                            <tr class="nodrag">
                                <th> </th> 
                                <th><?php _e('标题'); ?></th>
                                <th><?php _e('缩略名'); ?></th>
                                <th><?php _e('作者'); ?></th>
                                <th><?php _e('日期'); ?></th>
                                <th><?php _e('状态'); ?></th>
                                <th><?php _e('评论'); ?></th>
                                <th><?php _e('操作'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php Typecho_Widget::widget('Widget_Contents_Page_Admin')->to($pages); ?>
                        	<?php if($pages->have()): ?>
                            <?php while($pages->next()): ?>
                            <tr id="<?php $pages->theId(); ?>">
                                <td><input type="checkbox" value="<?php $pages->cid(); ?>" name="cid[]"/></td>
                                <td>
                                <a href="<?php $options->adminUrl('write-page.php?cid=' . $pages->cid); ?>"><?php $pages->title(); ?></a>
                                
                                </td>
                                <td><?php $pages->slug(); ?></td>
                                <td><?php $pages->author(); ?></td>
                                <td>
                                    <?php if ($pages->hasSaved): ?>
                                    <span class="description">
                                    <?php $modifyDate = new Typecho_Date($pages->modified); ?>
                                    <?php _e('保存于 %s', $modifyDate->word()); ?>
                                    </span>
                                    <?php else: ?>
                                    <?php $pages->dateWord(); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        if ($pages->hasSaved || 'page_draft' == $pages->type) {
                                            echo '<em class="status">' . _t('草稿') . '</em>';
                                        } else if ('hidden' == $pages->status) {
                                            echo '<em class="status">' . _t('隐藏') . '</em>';
                                        }else{
                                            echo '<em class="status">' . _t('正常') . '</em>';
                                        }
                                    ?>
                                </td>
                                <td><a href="<?php $options->adminUrl('manage-comments.php?cid=' . $pages->cid); ?>" class="balloon-button size-<?php echo Typecho_Common::splitByCount($pages->commentsNum, 1, 10, 20, 50, 100); ?>" title="<?php $pages->commentsNum(); ?> <?php _e('评论'); ?>"><?php $pages->commentsNum(); ?></a></td>
                                <td>
                                     <a href="<?php $options->adminUrl('write-page.php?cid=' . $pages->cid); ?>" class="edit-btn" title="<?php _e('编辑 %s', htmlspecialchars($pages->title)); ?>">编辑</a>
                                     <?php if ('page_draft' != $pages->type): ?>
                                     <a href="<?php $pages->permalink(); ?>"  class="view-btn" title="<?php _e('浏览 %s', htmlspecialchars($pages->title)); ?>">浏览</a>
                                     <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <tr>
                            	<td colspan="6"><h6 class="typecho-list-table-title"><?php _e('没有任何页面'); ?></h6></td>
                            </tr>
                            <?php endif; ?>
                            
                        </tbody>
                    </table>
                </div><!-- end .typecho-table-wrap -->
                </form><!-- end .operate-form -->
            </div><!-- end .typecho-list -->
        </div><!-- end .typecho-page-main -->
    </div>
</div>

<?php
include 'copyright.php';
include 'common-js.php';
include 'table-js.php';
?>

<?php if(!isset($request->status) || 'publish' == $request->get('status')): ?>
<script type="text/javascript">
(function () {
    $(document).ready(function () {
        var table = $('.typecho-list-table').tableDnD({
            onDrop : function () {
                var ids = [];

                $('input[type=checkbox]', table).each(function () {
                    ids.push($(this).val());
                });

                $.post('<?php $security->index('/action/contents-page-edit?do=sort'); ?>',
                    $.param({cid : ids}));
            }
        });
    });
})();
</script>
<?php endif; ?>

<?php include 'footer.php'; ?>
