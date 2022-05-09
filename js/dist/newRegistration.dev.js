"use strict";

var form = document.querySelector('#registrationForm');
form.addEventListener('submit', function _callee(e) {
  var response;
  return regeneratorRuntime.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          e.preventDefault();
          _context.next = 3;
          return regeneratorRuntime.awrap(fetch('registration_script.php', {
            method: 'POST',
            body: new FormData(form)
          }));

        case 3:
          response = _context.sent;

          if (response.ok) {
            window.location.replace("../index.php");
            alert("Учётная запись успешно создана");
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
var allInputs = document.querySelectorAll("input[type=text]");
var registerButton = document.querySelector("#registerButton");
var inputsAreNotEmpty = true;
var fioValidationIsGood = true;
var loginPasswordValidationIsGood = true;
var emailValidationIsGood = true;
registerButton.addEventListener("click", function () {
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = allInputs[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var _input = _step.value;

      if (_input.value == "") {
        inputsAreNotEmpty = false;
      }
    }
  } catch (err) {
    _didIteratorError = true;
    _iteratorError = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion && _iterator["return"] != null) {
        _iterator["return"]();
      }
    } finally {
      if (_didIteratorError) {
        throw _iteratorError;
      }
    }
  }

  if (inputsAreNotEmpty == false) {
    toggleValidationError("Все поля обязательны к заполнению.");
  } else {
    var _iteratorNormalCompletion2 = true;
    var _didIteratorError2 = false;
    var _iteratorError2 = undefined;

    try {
      for (var _iterator2 = allInputs[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
        var input = _step2.value;

        switch (input.id) {
          case "Email":
            var regex3 = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            emailValidationIsGood = regex3.test(input.value);

            if (emailValidationIsGood == false) {
              toggleValidationError("Неверныйформат данных при указании эл. почты.");
            }

            break;

          case "Login" || "Password":
            var regex2 = /^[a-zA-Z0-9]{4,250}$/;
            loginPasswordValidationIsGood = regex2.test(input.value);

            if (loginPasswordValidationIsGood == false) {
              toggleValidationError("Неверныйформат данных при указании логина или пароля.");
            }

            break;

          case "Name" || "Surname" || "Patronymic":
            var regex1 = /^[a-zA-Zа-яА-ЯёЁ']{2,250}$/;
            fioValidationIsGood = regex1.test(input.value);

            if (fioValidationIsGood == false) {
              toggleValidationError("Неверныйформат данных при указании ФИО.");
            }

            break;
        }
      }
    } catch (err) {
      _didIteratorError2 = true;
      _iteratorError2 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion2 && _iterator2["return"] != null) {
          _iterator2["return"]();
        }
      } finally {
        if (_didIteratorError2) {
          throw _iteratorError2;
        }
      }
    }
  }

  if (inputsAreNotEmpty == true && fioValidationIsGood == true && loginPasswordValidationIsGood == true && emailValidationIsGood == true) {
    var registerInput = document.querySelector("#SingUp");
    registerInput.click();
  }
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