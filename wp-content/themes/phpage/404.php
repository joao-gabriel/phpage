<?php get_header() ?>
<div class="row">
  <div class="col-sm-8 blog-main">
    <h1 class="bottom20"><?php _e('How did you get here?! This doesn\'t even exist!', 'phpage'); ?></h1>
    <?php
    $post = get_post(68);
    setup_postdata($post);
    ?>
    <div class="blog-post">
      <h2 class="blog-post-title"><?php the_title() ?></h2>
      <p>
        <?php the_content(); ?>
      </p>
      <div class="clearfix"></div>
    </div><!-- /.blog-post -->  
  </div><!-- /.blog-main -->
  <?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
