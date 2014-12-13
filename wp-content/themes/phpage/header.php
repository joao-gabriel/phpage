<?php
if (!is_user_logged_in()) {

//  require_once ('embreve.php');
}
global $locale;
?>
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <META http-equiv="Content-Language" content="<?php echo str_replace('_', '-', $locale); ?>">
    <base href="<?php echo get_stylesheet_directory_uri(); ?>/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>PHPage</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">

    <!-- Custom styles for this theme -->
    <link href="style.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>

  </head>

  <body <?php body_class() ?>>

    <div class="blog-masthead">
      <div class="container">
        <?php
        $args = array(
            'menu' => 'principal',
            'container' => 'nav',
            'container_class' => 'blog-nav pull-left',
            'items_wrap' => '%3$s'
        );
        wp_nav_menu($args);
        ?>
        <?php
        $args = array(
            'menu' => 10,
            'container' => 'nav',
            'container_class' => 'blog-nav pull-right idiomas',
            'items_wrap' => '%3$s'
        );
        wp_nav_menu($args);
        ?>
      </div>
    </div>
    <div class="container top40">
      <div class="blog-header">
        <div class="row">
          <div class="col-md-3 col-xs-12 top20 pull-right bottom20">
            <div class="form-group">
              <form action="<?php echo home_url(); ?>/" method="get">
                <input type="text" class="form-control campo-busca" placeholder="Search" name="s">
                <button type="submit" class="btn btn-info btn-busca">
                  <span class="glyphicon-search glyphicon"></span>
                </button>
              </form>
            </div>
          </div><div class="col-md-9 col-xs-12 pull-left">
            <h1 class="blog-title">PHPage</h1>
          </div>
        </div>
        <div class="row">  
          <div class="col-md-12">
            <p class="lead blog-description">PHP + MySQL + Wordpress + CakePHP + HTML5 + jQuery + CSS + Arduino + Whatever fits :P</p></div>
        </div>
      </div>
