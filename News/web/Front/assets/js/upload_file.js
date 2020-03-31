


$('#file_btn').mouseleave(function () {



    var file = $('#file_btn').val();




  var mo =  file.split('\\')[2];


   $(':input[name=image]').val(mo);







});
