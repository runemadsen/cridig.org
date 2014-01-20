<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
	  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
	  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico"/>
	  <?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="container">