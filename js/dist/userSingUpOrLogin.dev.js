"use strict";

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