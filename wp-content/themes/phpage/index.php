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
          <p class="blog-post-meta"><?php the_time('F d, Y'); ?> by <?php the_author_link(); ?></p>

          <?php
          the_content();

          if (!post_password_required() && ( comments_open() || get_comments_number() )) :
            ?>
            <span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'twentyfourteen'), __('1 Comment', 'twentyfourteen'), __('% Comments', 'twentyfourteen')); ?></span>
            <?php
          endif;
          ?>



        </div><!-- /.blog-post -->  


        <?php
      }
    }
    ?>

    <nav>
      <ul class="pager">
        <li><a href="#">Previous</a></li>
        <li><a href="#">Next</a></li>
      </ul>
    </nav>

  </div><!-- /.blog-main -->

  <?php get_sidebar(); ?>

</div><!-- /.row -->

<?php get_footer(); ?>
