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
$style_item = 'normal'; 
} ?>
<body class="single"><div class="clouds">
<div id="wrapper">
  <div id="innerWrapper">
    <div id="pageTop"></div>
    <div id="pageHeader"><div id="anniversary"><span><?php echo floor((time()-strtotime(get_option('sweet_xianglian')))/86400);?></span><object type="application/x-shockwave-flash" data="<?php bloginfo('template_url'); ?>/anniversary.swf" width="180" height="180">
<param name="movie" value="<?php bloginfo('template_url'); ?>/anniversary.swf" />
<param name="wmode" value="transparent" />
</object></div>
      <ul>
        <li><a title="首页" href="<?php bloginfo( 'url' ); ?>" >首页</a></li>
        <?php  wp_list_pages('depth=1&title_li=0&sort_column=menu_order&sort_order=ASC');?>
      </ul>
    </div>
    <div id="pageContent">
      <div id="articleBridge">
         
        <?php get_sidebar();?>
      </div>
      <div id="article<?php echo $style_item?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article-single auth<?php echo $style_item?>">
          <div class="article-single-header">
            <h2 class="article-title">
              <?php the_title(); ?>
            </h2>
          <div class="sub_desc"> <span class="dateSpan"><?php the_time('Y-m-j') ?></span>
          <?php if(function_exists('the_views')) { ?><span class="viewSpan"><?php the_views();?></span><?php } ?>
           
        </div>
          </div> 
          <?php the_content('<p class="serif">' . __('Read the rest of this entry &raquo;', 'kubrick') . '</p>'); ?>
          <?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        </div>
        <?php endwhile;endif;  ?>
        <div id="articleComment">
          <?php comments_template(); ?>
        </div>
      </div>
      <div class="clear"></div>
      <?php get_footer();?>
    </div>
  </div>
</div></div>
<?php wp_footer(); ?>
</body>
</html>