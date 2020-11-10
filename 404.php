<?php get_header(); ?>
<?php if (is_page())  { 
$style_item = 'Page'; 
} elseif (is_single()) { 
if ($post->post_author == '1') { 
$style_item = 'Male'; 
}
elseif ($post->post_author == '2') { 
$style_item = 'Female'; 
} 
} else { 
$style_item = 'Page'; 
} ?>
<body class="single"><div class="clouds">
<div id="wrapper">
  <div id="innerWrapper">
    <div id="pageTop"></div>
    <div id="pageHeader"><div id="anniversary"><span><?php echo floor((time()-strtotime(get_option('sweet_xianglian')))/86400);?></span>
<object type="application/x-shockwave-flash" data="<?php bloginfo('template_url'); ?>/anniversary.swf" width="180" height="180">
<param name="movie" value="<?php bloginfo('template_url'); ?>/anniversary.swf" />
<param name="wmode" value="transparent" />
</object></div>
        <ul id="pageNav">
          <li><a title="首页" href="<?php bloginfo( 'url' ); ?>" >首页</a></li>
          <?php  wp_list_pages('depth=1&title_li=0&sort_column=menu_order&sort_order=ASC');?>
        </ul>
      </div>
    <div id="pageContent">
      <div id="articleBridge">
        <div id="cate">
          <h3>博文分类</h3>
          <ul>
            <?php wp_list_categories('show_count=1&title_li=0'); ?>
          </ul>
        </div>
        <div id="">
          <h3>蜜语年月</h3>
          <ul>
            <?php wp_get_archives('type=monthly'); ?>
          </ul>
        </div>
      </div>
      <div id="article<?php echo $style_item?>" >
     
      <div class="errorPage"><h2>您要的页面未找到 -- 404 page</h2></div>
        
       
      </div>
     
      <div class="clear"></div>
      <?php get_footer();?>
    </div>
  </div>
</div></div>
<?php wp_footer(); ?>
</body>
</html>