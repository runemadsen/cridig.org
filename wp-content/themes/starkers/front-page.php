<?php
/*
Template Name: Front Page
*/
?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class="row" id="main">
  <div class="col-sm-7" id="content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </div>
  <div class="col-sm-5" id="attachments">
    <?php $attachments = new Attachments( 'attachments' ); /* pass the instance name */ ?>
    <?php if( $attachments->exist() ) : ?>
        <?php while( $attachments->get() ) : ?>
          <figure class="front-attachment">
            <img src="<?php echo $attachments->url(); ?>" class="img-responsive" />
            <figcaption><?php echo $attachments->field('caption'); ?></figcaption>
          </figure>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>