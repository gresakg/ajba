<?php get_header(  ); ?>
<section class="main container">
<?php if( have_posts() ): ?>

	<?php while(have_posts()): ?>
		<?php the_post(); ?>
			<header>
				<h1><a href="<?php the_permalink(  ); ?>"><?php the_title(); ?></a></h1>
				<?php if(has_post_thumbnail()) { the_post_thumbnail( 'full',array('class' => "pure-img") ); } ?>
			</header>
			<div class="content">
				<?php if(is_archive() || is_home()) {
				the_excerpt(); 
				} else {
				the_content(); 	
					} ?>
			</div>
		</article>
	<?php endwhile; ?>
	<?php if(get_next_posts_link() || get_previous_posts_link( )):  ?>
	<div class="pagination">
		<?php
		echo paginate_links( array( 
			'prev_text' => "«",
			'next_text' => '»',
			'end_size' => 1,
			'mid_size' => 1,
			) );
		?>
	</div>
	<?php endif; ?>

<?php endif; ?>
</section>
<?php get_footer(); ?>