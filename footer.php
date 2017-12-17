<nav class="main-nav">
	<!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="toggle-nav">
        <!-- Hamburger icon -->
        <span class="icon-menu"></span>
    </a>
    <?php wp_nav_menu( array(
    	'theme_location' => 'main-menu',
    	'menu_class' => 'pure-menu-list',
    	'container_id' => 'menu',
    	'depth' => 1
    	) ); ?>
</nav>
<?php if(is_active_sidebar( 'footer' )): ?>
<footer>
    <div class="container">
        <div class="row"><?php dynamic_sidebar( 'footer' ); ?></div>
    </div>
</footer>
<?php endif; ?>
    
<?php wp_footer(); ?>
</body>
</html>