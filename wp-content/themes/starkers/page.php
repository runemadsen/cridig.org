<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class="row" id="main">
  <div class="col-md-7" id="content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </div>
  <div class="col-md-5" id="attachments">
    <?php $attachments = new Attachments( 'attachments' ); /* pass the instance name */ ?>
    <?php if( $attachments->exist() ) : ?>
        <?php while( $attachments->get() ) : ?>
          <figure class="attachment">
            <img src="<?php echo $attachments->url(); ?>" class="img-responsive" />
            <figcaption><?php echo $attachments->field( 'caption' ); ?></figcaption>
          </figure>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>