jQuery(document).ready(function($) {

  // Contact form "bootstraping"
  $('.wpcf7 p').addClass('form-group');
  $('.wpcf7 input, .wpcf7 textarea').addClass('form-control');
  if ($('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').html() !== '') {
    $('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').addClass('alert alert-info');
  }
  $('.wpcf7 input[type=submit]').removeClass('form-control').addClass('btn btn-info');

  // Bootstrap comment submit button
  $('#submit').addClass('btn btn-info');

  // Back to top button
  $('#back-to-top').click(function() {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
  });

});
