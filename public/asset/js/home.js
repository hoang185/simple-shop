// new product
var btns = document.getElementsByClassName("btns");

for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active-toggle");
  var slide = document.getElementsByClassName("slider");
  var active = document.getElementsByClassName("active-slider");
  if (current.length > 0) { 
    current[0].className = current[0].className.replace(" active-toggle", "");
  }
  this.className += " active-toggle";
  if (btns[1].classList.contains("active-toggle")){
  active[0].className = active[0].className.replace(" active-slider", "");
  slide[0].className += " active-slider";
  }
  else {
  active[0].className = active[0].className.replace(" active-slider", "");
  slide[1].className += " active-slider";
  }
  }); 
}
