<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package specia
 */

?>
<?php
	$hide_show_blog_meta = get_theme_mod('hide_show_blog_meta','on'); 
	$post_id = get_the_ID();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
	<div class="post_date">
		<span class="date"><?php echo get_the_date('j'); ?></span>
		<h6><?php echo get_the_date('M'); ?>, <?php echo get_the_date('Y'); ?></h6>
	</div>
	<?php } ?>
    <a  href="<?php the_permalink(); ?>" class="post-thumbnail" ><?php the_post_thumbnail(); ?></a>
	
	<?php if( $hide_show_blog_meta == 'on' ): ?>
    <footer class="entry-footer">
        <span class="byline">
            <span class="author vcard">
				<?php if(get_post_meta($post_id, 'price_field', true)):?>
					<a class="price" href="<?php the_permalink(); ?>">Price: <?php echo get_post_meta($post_id, 'price_field', true); ?>$</a>
				<?php endif; ?>
            </span>
        </span>

        <?php   $cat_list = get_the_category_list();
            if(!empty($cat_list)) { ?>
        <span class="cat-links">
            <a href="<?php the_permalink(); ?>"><i class="fa fa-folder-open"></i><?php the_category(','); ?></a>
        </span>
        <?php } ?>

        <?php 
		if( get_the_tags() ) { ?>
        <span class="tags-links">
            <a href="<?php the_permalink(); ?>"><i class="fa fa-tags"></i> <?php the_tags('', ', ', ''); ?></a>
        </span>
        <?php } ?>

    </footer><!-- .entry-footer -->
	<?php endif; ?>

    <header class="entry-header">
        <?php     
            if ( is_single() ) :
            
            the_title('<h2 class="entry-title">', '</h2>' );
            
            else:
            
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            
            endif; 
        ?> 
    </header><!-- .entry-header -->

    <div class="entry-content">
	
       <?php 
			the_content( 
				sprintf( 
					__( 'Read More', 'specia' ), 
					'<span class="screen-reader-text">  '.get_the_title().'</span>' 
				) 
			);
			
		
		?>
		<?php if(get_post_meta($post_id, 'price_field', true)):?>
			<p><a href="#" class="add-to-cart">Add to Cart</a></p>
		<?php endif; ?>
    </div><!-- .entry-content -->

</article>
