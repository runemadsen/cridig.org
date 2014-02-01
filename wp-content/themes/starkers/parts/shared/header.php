<div class="row" id="header">
  <div class="col-sm-12">
    <?php wp_nav_menu( array(
      'theme_location' => 'main-menu',
      'depth' => 1
    )); ?>
  </div>
</div>
<div class="row" id="sub-header">
  <div class="col-sm-12">
  <?php wp_nav_menu( array(
      'theme_location' => 'sub-menu',
      'depth' => 2,
      'walker'=> new Selective_Walker() 
    )); ?>
  </div>
</div>