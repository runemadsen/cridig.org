<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	// register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	function register_menus() {
	  register_nav_menu('main-menu',__( 'Main Menu' ));
	  register_nav_menu('sub-menu',__( 'Sub Menu' ));
	}
	add_action( 'init', 'register_menus' );

	class Selective_Walker extends Walker_Nav_Menu
{
    function walk( $elements, $max_depth) {

        $args = array_slice(func_get_args(), 2);
        $output = '';

        if ($max_depth < -1) //invalid parameter
            return $output;

        if (empty($elements)) //nothing to walk
            return $output;

        $id_field = $this->db_fields['id'];
        $parent_field = $this->db_fields['parent'];

        // flat display
        if ( -1 == $max_depth ) {
            $empty_array = array();
            foreach ( $elements as $e )
                $this->display_element( $e, $empty_array, 1, 0, $args, $output );
            return $output;
        }

        /*
         * need to display in hierarchical order
         * separate elements into two buckets: top level and children elements
         * children_elements is two dimensional array, eg.
         * children_elements[10][] contains all sub-elements whose parent is 10.
         */
        $top_level_elements = array();
        $children_elements  = array();
        foreach ( $elements as $e) {
            if ( 0 == $e->$parent_field )
                $top_level_elements[] = $e;
            else
                $children_elements[ $e->$parent_field ][] = $e;
        }

        /*
         * when none of the elements is top level
         * assume the first one must be root of the sub elements
         */
        if ( empty($top_level_elements) ) {

            $first = array_slice( $elements, 0, 1 );
            $root = $first[0];

            $top_level_elements = array();
            $children_elements  = array();
            foreach ( $elements as $e) {
                if ( $root->$parent_field == $e->$parent_field )
                    $top_level_elements[] = $e;
                else
                    $children_elements[ $e->$parent_field ][] = $e;
            }
        }

        $current_element_markers = array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' );  //added by continent7
        foreach ( $top_level_elements as $e ){  //changed by continent7
            // descend only on current tree
            $descend_test = array_intersect( $current_element_markers, $e->classes );
            if ( !empty( $descend_test ) ) 
                $this->display_element( $e, $children_elements, 2, 0, $args, $output );
        }

        return $output;
    }
}

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */



	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}