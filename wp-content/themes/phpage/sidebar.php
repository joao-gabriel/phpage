<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
  <div class="sidebar-module sidebar-module-inset">
    <h4>About</h4>
    <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
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
    <h4>Elsewhere</h4>
    <ol class="list-unstyled">
      <li><a href="http://www.github.com/joao-gabriel/" target="_blank">GitHub</a></li>
      <li><a href="http://www.facebook.com.br/" target="_blank">Facebook</a></li>
    </ol>
  </div>
</div><!-- /.blog-sidebar -->