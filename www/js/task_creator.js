$( document ).ready(function() {
    // alert( "ready!" );
    n = 0;
    $('.add').click(function() {
        $('.questions').append('<input type="text" name="question'+ n +'" class="form-control" /><br>');
        n++;
      });
});
