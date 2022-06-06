"use strict";

var _window;

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var dataForm = document.getElementsByClassName("personal__data-form")[0];
dataForm.addEventListener('submit', function _callee(e) {
  var response;
  return regeneratorRuntime.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          e.preventDefault();
          _context.next = 3;
          return regeneratorRuntime.awrap(fetch(dataForm.action, {
            method: 'POST',
            body: new FormData(dataForm)
          }));

        case 3:
          response = _context.sent;

          if (response.ok) {
            window.location.replace("../personal.php");
            alert("Данные учётной записи успешно обновлены.");
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
var allDataInputs = dataForm.querySelectorAll("input[type=text]");
var changeDataButton = document.querySelector("#changeDataButton");
var dataInputsAreNotEmpty = true;
var fioValidationIsGood = true;
var loginValidationIsGood = true;
var emailValidationIsGood = true;
var postIndexValidationIsGood = true;
changeDataButton.addEventListener("click", function (event) {
  event.preventDefault();
  dataInputsAreNotEmpty = true;
  fioValidationIsGood = true;
  loginValidationIsGood = true;
  emailValidationIsGood = true;
  postIndexValidationIsGood = true;
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = allDataInputs[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var _input = _step.value;

      if (_input.value == "" && _input.id != "Flat") {
        dataInputsAreNotEmpty = false;
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

  if (dataInputsAreNotEmpty == false) {
    toggleValidationError("Все поля обязательны к заполнению.", dataForm);
  } else {
    var _iteratorNormalCompletion2 = true;
    var _didIteratorError2 = false;
    var _iteratorError2 = undefined;

    try {
      for (var _iterator2 = allDataInputs[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
        var input = _step2.value;

        if (input.id == "Email") {
          var regex3 = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          emailValidationIsGood = regex3.test(input.value);

          if (emailValidationIsGood == false) {
            toggleValidationError("Неверныйформат данных при указании эл. почты.", dataForm);
            input.classList.add("error");
          } else {
            input.classList.remove("error");
          }
        }

        if (input.id == "PostIndex") {
          var regex4 = /^[0-9]{6}$/;
          postIndexValidationIsGood = regex4.test(input.value);

          if (postIndexValidationIsGood == false) {
            toggleValidationError("Неверныйформат данных при указании почтового индекса.", dataForm);
            input.classList.add("error");
          } else {
            input.classList.remove("error");
          }
        }

        if (input.id == "Name" || input.id == "Surname" || input.id == "Patronymic") {
          if (fioValidationIsGood == true) {
            if (fioValidationIsGood == false) {
              toggleValidationError("Неверныйформат данных при указании ФИО.", dataForm);
              input.classList.add("error");
            } else {
              var regex1 = /^[a-zA-Zа-яА-ЯёЁ']{2,250}$/;
              fioValidationIsGood = regex1.test(input.value);
              input.classList.remove("error");
            }
          }
        }

        if (input.id == "Login") {
          var regex2 = /^[a-zA-Z0-9]{4,250}$/;
          loginValidationIsGood = regex2.test(input.value);

          if (loginValidationIsGood == false) {
            toggleValidationError("Неверныйформат данных при указании логина.", dataForm);
            input.classList.add("error");
          } else {
            input.classList.remove("error");
          }
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

  if (dataInputsAreNotEmpty == true && fioValidationIsGood == true && loginValidationIsGood == true && emailValidationIsGood == true && postIndexValidationIsGood == true) {// let changeDataInput = dataForm.querySelector("#ChangeData");
    // changeDataInput.click();
  }
});
var passwordForm = document.getElementsByClassName("personal__password-form")[0]; // passwordForm.addEventListener('submit', async (e) => {
// 	e.preventDefault();
// 	let response = await fetch(passwordForm.action, {
// 		method: 'POST',
// 		body: new FormData(passwordForm)
// 	});
// 	if (response.ok) {
// 		window.location.replace("../personal.php");
// 		alert("Пароль успешно измененён.");
// 	}
// 	else {
// 		alert("Request error");
// 	}
// });

var allPasswordsInputs = passwordForm.querySelectorAll("input[type=password]");
var changePasswordButton = document.querySelector("#changePasswordButton");
var passwordInputsAreNotEmpty = true;
var oldPasswordValidationIsGood = true;
var newPasswordValidationIsGood = true;
changePasswordButton.addEventListener("click", function (event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  passwordInputsAreNotEmpty = true;
  oldPasswordValidationIsGood = true;
  newPasswordValidationIsGood = true;
  var _iteratorNormalCompletion3 = true;
  var _didIteratorError3 = false;
  var _iteratorError3 = undefined;

  try {
    for (var _iterator3 = allPasswordsInputs[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
      var _input2 = _step3.value;

      if (_input2.value == "") {
        passwordInputsAreNotEmpty = false;
      }
    }
  } catch (err) {
    _didIteratorError3 = true;
    _iteratorError3 = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion3 && _iterator3["return"] != null) {
        _iterator3["return"]();
      }
    } finally {
      if (_didIteratorError3) {
        throw _iteratorError3;
      }
    }
  }

  if (passwordInputsAreNotEmpty == false) {
    toggleValidationError("Все поля обязательны к заполнению.", passwordForm);
  } else {
    var oldPW = document.querySelector('#OldPassword');
    var newPW = document.querySelector('#NewPassword');
    var _iteratorNormalCompletion4 = true;
    var _didIteratorError4 = false;
    var _iteratorError4 = undefined;

    try {
      for (var _iterator4 = allPasswordsInputs[Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
        var input = _step4.value;

        if (input.id == "OldPassword") {
          var regex1 = /^[a-zA-Z0-9]{4,250}$/;
          oldPasswordValidationIsGood = regex1.test(input.value);

          if (oldPasswordValidationIsGood == false) {
            toggleValidationError("Неверныйформат данных при указании текущего пароля.", passwordForm);
            input.classList.add("error");
          } else {
            oldPW = input;
            input.classList.remove("error");
          }
        }

        if (input.id == "NewPassword") {
          var regex2 = /^[a-zA-Z0-9]{4,250}$/;
          newPasswordValidationIsGood = regex2.test(input.value);

          if (newPasswordValidationIsGood == false) {
            toggleValidationError("Неверныйформат данных при указании нового пароля.", passwordForm);
            input.classList.add("error");
          } else {
            newPW = input;
            input.classList.remove("error");
          }
        }

        if (input.id == "NewPasswordCheck") {
          if (newPW.value != input.value) {
            toggleValidationError("Новый пароль не совпадает.", passwordForm);
            input.classList.add("error");
            newPW.classList.add("error");
          } else if (oldPW.value == newPW.value) {
            toggleValidationError("Новый пароль совпадает со старым.", passwordForm);
            oldPW.classList.add("error");
            newPW.classList.add("error");
          } else {
            oldPW.classList.remove("error");
            newPW.classList.remove("error");
            input.classList.remove("error");
          }
        }
      }
    } catch (err) {
      _didIteratorError4 = true;
      _iteratorError4 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion4 && _iterator4["return"] != null) {
          _iterator4["return"]();
        }
      } finally {
        if (_didIteratorError4) {
          throw _iteratorError4;
        }
      }
    }
  }

  if (passwordInputsAreNotEmpty == true && oldPasswordValidationIsGood == true && newPasswordValidationIsGood == true) {
    var changePasswordInput = passwordForm.querySelector("#ChangePassword");
    changePasswordInput.click();
  }
});

function toggleValidationError(errorMessage, parentElement) {
  var validationError = document.querySelector(".validationError");

  if (validationError != null) {
    validationError.remove();
  }

  var validationErrorNode = document.createElement("p");
  validationErrorNode.innerText = errorMessage;
  validationErrorNode.classList.add('validationError');
  parentElement.appendChild(validationErrorNode);
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