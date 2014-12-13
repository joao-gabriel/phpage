<?php

add_theme_support('post-thumbnails');

function register_my_menu() {
  register_nav_menu('header-menu', __('Header Menu'));
}

add_action('init', 'register_my_menu');


// Change theme language
// Must be called before load_theme_textdomain() so it can get the right language 
// http://codex.wordpress.org/Function_Reference/load_theme_textdomain
add_filter('locale', 'my_theme_localized');

function my_theme_localized($locale) {

  // We'll store the Stella selected language in a global variable
  global $current_language;

  if (empty($current_language)) {

    // Change locale based on Stella selected language
    // This hack works only when Stella plugin is running on "Pretty Permalinks", 
    // then selected language will always be the first two characters between slashes after the site address (or at least it should be :P)
    if (is_permalinks_enabled()) {
      $url = parse_url($_SERVER['REQUEST_URI']);

      // *** WARNING *** 
      // TO MAKE IT RUN LOCALLY, CHANGE THE INDEX BELOW TO THE CORRESPONDING POSITION OF THE STELLA PARAMETER IN YOUR LOCAL ENVIRONMENT

      if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $langIndex = 2;
      } else {
        $langIndex = 1;
      }

      $urlArray = explode('/', $url['path']);
      $current_language = $urlArray[$langIndex];   // Stella language INDEX is 0 on production
    }
  }

  global $locale;

  // This is where the locale code is defined based on Stella selected language
  switch ($current_language) {

    case 'en':
      $locale = 'en_US';
      break;

    default:
      $locale = 'pt_BR';
      break;
  }

//  var_dump($locale);
//  $debug = update_option('wplang', $locale);
//  var_dump($debug);

  // Return the corresponding locale code
  return $locale;
}

// Configura o tema
function phpage_setup() {

  load_theme_textdomain('phpage', get_template_directory() . '/languages');
  global $locale;
//  var_dump($locale);
  $debug = update_option('wplang', $locale);
//  var_dump($debug);
//  echo 'load theme    ';
//  var_dump(get_option('wplang'));
}

//load_theme_textdomain('phpage', get_template_directory() . '/languages');
add_filter('after_setup_theme', 'phpage_setup');