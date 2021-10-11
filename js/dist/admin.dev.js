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

var tabcontent = document.getElementsByClassName("tab-content"); // for (let i = 0; i < tabcontent.length; i++) {
// 	tabcontent[i].addEventListener("click", () => {
// 		openTab(event, tabcontent[i].outerText);
// 	});
// }

function openTab(event, tabName) {
  for (var _i = 0; _i < tabcontent.length; _i++) {
    if (tabcontent[_i].id != tabName) {
      tabcontent[_i].style.display = "none";
    }
  } // Get all elements with class="tablinks" and remove the class "active"


  for (var _i2 = 0; _i2 < tablinks.length; _i2++) {
    tablinks[_i2].className = tablinks[_i2].className.replace("active", "");
  } // Show the current tab, and add an "active" class to the button that opened the tab


  document.getElementById(tabName).style.display = "block";
  event.currentTarget.className += " active";
}