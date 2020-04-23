<?php $comments->sequence();?>
<?php $comments->responseUrl();?>
<?php $comments->responseId();?>
<?php $comments->trackbackUrl();?>
<?php $comments->author();?>
<?php $comments->date('F jS, Y');?>
<?php $comments->date('h:i a');?>
<?php $comments->content();?>
<?php $comments->gravatar('100', '');?>
<?php $comments->reply();

// //解决分页问题
// function themeInit($archive)
// {
//     if ($archive->is('index')) {
//         $archive->parameter->pageSize = 2; // 自定义条数
//     }
// }