"use strict";

var form = document.querySelector("#loginOrRegisterForm");
var loginButton = document.querySelector("#loginButton");
loginButton.addEventListener("click", function () {
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
  form.action = "newRegistration.php";
  var registerInput = document.querySelector("#SingUp");
  registerInput.click();
});