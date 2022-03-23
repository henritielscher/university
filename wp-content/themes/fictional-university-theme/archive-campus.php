<!-- Ist die Blog-Seite von WP -->

<?php

get_header(); 
pageBanner([
  "title" => "Our Campuses",
  "subtitle" => "We have several conveniently located campuses."
])
?>

  <div class="container container--narrow page-section">
    <div class="acf-map">
        <?php echo do_shortcode('[ultimate_maps id="1"]')?>
    </div>
    <?php
  echo "<ul class='min-list link-list'>";
  while(have_posts()){
      the_post(); ?>
    <li><a href="<?= the_permalink(); ?>"><?= the_title();?></a></li>

  <?php } 
  echo "</ul>";
  ?>
  </div>
<?php get_footer(); ?>