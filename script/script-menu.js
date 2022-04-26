$("#toogle-menu").click(function(){
  var w = $('#sidebar').width();
  var pos = $('#sidebar').offset().left;

  if(pos == 0){
  $("#sidebar").animate({"left": -w}, "slow");
  }
  else
  {
  $("#sidebar").animate({"left": "0"}, "slow");
  }

});