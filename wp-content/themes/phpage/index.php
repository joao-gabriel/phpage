<?php get_header() ?>
<div class="row">
  <div class="col-sm-8 blog-main">
    <?php
    if (have_posts()) {
      while (have_posts()) {
        the_post();
        ?>
        <div class="blog-post">
          <h2 class="blog-post-title"><?php the_title(); ?></h2>
          <p class="blog-post-meta">
            <?php echo get_the_time('F d, Y'); ?> by <?php the_author_link(); ?><br />
            <?php echo get_the_category_list(', '); ?>
          </p>

          <?php the_content(); ?>
          <p>
            <?php the_tags(); ?>
          </p>
          <?php
          if (!post_password_required() && ( comments_open() || get_comments_number() )) :
            ?>
            <span class="comments-link pull-right"><?php comments_popup_link(__('Leave a comment'), __('1 Comment'), __('% Comments')); ?></span>
            <?php
          endif;
          ?>
          <div class="clearfix"></div>
        </div><!-- /.blog-post -->  
        <?php
      }
    }
    ?>
    <nav>
      <ul class="pager">
        <li>
          <?php posts_nav_link(' ', __('Previous'), __('Next')); ?>        
        </li>
      </ul>
    </nav>
  </div><!-- /.blog-main -->
  <?php get_sidebar(); ?>
</div><!-- /.row -->
<?php get_footer(); ?>
