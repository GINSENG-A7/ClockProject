  
"use strict"

const isModile = {

    Android : function () {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    IOS : function () {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera : function () {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows : function () {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any : function () {
        return (
            isModile.Android () ||
            isModile.BlackBerry () ||
            isModile.IOS() ||
            isModile.Opera() ||
            isModile.Windows());
    },
}

if(isModile.any()) {
    document.body.classList.add('_touch')

    let menuArrows = document.querySelectorAll('.nav-arrow');
    if(menuArrows.length > 0 ) {
        for (let index = 0;index < menuArrows.length;index++) {
           const menuArrow = menuArrows[index];

           menuArrow.addEventListener("click" , (e) => {
               menuArrow.parentElement.classList.toggle('_activ-nav__Mobail')
           })
            
        }
    }
} else {
    document.body.classList.add('_pc')
}


const menuIcon = document.querySelector('.header__menu-icon');
const number = document.querySelector('.number'); 
if(menuIcon) {
    const nemuBody = document.querySelector('.header__menu-body')
    menuIcon.addEventListener("click", function(e){
        nemuBody.classList.toggle("menu__body-activ")
        menuIcon.classList.toggle("menu__icon-activ")
        document.body.classList.toggle('_lock')
        number.classList.toggle('number-activ');
    })
}

// if(menuLinks.length > 0 ) {
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