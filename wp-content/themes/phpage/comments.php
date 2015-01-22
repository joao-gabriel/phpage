<div id="comments" class="comments-area">
  <?php if (have_comments()) : ?>
    <h2 class="comments-title">
      <?php
      printf(_n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number()), number_format_i18n(get_comments_number()), get_the_title());
      ?>
    </h2>
    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e('Comment navigation'); ?></h1>
        <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments')); ?></div>
        <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;')); ?></div>
      </nav><!-- #comment-nav-above -->
    <?php endif; // Check for comment navigation.  ?>
    <ol class="comment-list bottom20">
      <?php
      wp_list_comments(array(
          'style' => 'ol',
          'short_ping' => true,
          'avatar_size' => false,
      ));
      ?>
    </ol><!-- .comment-list -->
    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e('Comment navigation'); ?></h1>
        <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments')); ?></div>
        <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;')); ?></div>
      </nav><!-- #comment-nav-below -->
    <?php endif; // Check for comment navigation.  ?>

    <?php if (!comments_open()) : ?>
      <p class="no-comments"><?php _e('Comments are closed.'); ?></p>
    <?php endif; ?>

  <?php endif; // have_comments()  ?>

  <?php
  $fields = array(
      'author' =>
      '<div class="comment-form-author form-group">
      <label for="author">' . __('Name') . '</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
      '" size="30" class="form-control"/></div>',
      'email' =>
      '<div class="comment-form-email form-group"><label for="email">' . __('Email') . '</label> ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
      '" size="30" class="form-control" /></div>',
      'url' =>
      '<div class="comment-form-url form-group"><label for="url">' . __('Website') . '</label>' .
      '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
      '" size="30" class="form-control" /></div>',
  );

  $args = array(
      'comment_field' => '
        <div class="form-group">
          <label for="comment">' . _x('Comment', 'noun') . '</label>
          <textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true"></textarea>
        </div>',
      'comment_notes_after' => '',
      'fields' => apply_filters('comment_form_default_fields', $fields),
  );
  comment_form($args);
  ?>

</div><!-- #comments -->
