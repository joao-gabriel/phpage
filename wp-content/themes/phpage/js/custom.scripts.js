jQuery(document).ready(function($) {

  // Contact form "bootstraping"
  $('.wpcf7 p').addClass('form-group');
  $('.wpcf7 input, .wpcf7 textarea').addClass('form-control');
  if ($('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').html() !== '') {
    $('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').addClass('alert alert-info');
  }
  $('.wpcf7 input[type=submit]').removeClass('form-control').addClass('btn btn-info');



  // Language items
  $('.idiomas li a').click(function() {

    // Check what language was selected
    var langs = ['en', 'pt'];
    for (i = 0; i < langs.length; i++) {
      if ($(this).parent().hasClass(langs[i])) {
        var selectedLang = langs[i];
      }
    }

    var url = window.location.pathname.split('/');

    // If it is running locally change the starting index for building the URL:
    if (window.location.hostname === 'localhost') {
      var langIndex = 2;    
      var redirectUrl = window.location.protocol + '//' + window.location.hostname + '/' + url[0];
    } else {
      var langIndex = 1;
      var redirectUrl = window.location.protocol + '//' + window.location.hostname;
    }

    // Change the language on the URL
    url[langIndex] = selectedLang;
    
    // Build the URL for this address in the selected language
    for (i = langIndex-1; i < url.length; i++) {
      redirectUrl += '/' + url[i];
    }
    
    window.location.href = redirectUrl;
    return false;

  });


  // Bootstrap comment submit button
  $('#submit').addClass('btn btn-info');



});