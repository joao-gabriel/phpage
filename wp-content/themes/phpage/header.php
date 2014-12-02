
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
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
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <?php
        $args = array(
            'container' => 'nav',
            'container_class' => 'blog-nav',
            'items_wrap' => '%3$s'
        );
        wp_nav_menu($args);
        ?>
      </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">PHPage</h1>
        <p class="lead blog-description">PHP + MySQL + Wordpress + CakePHP + HTML5 + jQuery + CSS + Arduino + Whatever fits :P</p>
      </div>