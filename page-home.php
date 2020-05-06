<?php get_header();
?>
    <div class="home-hero" style="background-image: url('<?php echo get_theme_mod('s4f-home-image'); ?>');"></div>

    <div class="home-top container">
        <div class="home-block">
            <?php the_post(); the_content() ?>
        </div>
    </div>

    <div class="home-sections">
        <?php
        $home_blocks = get_posts(array("post_type" => "home_blocks"));
        foreach ($home_blocks as $block){
            ?>
            <div class="home-section container">
                <div class="home-heading">
                    <div class="home-heading-topper"></div>
                    <h1><?php echo $block->post_title ?></h1>
                </div>
                <div class="home-block">
                    <?php echo $block->post_content ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="home-section container home-blog">
            <div class="home-heading">
                <div class="home-heading-topper"></div>
                <h1>Latest Posts</h1>
            </div>
            <div class="home-blog-posts">
                <?php
                $the_query = new WP_Query(array("posts_per_page"=>3));
                if ($the_query->have_posts()):
                    while ($the_query->have_posts()) : $the_query->the_post();
                        get_template_part("template_parts/article");
                    endwhile;
                endif;
                ?>
                <div class="home-blog-more">
                    <a href=""><div class="home-blog-button">More Posts ></div></a>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();