<?php get_header(); ?>
<?php if (is_page())  { 
$style_item = 'special'; 
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
<body class="single">
<div class="clouds">
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
          <div id="authorAvatar">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php echo get_avatar( get_the_author_id(), $size = '125', $default = '<path_to_url>' );endwhile;endif; ?></div>
          <?php get_sidebar();?>
        </div>
        <div id="article<?php echo $style_item?>">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="article-single auth<?php echo $style_item?>">
            <div class="article-single-header">
              <h2 class="article-title">
                <?php the_title(); ?>
              </h2>
              <div class="sub_desc"> <span class="authorSpan">
                <?php the_author() ?>
                </span> <span class="dateSpan">
                <?php the_time('Y-m-j') ?>
                </span>
                <?php if(function_exists('the_views')) { ?>
                <span class="viewSpan">
                <?php the_views();?>
                </span>
                <?php } ?>
              </div>
            </div>
            <?php the_content('<p class="serif">' . __('Read the rest of this entry &raquo;', 'kubrick') . '</p>'); ?>
            <?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            <div class="article-info">
              <div class="copyright">
                <p><strong>本站遵循:</strong><a class="rule" target="_blank" href="http://creativecommons.org/licenses/by-nc-sa/2.5/cn/">署名-非商业性使用-相同方式共享</a><br />
                  <strong>本文标题：</strong><a href="<?php echo (get_permalink($post->ID));?>"  title=
   "<?php echo ($post->post_title);?>"><?php echo ($post->post_title);?></a> <br />
   <strong>订阅地址：</strong><a href="<?php bloginfo( 'url' ); ?>/?feed=rss"  title="订阅" ><?php bloginfo('name'); ?></a> <br />
                  <strong>转载请注明：</strong><a href="<?php echo (get_permalink($post->ID));?>"  title=
   "<?php echo ($post->post_title);?>"><?php echo (get_permalink($post->ID));?></a> <br />
                  <br />
                  <!-- share to micro-blog --> 
                  
                 <a href="http://share.renren.com/share/buttonshare.do?link=<?php echo urlencode(get_permalink($post->ID));?>&title=<?php echo urlencode($post->post_title);?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/pic/share/renren.png" alt="人人网" title="人人网" /></a> &nbsp;<a href="http://v.t.sina.com.cn/share/share.php?url=<?php echo urlencode(get_permalink($post->ID));?>&title=<?php echo urlencode($post->post_title);?>&source=&sourceUrl=" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/pic/share/sina.png" alt="sina" title="新浪微博" /></a> &nbsp;<a href="http://www.kaixin001.com/repaste/share.php?rtitle=<?php echo urlencode($post->post_title);?>&rurl=<?php echo urlencode(get_permalink($post->ID));?>&rcontent=" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/pic/share/kaixin.png" alt="开心" title="开心" /></a> &nbsp;<a href="http://www.douban.com/recommend/?url=<?php echo urlencode(get_permalink($post->ID));?>&title=<?php echo urlencode($post->post_title);?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/pic/share/douban.png" alt="豆瓣" title="豆瓣" /></a> &nbsp;<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo urlencode(get_permalink($post->ID));?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/pic/share/qq.png" alt="QQ空间" title="QZone" /></a> &nbsp;<a href="http://www.follow5.com/f5/jsp/plugin/5share/5ShareNote.jsp?title=<?php echo urlencode($post->post_title);?>&url=<?php echo urlencode(get_permalink($post->ID));?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/pic/share/follow.png" alt="Follow5" title="Follow5" /></a> &nbsp;<a href="http://hot.tianya.cn/Add.aspx?title=<?php echo urlencode($post->post_title);?>&url=<?php echo urlencode(get_permalink($post->ID));?>&desc=<?php echo urlencode($post->post_title);?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/pic/share/tianya.png" alt="tianya.cn" title="天涯" /></a> <br />
                  
                  <!-- end of share to mblog --> 
                </p>
              </div>
              <span class="cateSpan">
              <?php the_category(', ') ?>
              </span> <span class="tagSpan">
              <?php the_tags( __('小标签:', 'kubrick') . ' ', ', '); ?>
              </span></div>
          </div>
          <?php endwhile;endif;  ?>
          <div id="relatedContent">
            <div class="zuo">
             <?php relatedpost();
?>
            </div>
            <div class="you">
              <h3>最新发表</h3>
              <ul>
                <?php get_archives('postbypost', 8); ?>
              </ul>
            </div>
          </div>
          <div id="articleComment">
            <?php comments_template(); ?>
          </div>
        </div>
        <div class="clear"></div>
        <?php get_footer();?>
      </div>
    </div>
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>