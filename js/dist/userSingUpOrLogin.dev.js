"use strict";

var _window;

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var form = document.querySelector("#loginOrRegisterForm");
var loginButton = document.querySelector("#loginButton");
loginButton.addEventListener("click", function () {
  // form.addEventListener('submit', async (e) => {
  // 	e.preventDefault();
  // 	let response = await fetch(form.action, {
  // 		method: 'POST',
  // 		body: new FormData(form)
  // 	});
  // 	if (response.ok) {
  // 		// window.location.replace("../index.php");
  // 		// alert("Вы успешно авторизированы.");
  // 	}
  // 	else {
  // 		alert("Request error");
  // 	}
  // })
  var singInInput = document.querySelector("#SingIn");
  singInInput.click();
});
var loginVKButton = document.querySelector("#loginVKButton");
loginVKButton.addEventListener("click", function () {
  form.action = "https://www.google.com/";
  var singInVKInput = document.querySelector("#SingInVK");
  singInVKInput.click();
});
var registerButton = document.querySelector("#registerButton");
registerButton.addEventListener("click", function () {
  form.action = "/newRegistration.php";
  var registerInput = document.querySelector("#SingUp");
  registerInput.click();
});

function toggleValidationError(errorMessage) {
  var validationError = document.querySelector(".validationError");

  if (validationError != null) {
    validationError.remove();
  }

  var validationErrorNode = document.createElement("p");
  validationErrorNode.innerText = errorMessage;
  validationErrorNode.classList.add('validationError');
  var lastDiv = document.querySelector(".wrapper-buttons");
  lastDiv.appendChild(validationErrorNode);
}

var cords = ['scrollX', 'scrollY']; // Перед закрытием записываем в локалсторадж window.scrollX и window.scrollY как scrollX и scrollY

window.addEventListener('unload', function (e) {
  return cords.forEach(function (cord) {
    return localStorage[cord] = window[cord];
  });
}); // Прокручиваем страницу к scrollX и scrollY из localStorage (либо 0,0 если там еще ничего нет)

(_window = window).scroll.apply(_window, _toConsumableArray(cords.map(function (cord) {
  return localStorage[cord];
})));