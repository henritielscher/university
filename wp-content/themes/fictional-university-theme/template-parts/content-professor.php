
<div class="post-item">
    <li class="professor-card__list-item">
        <a class="professor-card" href="<?= the_permalink() ?>">
            <img src="<?= the_post_thumbnail_url("professorLandscape") ?>" alt="" class="professor-card__image">
            <span class="professor-card__name"><?= the_title(); ?></span>
        </a>
    </li>
</div>