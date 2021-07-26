<!--Site global modals-->
<?php
$modals = array(
	'search',
	'album'
);

foreach ($modals as $modal) {
	get_template_part('partials/modals/' . $modal);
}