<div class="row" id="header">
  <div class="col-md-3">
    <a id="logo" href="<?php echo home_url(); ?>">
      <img name=image src="<?php bloginfo('template_directory'); ?>/images/logo.png" />
    </a>
  </div>
  <div class="col-md-9">
    <?php wp_nav_menu( array(
      'theme_location' => 'main-menu',
      'depth' => 1
    )); ?>
  </div>
</div>
<hr id="header-line" />