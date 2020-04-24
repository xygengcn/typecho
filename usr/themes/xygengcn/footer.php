<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
?>
<?php if (!$this->user->hasLogin()): ?>
<?php Monitor();?>
<?php endif; ?>
<footer>
    <p>
        <span>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl();?>"><?php $this->options->title();?></a></span>
        <span>Powered By Typecho&#8194;Writered By GameGeng</span>
    </p>
</footer>

<?php $this->footer();?>
</body>
</html>