
$( document ).ready(function() {
    // console.log( "ready!" );
});

$(function() {
    // Sidebar toggle behavior
    $('#sidebar, #content').toggleClass('active');

    $('#sidebarCollapse').on('click', function() {
      $('#sidebar, #content').toggleClass('active');
    });
  });