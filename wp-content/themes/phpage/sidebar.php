<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
  <div class="sidebar-module sidebar-module-inset">
    <h4>About</h4>
    <p><?php
      $post = get_post(2);
      setup_postdata($post);
      the_content();
      ?></p>
  </div>
  <div class="sidebar-module">
    <h4>Archives</h4>
    <ol class="list-unstyled">    
      <?php
      wp_get_archives(array('format' => 'custom'));
      ?>
    </ol>
  </div>

  <div class="sidebar-module">
    <h4>Categories</h4>
    <ol class="list-unstyled">    
      <?php
      wp_list_categories(array('style' => 'list', 'title_li' => '', 'show_count' => true));
      ?>
    </ol>
  </div>



  <div class="sidebar-module">
    <h4>Elsewhere</h4>
    <ol class="list-unstyled">
      <li><a href="http://www.github.com/joao-gabriel/" target="_blank">GitHub</a></li>
      <li><a href="http://www.facebook.com.br/" target="_blank">Facebook</a></li>
    </ol>
  </div>
</div><!-- /.blog-sidebar -->