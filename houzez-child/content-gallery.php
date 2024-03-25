<?php
/**
 * Used for both single and index/archive/search.
 *
 */
global $houzez_local;
$blog_date = houzez_option('blog_date');
$blog_author = houzez_option('blog_author'); ?>

	<div class="slider-attach">
		<?php 
			$gallleryIDS = '';
			$_avis_postType_gallery		  = get_post_meta($post->ID, "fave_gallery_posts", false);
			//var_dump(get_post_meta($post->ID));
			//var_dump($_avis_postType_gallery);
			// $_avis_postType_slider_delay	 = get_post_meta($post->ID, "_avis_postType_slider_delay", true);
			// $_avis_postType_slider_speed	 = get_post_meta($post->ID, "_avis_postType_slider_speed", true);
			// $_avis_postType_slider_autoplay  = get_post_meta($post->ID, "_avis_postType_slider_autoplay", true);
			// $_avis_postType_slider_pause	 = get_post_meta($post->ID, "_avis_postType_slider_pause", true);
			
			// Check and validate gallery parameters
			$_avis_postType_slider_delay	 = ($_avis_postType_slider_delay) ? $_avis_postType_slider_delay : "5000";
			$_avis_postType_slider_speed	 = ($_avis_postType_slider_speed) ? $_avis_postType_slider_speed : "600";	
			$_avis_postType_slider_autoplay  = ($_avis_postType_slider_autoplay === "on") ? "true" : "false";
			$_avis_postType_slider_pause	 = ($_avis_postType_slider_pause === "on") ? "true" : "false";
		?>

		<div class="image-gallery-slider post-slider-<?php the_ID();?>" id="post-slider-<?php the_ID(); ?>">
			<ul class="gallery-box slides avis-post-slider-<?php the_ID(); ?>">
				<?php 
				//$gallleryIDS = explode(',', $_avis_postType_gallery);
				$gallleryIDS = $_avis_postType_gallery; ?>
				<?php //var_dump($gallleryIDS); ?>
				<?php foreach( $_avis_postType_gallery as $attachmentID ): ?>
					<li> 
						<?php
							$attachment_size = 'avis_standard_img';
							$attachment_img = wp_get_attachment_image_src( $attachmentID, $attachment_size, false );
						?>
						<img src="<?php echo $attachment_img[0]; ?>" alt="<?php echo get_the_ID(); ?>" width="<?php echo $attachment_img[1]; ?>" height="<?php echo $attachment_img[2]; ?>" />
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="gallery-thumbnail-slider gallery-carousel-<?php the_ID();?>" id="gallery-carousel-<?php the_ID(); ?>">
			<ul class="gallery-thumbnail-box slides avis-post-slider-<?php the_ID(); ?>">
				<?php //$gallleryIDS = explode(',', $_avis_postType_gallery);
				$gallleryIDS = $_avis_postType_gallery; ?>
				<?php foreach( $gallleryIDS as $attachmentID ): ?>
					<li> 
						<?php
							$attachment_size = 'avis_gallery_thumbnail_img';
							$attachment_img = wp_get_attachment_image_src( $attachmentID, $attachment_size, false );
						?>
						<img src="<?php echo $attachment_img[0]; ?>" alt="<?php echo get_the_ID(); ?>" width="<?php echo $attachment_img[1]; ?>" height="<?php echo $attachment_img[2]; ?>" />
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		
		<script type="text/javascript">
			jQuery(window).load(function(){
				jQuery('#gallery-carousel-<?php the_ID(); ?>').flexslider({
					animation: "slide",
					controlNav: false,
					directionNav: false,
					animationLoop: true,
					slideshow: true,	
					itemWidth: 275,
					itemMargin: 5,
					asNavFor: '#post-slider-<?php the_ID(); ?>'
				 });

				jQuery('.post-slider-<?php the_ID(); ?>').flexslider({
					animation: "fade",
					namespace: "postformat-gallery",	
					easing: "swing",				
					direction: "horizontal",
					slideshow: <?php echo $_avis_postType_slider_autoplay; ?>,
					slideshowSpeed:<?php echo $_avis_postType_slider_delay; ?>,		
					animationSpeed:<?php echo $_avis_postType_slider_speed; ?>,		 
					controlsContainer: "",
					controlNav: false,
					animationLoop: true,
					pauseOnHover: <?php echo $_avis_postType_slider_pause; ?>,
					prevText: "",
					nextText: "",
					sync: "#gallery-carousel-<?php the_ID(); ?>"
				});
			});
		</script>  
	</div><!-- slider-attach -->

<?php if(!is_single()): ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>
		<?php houzez_post_thumbnail(); ?>

		<div class="article-detail">
			<?php the_title( '<h1 class="article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

			<?php the_excerpt(); ?>

		</div>
		<div class="article-footer">

			<ul class="author-meta">
				<?php if( $blog_author != 0 ) { ?>
				<li>
					<?php if( get_the_author_meta( 'fave_author_custom_picture' ) != '' ) { ?>
						<img src="<?php echo esc_url( get_the_author_meta( 'fave_author_custom_picture' ) );?>" alt="Auther Image" width="40" height="40" class="meta-image img-circle">
					<?php } ?>
					<?php echo $houzez_local['by_text']; ?> <?php echo esc_attr( get_the_author() ); ?>
				</li>
				<?php } ?>
				<?php if( $blog_date != 0 ) { ?>
					<li><i class="fa fa-calendar"></i> <?php echo esc_attr( get_the_date() ); ?> </li>
				<?php } ?>

				<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && houzez_categorized_blog() ) : ?>
					<li><i class="fa fa-bookmark-o"></i> <?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'houzez' ) ); ?></li>

				<?php endif; ?>
			</ul>

			<div class="article-footer-right">
				<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo $houzez_local['read_more'];?></a>
			</div>
		</div>
	</article>
<?php endif; ?>
