<?php
//psycho
$path = 'partials/content/post/single/';
$parts = 'partials/content/post/parts/';
?>

<?php if (pearl_check_string(pearl_get_option('post_image')) and has_post_thumbnail()): ?>
	<?php $img = pearl_get_VC_post_img_safe(get_the_ID(), 'full', 'full', true); ?>
	<div class="vc_container-fluid-force" data-margin="0">
		<div class="stm_post_bg" style="background-image:url('<?php echo esc_url($img); ?>');">
			<div class="container">

				<?php if (pearl_check_string(pearl_get_option('post_title'))): ?>
					<h1 class="h2"><?php the_title(); ?></h1>
				<?php endif; ?>

				<div class="stm_post_info">
				<?php 
				if (pearl_check_string(pearl_get_option('post_author'))) {
					get_template_part("{$path}/author");
				}

				if (pearl_check_string(pearl_get_option('post_info'))) {
					get_template_part($parts . 'postinfo', 12);
				}
				?>
				</div>

			</div>
		</div>
	</div>
<?php endif; ?>

<div class="container">
	<div class="vc_row">
		<div class="vc_col-2"></div>
		<div class="vc_col-8">

			<div class="stm_single_post__content">
				<?php the_content(); ?>
			</div>
			
			<?php
			get_template_part("{$path}/actions");
			get_template_part("{$parts}/related_posts");
			?>
			
		</div>
		<div class="vc_col-2"></div>
	</div>
</div>

