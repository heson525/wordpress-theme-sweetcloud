<?php
//插入视频
//插入视频自带的
function for_sweetclouds( $content ) {
    $schema = array('/^<p>http:\/\/v\.youku\.com\/v_show\/id_([a-z0-9_=\-]+)\.html((\?|#|&).*?)*?\s*<\/p>\s*$/im' => '<div class="videoObject" ><embed src="http://player.youku.com/player.php/sid/$1/v.swf" quality="high" width="360px" height="245px" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"></embed></div>',
        '/^<p>http:\/\/www\.56\.com\/[a-z0-9]+\/v_([a-z0-9_\-]+)\.html((\?|#|&).*?)*?\s*<\/p>\s*$/im' => '<div class="videoObject" ><embed src="http://player.56.com/v_$1.swf" type="application/x-shockwave-flash" width="360px" height="245px" allowNetworking="all" allowScriptAccess="always"></embed></div>',
        '/^<p>http:\/\/www\.tudou\.com\/programs\/view\/([a-z0-9_\-]+)[\/]?((\?|#|&).*?)*?\s*<\/p>\s*$/im' => '<div class="videoObject" ><embed src="http://www.tudou.com/v/$1/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="360px" height="245px"></embed></div>');

    foreach ( $schema as $pattern => $replacement ) {
        $content = preg_replace( $pattern, $replacement, $content );
    }
    
    return $content;
}
   
add_filter( 'the_content', 'for_sweetclouds' );
//缩略图支持
add_theme_support( 'post-thumbnails' );
// 缩略图
function post_thumbnail( $width = 290,$height = 100 ){
    global $post;
    if( has_post_thumbnail() ){    //如果有缩略图，则显示缩略图
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" class="thumb" />';
        echo $post_timthumb;
    } else {
        $post_timthumb = '';
        ob_start();
        ob_end_clean();
        $output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $index_matches);    //获取日志中第一张图片
        $first_img_src = $index_matches [1];    //获取该图片 src
        if( !empty($first_img_src) ){    //如果日志中有图片
            $path_parts = pathinfo($first_img_src);    //获取图片 src 信息
            $first_img_name = $path_parts["basename"];    //获取图片名
			$first_img_pic = get_bloginfo('wpurl'). '/cache/'.$first_img_name;    //文件所在地址
            $first_img_file = ABSPATH. 'cache/'.$first_img_name;    //保存地址
            $expired = 604800;    //过期时间
            if ( !is_file($first_img_file) || (time() - filemtime($first_img_file)) > $expired ){
                copy($first_img_src, $first_img_file);    //远程获取图片保存于本地
                $post_timthumb = '<img src="'.$first_img_src.'" alt="'.$post->post_title.'" class="thumb" />';    //保存时用原图显示
            }
            $post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$first_img_pic.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" class="thumb" />';
        } else {    //如果日志中没有图片，则显示默认
		    $rand = rand(1,2);
            $post_timthumb = '<img src="'.get_bloginfo("template_url").'/pic/randpic/default'.$rand.'.jpg" alt="'.$post->post_title.'" class="thumb" />';
        }
        echo $post_timthumb;
    }
} 
//文章格式开启
add_theme_support( 'post-formats', array( 'status','image','video' ) );
//后台选项
require_once(TEMPLATEPATH . '/control.php');
//首页分页 
function get_page_link_one_side($pageNum, $type, $otherSidePagedNum)
{
 $linkUrl = add_query_arg("pagedType", $type, get_pagenum_link($pageNum));
 $linkUrl = add_query_arg("otherSidePagedNum", $otherSidePagedNum, $linkUrl);
 return esc_url($linkUrl);
}
function pagenavi2($type = 'male', $pagedNum = 1, $otherSidePagedNum = 1) {
    global $wpdb, $wp_query;
    if (!is_single()) {
        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        $paged = $pagedNum;
        $pages_to_show = intval($pagenavi_options['num_pages']);
        $pages_to_show = intval(3);
        $pages_to_show_minus_1 = $pages_to_show-1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
        if($start_page <= 0) {
            $start_page = 1;
        }
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), "页面 %CURRENT_PAGE% / %TOTAL_PAGES%");
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";
            if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }                   
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), "&laquo; 首页");
                echo '<a href="'.get_page_link_one_side(1, $type, $otherSidePagedNum).'" title="'.$first_page_text.'">'.$first_page_text.'</a>';
                echo '<span class="extend">...</span>';
            }
            if($paged > 1)
{
  $previous_page_text = "&laquo;";
  echo '<a href="'.get_page_link_one_side($paged - 1, $type, $otherSidePagedNum).'"title="上一页">'.$previous_page_text.'</a>';
}
            for($i = $start_page; $i  <= $end_page; $i++) {                       
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), "%PAGE_NUMBER%");
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), "%PAGE_NUMBER%");
		$linkUrl = add_query_arg("pagedType", $pagedType, get_pagenum_link($i));
		$linkUrl = add_query_arg("otherSidePagedNum", $otherSidePagedNum, linkUrl);
                    echo '<a href="'.get_page_link_one_side($i, $type, $otherSidePagedNum).'" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
             if($paged < $max_page)
{
  $next_page_text = "&raquo;";
  echo '<a href="'.get_page_link_one_side($paged + 1, $type, $otherSidePagedNum).'"title="下一页">'.$next_page_text.'</a>';
}
            if ($end_page < $max_page) {
                echo '<span class="extend">'."...".'</span>';
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), "末页 &raquo;");
                echo '<a href="'.get_page_link_one_side($max_page, $type, $otherSidePagedNum).'" title="'.$last_page_text.'">'.$last_page_text.'</a>';
            }
            echo '</div>'.$after."\n";
        }
    }
}//以上 by 熊猫之家 感谢提供分页函数

function pagenavi($before = '', $after = '') {
    global $wpdb, $wp_query;
    if (!is_single()) {
        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        if(empty($paged) || $paged == 0){
            $paged = 1;
        }
        $pages_to_show = intval($pagenavi_options['num_pages']);
        $pages_to_show = intval(3);
        $pages_to_show_minus_1 = $pages_to_show-1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
        if($start_page <= 0) {
            $start_page = 1;
        }
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), "页面 %CURRENT_PAGE% / %TOTAL_PAGES%");
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";
            if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }                   
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), "&laquo; 第一页");
                echo '<a href="'.clean_url(get_pagenum_link()).'" title="'.$first_page_text.'">'.$first_page_text.'</a>';
                echo '<span class="extend">...</span>';
            }
            previous_posts_link("&laquo;");
            for($i = $start_page; $i  <= $end_page; $i++) {                       
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), "%PAGE_NUMBER%");
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), "%PAGE_NUMBER%");
                    echo '<a href="'.clean_url(get_pagenum_link($i)).'" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            next_posts_link("&raquo;", $max_page);
            if ($end_page < $max_page) {
                echo '<span class="extend">'."...".'</span>';
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), "最后一页 &raquo;");
                echo '<a href="'.clean_url(get_pagenum_link($max_page)).'" title="'.$last_page_text.'">最后一页 &raquo;</a>';
            }
            echo '</div>'.$after."\n";
        }
    }
}

//end

//相关日志
function relatedpost() {
	global  $my_query,$post,$individual_tag;
	$tags = wp_get_post_tags($post->ID);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

$args=array(
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'showposts'=>8,
'caller_get_posts'=>1
);
$my_query = new wp_query($args);
if( $my_query->have_posts() ) {
echo '
<h3>相关日志</h3>
<ul>';
while ($my_query->have_posts()) {
$my_query->the_post();
?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php wp_reset_query();  
}
echo '</ul>
';
}
}}
/* comment_mail_notify v1.0 by willin kan. (所有回覆都發郵件) */
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 發出點, no-reply 可改為可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的情侣小窝有了回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 给你的回复:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id, array('type' => 'comment'))) . '">查看完整的回复内容</a></p>
      <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发出,请勿回复)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');
 
// -- END ----------------------------------------
//自定义评论样式开始
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
  <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
  </div>
  <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-author vcard"> <?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?></div>
    <div class="comment-meta commentmetadata"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></div>
    <p>
      <?php comment_text() ?>
    </p>
  </div>
  <?php
        }//结束
 
 //mp3

function mp3player($atts, $content=null){

extract(shortcode_atts(array("auto"=>'0'),$atts));

return '<embed src="'.get_bloginfo("template_url").'/mp3player.swf?url='.$content.'&amp;autoplay='.$auto.'" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="400" height="30">';

}

add_shortcode('mp3','mp3player');  //end
 


if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<div class="widget">', // widget 的开始标签
		'after_widget' => '</div>', // widget 的结束标签
		'before_title' => '<h3>', // 标题的开始标签
		'after_title' => '</h3>' // 标题的结束标签
	));
}

//Wordpress免插件实现代码高亮
//Prism.js开始
function add_prism() {
    wp_register_style(
        'prismCSS',
        get_stylesheet_directory_uri() . '/prism/prism.css' //自定义路径
     );
      wp_register_script(
        'prismJS',
        get_stylesheet_directory_uri() . '/prism/prism.js' //自定义路径
     );
    wp_enqueue_style('prismCSS');
    wp_enqueue_script('prismJS');
}
add_action('wp_enqueue_scripts', 'add_prism');
//Prism.js结束
//编辑器添加快捷键
function appthemes_add_quicktags() {
?>
<script type="text/javascript">
QTags.addButton( 'codeHighlight', '代码高亮', '<pre class="line-numbers"><code class="language-markup">HTML代码</code></pre>' );
QTags.addButton( 'php', 'php', '<pre class="line-numbers"><code class="language-php">PHP代码</code></pre>' );
QTags.addButton( 'python', 'Python', '<pre class="line-numbers"><code class="language-python"> Python代码</code></pre>' );
</script>
<?php
}
add_action('admin_print_footer_scripts', 'appthemes_add_quicktags' );
//添加快捷键结束
//Pre标签内的HTML不转义
add_filter( 'the_content', 'pre_content_filter', 0 );
function pre_content_filter( $content ) {
return preg_replace_callback( '|<pre.*><code.*>(.*)</code></pre>|isU' , 'convert_pre_entities', $content );
}//修改此段【】为<>
function convert_pre_entities( $matches ) {
return str_replace( $matches[1], htmlentities( $matches[1] ), $matches[0] );
}

?>
