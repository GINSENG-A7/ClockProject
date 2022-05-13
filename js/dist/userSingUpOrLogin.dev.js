"use strict";

var form = document.querySelector("#loginOrRegisterForm");
var loginButton = document.querySelector("#loginButton");
loginButton.addEventListener("click", function () {
  form.action = "authorize_script.php";
  form.addEventListener('submit', function _callee(e) {
    var response;
    return regeneratorRuntime.async(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            e.preventDefault();
            _context.next = 3;
            return regeneratorRuntime.awrap(fetch('../authorize_script.php', {
              method: 'POST',
              body: new FormData(form)
            }));

          case 3:
            response = _context.sent;

            if (response.ok) {
              window.location.replace("../index.php");
              alert("Вы успешно авторизированы.");
            } else {
              alert("Request error");
            }

          case 5:
          case "end":
            return _context.stop();
        }
      }
    });
  });
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