<?php
get_header();
global $post;
echo '<figure class="highcharts-figure">';
$chart = new SHRN\Chart($post->ID);
echo $chart->prepare_chart();
echo '</figure>';
get_footer();
?>