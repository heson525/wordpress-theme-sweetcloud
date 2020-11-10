<div id="footer"  class="footer">

  <p align="center"><strong>COPY RIHGT&copy; 2009-<?php echo date('Y'); ?></strong> | Themes:<strong style="color:#94A4FF">Sweet</strong>-<strong style="color:#FFB296">Clouds</strong> By <a href="https://www.heson10.com" target="_blank" ><strong>Heson</strong></a></p>

  <p align="center"> <a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo('name'); ?>">

    <strong><?php bloginfo('name'); ?></strong>

    </a> Proudly By <a href="http://wordpress.org" target="_blank" >wordpress</a>. <a href="<?php bloginfo( 'url' ); ?>/wp-admin/" target="_blank"> 管理</a> | <span id="gotop"><strong style="color:#555">TOP↑</strong> </span></p>  

  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/jquery.js"></script> 

  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/all.js"></script>

  <?php if ( is_singular() ){ ?>

  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>

  <?php } ?>

</div>