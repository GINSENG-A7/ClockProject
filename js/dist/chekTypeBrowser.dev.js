"use strict";

var isModile = {
  Android: function Android() {
    return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function BlackBerry() {
    return navigator.userAgent.match(/BlackBerry/i);
  },
  IOS: function IOS() {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function Opera() {
    return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function Windows() {
    return navigator.userAgent.match(/IEMobile/i);
  },
  any: function any() {
    return isModile.Android() || isModile.BlackBerry() || isModile.IOS() || isModile.Opera() || isModile.Windows();
  }
};

if (isModile.any()) {
  document.body.classList.add('_touch');
  var menuArrows = document.querySelectorAll('.nav-arrow');

  if (menuArrows.length > 0) {
    var _loop = function _loop(index) {
      var menuArrow = menuArrows[index];
      menuArrow.addEventListener("click", function (e) {
        menuArrow.parentElement.classList.toggle('_activ-nav__Mobail');
      });
    };

    for (var index = 0; index < menuArrows.length; index++) {
      _loop(index);
    }
  }
} else {
  document.body.classList.add('_pc');
}

var menuIcon = document.querySelector('.header__menu-icon');
var number = document.querySelector('.number');

if (menuIcon) {
  var nemuBody = document.querySelector('.header__menu-body');
  menuIcon.addEventListener("click", function (e) {
    nemuBody.classList.toggle("menu__body-activ");
    menuIcon.classList.toggle("menu__icon-activ");
    document.body.classList.toggle('_lock');
    number.classList.toggle('number-activ');
  });
} // if(menuLinks.length > 0 ) {
//     menuLinks.forEach(menuLink => {  
//         menuLink.addEventListener("click", onMenuLinkClick );
//     });
//     function onMenuLinkClick (e) {
//         const menuLink = e.target;
//         if(iconMenu.classList.contains('menu__icon-activ')) {
//             const menuBody = document.querySelector('.header__menu-body'); 
//             document.body.classList.remove('-lock')
//             iconMenu.classList.remove('menu__icon-activ');
//             menuBody.classList.remove('menu__body-activ');
//         }
//     }
// }