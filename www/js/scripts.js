
console.log('presente');

$( document ).ready(function() {
    console.log( "ready!" );
});

$(function() {
    // Sidebar toggle behavior
    $('#sidebarCollapse').on('click', function() {
      $('#sidebar, #content').toggleClass('active');
    });
  });