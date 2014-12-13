$(document).ready(function() {

  // Contact form "bootstraping"
  $('.wpcf7 p').addClass('form-group');
  $('.wpcf7 input, .wpcf7 textarea').addClass('form-control');
  if ($('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').html() !== '') {
    $('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').addClass('alert alert-info');
  }
  $('.wpcf7 input[type=submit]').removeClass('form-control').addClass('btn btn-info');
  
  
  if ($('.blog-nav li:last-child').text()==='PT'){
    // English menu "Home" link fix 
    $('.blog-nav li:first-child a').attr('href', 'http://www.phpage.com.br/en/');
    // English "Author" link fix 
     $('a[rel="author external"]').attr('href', 'http://www.phpage.com.br/en/joao/');
  }
  

  
  // Bootstrap comment submit button
  $('#submit').addClass('btn btn-info');
  
  
 
});