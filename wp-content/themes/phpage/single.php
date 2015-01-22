<?php get_header() ?>
<div class="row">
  <div class="col-sm-8 blog-main">
    <?php
    


//    var_dump(have_posts());
//
//global $wp_query;
//var_dump($wp_query->posts);

    
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        ?>
        <div class="blog-post">
          <h2 class="blog-post-title"><?php the_title(); ?></h2>
          <p class="blog-post-meta"><?php the_time('F d, Y'); ?> by <?php the_author_link(); ?></p>
          <?php the_content(); ?>
        </div><!-- /.blog-post -->  
        <?php
      }
    }else{
      echo 'no posts';
    }
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) {
      comments_template();
    }
    ?>
  </div><!-- /.blog-main -->
  <?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>