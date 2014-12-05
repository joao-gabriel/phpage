/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {

  $('.wpcf7 p').addClass('form-group');
//  $('.wpcf7').text().wrap('<label></label>');
  $('.wpcf7 input, .wpcf7 textarea').addClass('form-control');
  if ($('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').html() !== '') {
    $('.wpcf7 .screen-reader-response, .wpcf7 .wpcf7-response-output').addClass('alert alert-info');
  }
  console.log();
  $('.wpcf7 input[type=submit]').removeClass('form-control').addClass('btn btn-info');
});

