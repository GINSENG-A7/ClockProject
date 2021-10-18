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
var contentH2 = document.querySelectorAll("h2.ContentH2");
var outputH2 = document.querySelectorAll("h2.OutputH2");

for (var _i = 0; _i < contentH2.length; _i++) {
  outputH2[_i].style.display = "none";
  contentH2[_i].style.display = "none";
}

for (var _i2 = 0; _i2 < taboutput.length; _i2++) {
  taboutput[_i2].style.display = "none";
}

function openTab(event, tabName) {
  for (var _i3 = 0; _i3 < tabcontent.length; _i3++) {
    if (tabcontent[_i3].id != tabName) {
      tabcontent[_i3].style.display = "none";
    } else {
      tabcontent[_i3].style.display = "block";
      contentH2[_i3].style.display = "block";
    }
  }

  for (var _i4 = 0; _i4 < taboutput.length; _i4++) {
    if (taboutput[_i4].id != tabName) {
      taboutput[_i4].style.display = "none";
    } else {
      taboutput[_i4].style.display = "block";
      outputH2[_i4].style.display = "block";
    }
  } // Get all elements with class="tablinks" and remove the class "active"


  for (var _i5 = 0; _i5 < tablinks.length; _i5++) {
    tablinks[_i5].className = tablinks[_i5].className.replace("active", "");
  } // Show the current tab, and add an "active" class to the button that opened the tab
  // document.getElementById(tabName).style.display = "block";


  event.currentTarget.className += " active";
}