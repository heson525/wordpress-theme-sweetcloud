<div id="scrollbox">
  <?php $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 YEAR ) AND user_id='0' AND comment_author_email != 'heson525@163.com' AND comment_author_email != '514739890@qq.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 13";
$wall = $wpdb->get_results($query);
foreach ($wall as $comment)
{
if( $comment->comment_author_url )
$url = $comment->comment_author_url;
else $url="#";
$tmp = "<li><a rel='external nofollow' href='".$url."' title='".$comment->comment_author." (".$comment->cnt.")'>".get_avatar($comment->comment_author_email, 40)."</a></li>";
$output .= $tmp;
}
$output = "<ul>".$output."</ul>";
echo $output ;
?>
</div>
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
<p class="nocomments">这是一篇受密码保护的文章，请输入密码查看回复！</p>
<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
<h2 id="comments">
  <?php comments_number('快来拍砖吧！', '一块砖头已落地！', '已经搭了% 块砖头了！' );?>
</h2>
<ol class="commentlist">
  <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
</ol>
<?php previous_comments_link('&laquo; 翻翻以前的') ?>
<?php next_comments_link('看看最新的 &raquo;') ?>
<?php else : // this is displayed if there are no comments so far ?>
<?php if (comments_open()) : ?>
<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments">回复已关闭</p>
<?php endif; ?>
<?php endif; ?>
<?php if (comments_open()) : ?>
<div id="respond">
  <h2 class="pinglunkuang"><br/>
    <?php comment_form_title( '欢迎拍砖！', '回复给小 %s' ); ?>
  </h2>
  <div class="cancel-comment-reply"> <small>
    <?php cancel_comment_reply_link(); ?>
    </small> </div>
  <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
  <p>你必须 <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">登录</a> 才能发表评论.</p>
  <?php else : ?>
  
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    <?php if ( is_user_logged_in() ) : ?> 
    
  <p><small>您正以 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>的马甲登录. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">脱掉马甲 &raquo;</a></small></p>
  <?php else : ?>
	
	<?php if ( $comment_author != "" ) : ?>
    <script type="text/javascript">function setStyleDisplay(id, status){document.getElementById(id).style.display = status;}</script>
    <div class="form_row small"> <?php printf(__('<strong>%s</strong>欢迎回来！'), $comment_author) ?><span id="show_author_info"><a href="javascript:setStyleDisplay('author_info','');setStyleDisplay('show_author_info','none');setStyleDisplay('hide_author_info','');">
      <?php _e('换个马甲试一试 &raquo;'); ?>
      </a></span> <span id="hide_author_info"><a href="javascript:setStyleDisplay('author_info','none');setStyleDisplay('show_author_info','');setStyleDisplay('hide_author_info','none');">
      <?php _e('取消呗！ &raquo;'); ?>
      </a></span> </div>
    <?php endif; ?>
   
    <div id="author_info">
      <p>
        <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
        <label for="author"><small>姓名(必需)</small></label>
      </p>
      <p>
        <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
        <label for="email"><small>邮箱(必需)</small></label>
      </p>
      <p>
        <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
        <label for="url"><small>网站</small></label>
      </p>
    </div>
    <?php if ( $comment_author != "" ) : ?>
    <!-- 隐藏取消按钮, 隐藏资料输入框 --> 
    <script type="text/javascript">setStyleDisplay('hide_author_info','none');setStyleDisplay('author_info','none');</script>
    <?php endif; ?>
    <?php endif;  endif; ?>
    <p id="comment-txtarea">
      <textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
    </p>
    <p style="clear:both">
      <input name="submit" type="submit" id="submit" tabindex="5" value="写好啦！" />
      <br/>
      <?php include(TEMPLATEPATH . '/smiley.php'); ?>
      <?php comment_id_fields(); ?>
    </p>
    <?php do_action('comment_form', $post->ID); ?>
    <script type="text/javascript">
document.getElementById("comment").onkeydown = function (moz_ev) {
	var ev = null;
 
	if (window.event){
		ev = window.event;
	}
	else{
		ev = moz_ev;
	}
 
	if (ev != null && ev.ctrlKey && ev.keyCode == 13) {
		document.getElementById("submit").click();
	}
}
</script>
  </form>
</div> <?php endif; ?>
