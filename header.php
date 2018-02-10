<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php wp_title(' ',true,"right"); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php do_action("after_body_tag"); ?>