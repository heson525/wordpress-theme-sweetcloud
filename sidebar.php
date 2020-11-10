<div id="cate">
  <h3>博文分类</h3>
  <ul>
    <?php wp_list_categories('show_count=1&title_li=0'); ?>
  </ul>
</div>
<div>
  <h3>蜜语年月</h3>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>
</div>
<div>
  <h3>一些页面</h3>
  <ul>
    <li><a href="<?php bloginfo( 'url' ); ?>">首页</a></li>
    <?php  wp_list_pages('depth=1&title_li=0&sort_column=menu_order&sort_order=ASC');?>
  </ul>
</div>
<div>
  <h3>热评文章</h3>
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
  </ul>
</div>
<div>
  <h3>最新小爪</h3>
  <?php //2010/4/25 更新 by willin
$limit_num = '10'; //这里定义显示的评论数量
$rc_comms = $wpdb->get_results("
 SELECT ID, post_title, comment_ID, comment_author, comment_author_email, comment_content
 FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts
 ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
 WHERE comment_approved = '1'
 AND comment_type = ''
 AND post_password = ''
 AND comment_author_email != 'heson525@163.com'  
 AND comment_author_email != '514739890@qq.com'
 ORDER BY comment_date_gmt
 DESC LIMIT $limit_num
 ");//把上面的邮箱改成你和你老婆的邮箱 这样就不会在文章页显示
$rc_comments = '';
foreach ($rc_comms as $rc_comm) { //get_avatar($rc_comm,$size='50') 50可以自己设置
$rc_comments .= "<div class=\"newComment\"><div class=\"avatar\">". get_avatar($rc_comm,$size='40')."</div><div class=\"wenzi\"><a href=\"". get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID . "\" title=\"on " . $rc_comm->post_title . "\">" . strip_tags($rc_comm->comment_content)."</a></div>"."<div class=\"commentName\">By ". $rc_comm->comment_author . "</div>"
 
. "</div>\n";
}

$rc_comments = convert_smilies($rc_comments);

echo $rc_comments;

?>
</div>
<div>
  <h3>情侣统计</h3>
  <ul>
    <li>日志总数：
      <?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?>
      篇</li>
    <li>建站天数：<?php echo floor((time()-strtotime(get_option('sweet_build')))/86400); ?> 天</li>
    <li>评论总数：<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?> 爪</li>
    <li>页面总数：
      <?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?>
      页</li>
    <li>标签总数：<?php echo $count_tags = wp_count_terms('post_tag'); ?> 个</li>
    <li>博友人数：
      <?php $users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users"); echo $users; ?>
      人</li>
  </ul>
</div>
<div>
  <h3>友情小窝</h3>
  <ul class="webshot">
    <?php get_links(-1, '<li>', '</li>', '', 0, 'rand', 0, 0, 30); ?>
  </ul>
</div>
<?php // 如果没有使用 Widget 才显示以下内容, 否则会显示 Widget 定义的内容
if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
?>
<?php endif; ?>
<div id="searchbox">
  <form name="form" id="searchform" action="<?php bloginfo( 'url' ); ?>/" method="post">
    <input  name="s" type="text" class="searchInput" id="text" onBlur="mousedown()" onClick="mouseover()" />
    <input class="searchBtn" type="submit" id="searchsubmit" value="Search"   />
  </form>
</div>

