$(".img_popup").click(function(){
  $("#full-image").attr("src", $(this).data("src"));
  $('#image-viewer').show();
});

$("#image-viewer .close").click(function(){
  $('#image-viewer').hide();
});
