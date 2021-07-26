<?php
$options = get_option('stm_theme_options');
$ga = !empty($options['ga']) ? $options['ga'] : false;
?>
<?php if (!empty($ga)): ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga; ?>"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', '<?php echo $ga; ?>');
	</script>
<?php endif; ?>