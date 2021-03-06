<?php 
    
    get_header();

    while(have_posts()){
        the_post(); 
        pageBanner();
        ?>

  <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?= get_post_type_archive_link("campus"); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses </a> <span class="metabox__main"><?= the_title();?> </span></p>
    </div>

        <div class="generic-content"><?= the_content() ?></div>

        <div class="acf-map">
            <?php echo do_shortcode('[ultimate_maps id="1"]')?>
        </div>

      

        <?php

              $relatedPrograms = new WP_Query([
              "posts_per_page" => -1, // -1 zeigt alle Events
              "post_type" => "program",
              "orderby" => "title", // default = "post_date"
              "order" => "ASC",
              "meta_query" => [
                [
                  "key" => "related_campus",
                  "compare" => "LIKE", // LIKE = contains
                  "value" => '"' . get_the_ID() . '"'
                ]
              ]
            ]);
            
            if($relatedPrograms->have_posts()){
              echo '<hr class="section-break">';
            echo "<h2 class='headline headline--medium'>Programs Available At This Campus</h2>";
            echo '<ul class="min-list link-list">';
            while($relatedPrograms->have_posts()){
              $relatedPrograms->the_post(); ?>
              
              <li>
                <a href="<?= the_permalink() ?>">
                  <?= the_title(); ?> 
                </a>
              </li>

           <?php }
           echo '</ul>'; 
            }

            wp_reset_postdata();
          ?>
</div>

    <?php    }

    get_footer();
?>
