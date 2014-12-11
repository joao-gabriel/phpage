$(document).ready(function() {

  // Contact form "bootstraping"
  $('.wpcf7 p').addClass('form-group');
  $('.wpcf7 input, .wpcf7 textarea').addClass('form-control');
  if ($('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').html() !== '') {
    $('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').addClass('alert alert-info');
  }
  $('.wpcf7 input[type=submit]').removeClass('form-control').addClass('btn btn-info');
  
  // English menu "Home" link fix 
  if ($('.blog-nav li:last-child').text()==='PT'){
    $('.blog-nav li:first-child a').attr('href', 'http://www.phpage.com.br/en/');
    
     $('a[rel="author external"]').attr('href', 'http://www.phpage.com.br/en/joao/');
    
  }
  
  // Bootstrap comment submit button
  $('#submit').addClass('btn btn-info');
  
  
 
});
