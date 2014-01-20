<div class="row" id="header">
  <div class="col-md-3"><a id="logo" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></div>
  <div class="col-md-9">
    <?php wp_nav_menu( array(
      'theme_location' => 'main-menu',
      'depth' => 1
    )); ?>
  </div>
</div>