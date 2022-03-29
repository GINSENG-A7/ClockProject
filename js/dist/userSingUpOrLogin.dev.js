"use strict";

var loginButton = document.querySelector("#loginButton");
loginButton.addEventListener("click", function () {
  var singInInput = document.querySelector("#SingIn");
  singInInput.click();
});
var loginVKButton = document.querySelector("#loginVKButton");
loginVKButton.addEventListener("click", function () {
  var singInVKInput = document.querySelector("#SingInVK");
  singInVKInput.click();
});
var registerButton = document.querySelector("#registerButton");
registerButton.addEventListener("click", function () {
  var registerInput = document.querySelector("#SingUp");
  registerInput.click();
});