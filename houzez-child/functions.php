<?php
function child_theme_setup() {
	add_theme_support( 'post-formats', array('gallery') );
	add_image_size( 'avis_gallery_thumbnail_img',275,180,true);  //gallery thumbnail size
	add_image_size( 'avis_standard_img',850,400,true);  //standard size
}
add_action( 'after_setup_theme', 'child_theme_setup', 11 ); 

add_action( 'wp_enqueue_scripts', 'inloki_scripts_method' ); 
function inloki_scripts_method() {
    wp_register_style('flexslider_css', get_stylesheet_directory_uri() .'/js/flexslider.css', array(),null, 'all');
    wp_enqueue_style('flexslider_css');

	wp_register_script('jquery_flexslider_js', get_stylesheet_directory_uri() .'/js/jquery.flexslider-min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery_flexslider_js');
} 

add_action('wp_footer', 'add_custom_css');
function add_custom_css() {
	global $current_user;
	?>
	<script>
		jQuery(document).ready(function($) {
			//console.log('load');
			var text = $('.process-inner .work-procress-content').first().html();
			$('.work-procress-wrap').html(text);

			console.log(text);
			$('.process-inner ').click(function(event) {
				var text1 = $(this).find('.work-procress-content').html();
				var num = $(this).data('tab');
				$('.process-inner ').removeClass('active');
				$(this).addClass('active');

				// mobile
				var wrapmobile = $('.work-procress-wrap.work-procress-wrap-mobile');
				wrapmobile.removeClass('active');
				wrapmobile.each(function(index, el) {
					if( $(this).data('wrap') == num ){
						$(this).addClass('active');
					}
				});

				//console.log(text1);
				$('.work-procress-wrap').html(text1);
				$('.work-procress-wrap').removeClass('tab-1');
				$('.work-procress-wrap').removeClass('tab-2');
				$('.work-procress-wrap').removeClass('tab-3');
				$('.work-procress-wrap').removeClass('tab-4');
				$('.work-procress-wrap').removeClass('tab-5');
				$('.work-procress-wrap').addClass('tab-'+num);
			});
		});
	</script>
	<style>

	</style>
	<?php
} 