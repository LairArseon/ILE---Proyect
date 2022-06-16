
$( document ).ready(function() {
    // console.log( "ready!" );
});

$(function() {
    // Sidebar toggle behavior
    $('#sidebar, #content').toggleClass('active');

    $('#sidebarCollapse').on('click', function() {
      $('#sidebar, #content').toggleClass('active');
    });

    $('#delete').click(function(event) {
      event.preventDefault();
      dir = event.currentTarget.href;
      if (confirm("¿Está seguro de que desea eliminar el registro?"))
        window.location.assign(dir);
    })
    
  });