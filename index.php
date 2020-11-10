<?php get_header(); ?>
<body class="main">
<div class="clouds">
  <div id="wrapper">
    <div id="innerWrapper">
      <div id="pageTop"></div>
      <div id="pageHeader">
        <div id="anniversary"><span><?php echo floor((time()-strtotime(get_option('sweet_xianglian')))/86400);?></span>
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
      <?php

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$pagedType = ($_REQUEST['pagedType']) ? $_REQUEST['pagedType'] : "male";

	if ($pagedType != "male" && $pagedType != "female") $pagedType = "male";

	$otherSidePagedNum = ($_REQUEST['otherSidePagedNum']) ? $_REQUEST['otherSidePagedNum'] : 1;

	$malePaged = $paged;

	$femalePaged = $paged;

	if ($pagedType == "male")

		$femalePaged = $otherSidePagedNum;

	else

		$malePaged = $otherSidePagedNum;

?>
        <div id="articleMale">
          <?php  $limit = get_option('posts_per_page'); 
		  $paged = $malePaged;
		query_posts('author=1' . '&paged=' . $paged); ?>
          <?php if (have_posts()): ?>
          <?php while (have_posts()) : the_post(); ?>
   
		    <?php if (has_post_format('status')) :{ ?>
		               <div class="authMale status">
					   <div class="statusLeft"><div class="statusIcon"></div></div>
					   <div class="statusRight">
					   <div class="statusInfo">
					       <div class="statusAvatar"><?php echo get_avatar( get_the_author_email(), 40 ); ?></div>
						   <div class="statusAuthor"><strong><?php the_author() ?></strong> says:</div>
						   <div class="statusDate">in <?php the_time('Y.m.d') ?> <?php the_time('H:i') ?> <a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_author() ?> 的状态">Link</a></div>
							
					   </div><div class="clear"></div>
					   <div class="content"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?></div>
					    <div class="statusImg"><?php post_thumbnail( 290,100 ); ?></div>
					   
					   </div>
					   <div class="hr"></div>
					   </div>
					 
			<?php }elseif (has_post_format('video')) :{ ?>
			             <div class="authMale video">
						    <div class="videoUp">
							    <div class="videoIcon"></div>
								<div class="videoTitle"><h2 class="article-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
                </a></h2></div>
							</div>
							<div class="videoDown">
							   <div class="videoContent"><?php the_content();?></div>
							   <div class="videoImg" >
							      <div class="videoButton"></div>
							   </div>
							</div>
						 <div class="videoContentMain"></div>
						 <div class="hr"></div>
						 </div>
						 
			<?php }elseif (has_post_format('image')) :{ ?>
			               <div class="authMale image">     
						       <div class="imageUp">
							            <div class="imageIcon"></div>
										<div class="imageTitle"><h2 class="article-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
                </a></h2></div>
							   </div>
						       <div class="imageDown">
							         <div class="imageImg"><?php post_thumbnail( 300,200 ); ?>
									 <div class="imageContent"><strong>预览</strong><br /><div class="imageInnerContent"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 250,"..."); ?> <span><strong> <a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">Link</a></strong></span></div></div>
									 </div>
									 
							   </div>
						   <div class="hr"></div>
						   </div>
			
		    <?php }else: {?>
          <div class="authMale post-<?php the_ID(); ?>">
            <div class="article-header">
              <h2 class="article-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
                </a></h2>
            </div>
            <div class="article-info"> <span class="authorSpan">
              <?php the_author() ?>
              </span> <span class="cateSpan">
              <?php the_category(', ') ?>
              </span> </div>
            <div class="article-body article-content"> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"..."); ?> </div>
            <div class="article-footer"> <span class="commentSpan">
              <?php comments_popup_link('抢沙发！', '抢板凳！', '盖了%层楼'); ?>
              </span> <span class="viewSpan">
              <?php if(function_exists('the_views')) { the_views(); } ?>
              </span> </div>
          </div>
          <?php } ?>
          <?php endif;endwhile;  ?><div class="pageNavi">

		<?php pagenavi2("male", $malePaged, $femalePaged); ?>

	                       </div>
          <?php wp_reset_query(); 	endif;?>
        </div>
        <div id="articleFemale">
          <?php  $limit = get_option('posts_per_page'); 
		$paged = $femalePaged;
		query_posts('author=2' . '&paged=' . $paged); ?>
          <?php if (have_posts()): ?>
          <?php while (have_posts()) : the_post(); ?>
       
		
		    <?php if (has_post_format('status')) :{ ?>
		               <div class="authMale status">
					   <div class="statusLeft"><div class="statusIcon"></div></div>
					   <div class="statusRight">
					   <div class="statusInfo">
					       <div class="statusAvatar"><?php echo get_avatar( get_the_author_email(), 40 ); ?></div>
						   <div class="statusAuthor"><strong><?php the_author() ?></strong> says:</div>
						   <div class="statusDate">in <?php the_time('Y.m.d') ?> <?php the_time('H:i') ?> <a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_author() ?> 的状态">Link</a></div>
							
					   </div><div class="clear"></div>
					   <div class="content"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?></div>
					    <div class="statusImg"><?php post_thumbnail( 290,100 ); ?></div>
					   
					   </div>
					   <div class="hr"></div>
					   </div>
					 
			<?php }elseif (has_post_format('video')) :{ ?>
			             <div class="authMale video">
						    <div class="videoUp">
							    <div class="videoIcon"></div>
								<div class="videoTitle"><h2 class="article-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
                </a></h2></div>
							</div>
							<div class="videoDown">
							   <div class="videoContent"><?php the_content();?></div>
							   <div class="videoImg" >
							      <div class="videoButton"></div>
							   </div>
							</div>
						 <div class="videoContentMain"></div>
						 <div class="hr"></div>
						 </div>
						 
			<?php }elseif (has_post_format('image')) :{ ?>
			               <div class="authMale image">     
						       <div class="imageUp">
							            <div class="imageIcon"></div>
										<div class="imageTitle"><h2 class="article-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
                </a></h2></div>
							   </div>
						       <div class="imageDown">
							         <div class="imageImg"><?php post_thumbnail( 300,200 ); ?>
									 <div class="imageContent"><strong>预览</strong><br /><div class="imageInnerContent"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 250,"..."); ?> <span><strong> <a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">Link</a></strong></span></div></div>
									 </div>
									 
							   </div>
						   <div class="hr"></div>
						   </div>
			
		    <?php }else: {?>
          <div class="authFemale post-<?php the_ID(); ?>">
            <div class="article-header">
              <h2 class="article-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="阅读 <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
                </a></h2>
            </div>
            <div class="article-info"> <span class="authorSpan">
              <?php the_author() ?>
              </span> <span class="cateSpan">
              <?php the_category(', ') ?>
              </span> </div>
            <div class="article-body article-content"> <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"..."); ?> </div>
            <div class="article-footer"> <span class="commentSpan">
              <?php comments_popup_link('抢沙发！', '抢板凳！', '盖了%层楼'); ?>
              </span> <span class="viewSpan">
              <?php if(function_exists('the_views')) { the_views(); } ?>
              </span> </div>
          </div>
          <?php } ?>
          <?php endif;endwhile; ?><div class="pageNavi">

		<?php pagenavi2("female", $femalePaged, $malePaged); ?>

	</div>
          <?php wp_reset_query(); 	endif;?>
        </div>
        <div class="clear"></div>
      
        <?php get_footer();?>
      </div>
    </div>
  </div>
</div>
<div id="cebian">
  <div class="mod">
  <h3>链接</h3><div class="mod_nr">
    <ul class="webshot">
          <?php get_links(-1, '<li>', '</li>', '', 0, 'rand', 0, 0, 30); ?>
        </ul></div>
  </div>
  <div class="mod">
  <h3>分类</h3><div class="mod_nr">
   <ul>
    <?php wp_list_categories('show_count=1&title_li=0'); ?>
  </ul></div>
  </div>
  <div class="mod">
  <h3>年月</h3>
  <div class="mod_nr">
   <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>
</div>
<div class="mod">
  <h3>热评</h3><div  class="mod_nr">
  <ul>
    <?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 10");

foreach ($result as $post) {

setup_postdata($post);

$postid = $post->ID;

$title = $post->post_title;

$commentcount = $post->comment_count;

if ($commentcount != 0) { ?>
    <li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>"> <?php echo $title ?></a> {<?php echo $commentcount ?>}</li>
    <?php } } ?>
  </ul></div>
</div>
  </div>
  
  <div class="mod">
  <h3>统计</h3>
  <div class="mod_nr">
    <ul>
    <li>日志总数：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?>
      篇</li>
    <li>建站天数：<?php echo floor((time()-strtotime(get_option('sweet_build')))/86400); ?> 天</li>
    <li>评论总数：<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?> 爪</li>
    <li>页面总数：<?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?>
      页</li>
    <li>标签总数：<?php echo $count_tags = wp_count_terms('post_tag'); ?> 个</li>
    <li>博友人数：<?php $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users"); echo $users; ?>
      人</li>
  </ul></div>
  </div>
  <div class="stopcb" onClick="togglecebian(0)">收起侧边</div>
</div>


<div id="cebian2" onMouseOver="togglecebian()">展开侧边</div>
<?php wp_footer(); ?>
</body>
</html>