<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php if (is_home() ) { bloginfo('name'); } else {?><?php wp_title('');?> | <?php bloginfo('name');} ?></title>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" media="screen" />
<link title="RSS 2.0" type="application/rss+xml" href="<?php bloginfo( 'url' ); ?>/?feed=rss" rel="alternate" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_deregister_script("jquery"); //取消默认调用的jquery ?>
<?php wp_head(); ?>
<script type="text/javascript">
</script>
<!--根据自己的需要修改-->
</head>