"use strict";

var tablinks = document.getElementsByClassName("tab-links");

var _loop = function _loop(i) {
  tablinks[i].addEventListener("click", function () {
    openTab(event, tablinks[i].outerText);
  });
};

for (var i = 0; i < tablinks.length; i++) {
  _loop(i);
}

var tabcontent = document.getElementsByClassName("tab-content");
var taboutput = document.getElementsByClassName("tab-output");
var outputH2 = document.querySelector("h2.OutputH2");

function openTab(event, tabName) {
  for (var _i = 0; _i < tabcontent.length; _i++) {
    if (tabcontent[_i].id != tabName) {
      tabcontent[_i].style.display = "none";
    }
  }

  outputH2.style.display = "none";

  for (var _i2 = 0; _i2 < taboutput.length; _i2++) {
    if (taboutput[_i2].id != tabName) {
      taboutput[_i2].style.display = "none";
    } else {
      taboutput[_i2].style.display = "block";
      outputH2.style.display = "block";
    }
  } // Get all elements with class="tablinks" and remove the class "active"


  for (var _i3 = 0; _i3 < tablinks.length; _i3++) {
    tablinks[_i3].className = tablinks[_i3].className.replace("active", "");
  } // Show the current tab, and add an "active" class to the button that opened the tab


  document.getElementById(tabName).style.display = "block";
  event.currentTarget.className += " active";
}