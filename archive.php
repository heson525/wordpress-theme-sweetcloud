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
        <div id="searchbox">
  <form name="form" id="searchform" action="<?php bloginfo( 'url' ); ?>/" method="post">
    <input  name="s" type="text" class="searchInput" id="text" onBlur="mousedown()" onClick="mouseover()" />
    <input class="searchBtn" type="submit" id="searchsubmit" value="Search"   />
  </form>
</div>
      </div>
      <div id="article<?php echo $style_item?>" class="postlist">
      <div class="archive"><div class="title"><?php wp_title('');?> 下的文章</div></div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article-single auth<?php echo $style_item?>">
          <div class="article-single-header">
            <h2 class="article-title"> <a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
              <?php the_title(); ?>
              </a> </h2>
          </div>
          <div class="post-content"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"..."); ?> </div>
           <div class="sub_desc"> <span class="authorSpan"><?php the_author() ?></span> <span class="dateSpan"><?php the_time('Y-m-j') ?></span>
          <?php if(function_exists('the_views')) { ?><span class="viewSpan"><?php the_views();?></span><?php } ?>
           
        </div>
        </div>
        <?php endwhile;endif;   ?><div class="navigation"><?php pagenavi(); ?></div>
      </div>
     
      <div class="clear"></div>
      <?php get_footer();?>
    </div>
  </div>
</div></div>
<?php wp_footer(); ?>
</body>
<script language="javascript">
//伸缩
$('.article-single-header').click(function(){  
	if($(this).next().is(':visible')){   
		$(this).children().children().text('努力载入中……');   
		window.location = $(this).children().children().attr('href');  
	}else{  
		$('.post-content').slideUp(300);  
		$(this).next().slideDown(500);   
	}
	return false;  
});
$('.article-single-header:first').click();  
 </script>
 


</html>