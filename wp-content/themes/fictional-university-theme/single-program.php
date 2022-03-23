<?php 
    
    get_header();

    while(have_posts()){
        the_post(); 
        pageBanner();
        ?>

  <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?= get_post_type_archive_link("program"); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs </a> <span class="metabox__main"><?= the_title();?> </span></p>
    </div>

        <div class="generic-content"><?= the_field("main_body_content") ?></div>

      

        <?php

              $relatedProfessors = new WP_Query([
              "posts_per_page" => -1, // -1 zeigt alle Events
              "post_type" => "professor",
              "orderby" => "title", // default = "post_date"
              "order" => "ASC",
              "meta_query" => [
                [
                  "key" => "related_programs",
                  "compare" => "LIKE", // LIKE = contains
                  "value" => '"' . get_the_ID() . '"'
                ]
              ]
            ]);
            
            if($relatedProfessors->have_posts()){
              echo '<hr class="section-break">';
            echo "<h2 class='headline headline--medium'>" . get_the_title() .  " Professors</h2>";
            echo '<ul class="professor-cards">';
            while($relatedProfessors->have_posts()){
              $relatedProfessors->the_post(); ?>
              
              <li class="professor-card__list-item">
                <a class="professor-card" href="<?= the_permalink() ?>">
                  <img src="<?= the_post_thumbnail_url("professorLandscape") ?>" alt="" class="professor-card__image">
                  <span class="professor-card__name"><?= the_title(); ?></span>
                </a>
              </li>

           <?php }
           echo '</ul>'; 
            }

            wp_reset_postdata();

            $today = date("Ymd");
            $homepageEvents = new WP_Query([
              "posts_per_page" => 2, // -1 zeigt alle Events
              "post_type" => "event",
              "meta_key" => "event_date",
              "orderby" => "meta_value_num", // default = "post_date"
              "order" => "ASC",
              "meta_query" => [
                [
                  "key" => "event_date",
                  "compare" => ">=",
                  "value" => $today,
                  "type" => "numeric"
                ],
                [
                  "key" => "related_programs",
                  "compare" => "LIKE", // LIKE = contains
                  "value" => '"' . get_the_ID() . '"'
                ]
              ]
            ]);
            
            if($homepageEvents->have_posts()){
              echo "<hr class='section-break'>";
            echo "<h2 class='headline headline--medium'>Upcoming " . get_the_title() .  " Events</h2>";

              while($homepageEvents->have_posts()){
                $homepageEvents->the_post();
                get_template_part("template-parts/content-event");
                
              
              } 
            }
            wp_reset_postdata();
            $relatedCampuses = get_field("related_campus");

            if($relatedCampuses){
              echo "<hr class='section-break'>";
              echo "<h2 class='headline headline--medium'>" . get_the_title() . " is Available At These Campuses</h2>";
              echo "<ul class='min-list link-list'>";
              foreach($relatedCampuses as $campus){ ?>
              <li><a href="<?php echo get_the_permalink($campus) ?>"><?php echo get_the_title($campus) ?></a></li>
              <?php }
              echo "</ul>";
            }

          ?>
</div>

    <?php    }

    get_footer();
?>
