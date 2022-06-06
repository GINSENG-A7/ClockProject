"use strict";

var _window;

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var form = document.querySelector('.form');
var invisibleSubmit = document.querySelector('#invisibleSubmit');
form.addEventListener('submit', function _callee(event) {
  var response;
  return regeneratorRuntime.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          event.preventDefault();
          _context.next = 3;
          return regeneratorRuntime.awrap(fetch('/create_ticket_scrpt.php', {
            method: 'POST',
            body: new FormData(form)
          }));

        case 3:
          response = _context.sent;

          if (response.ok) {
            alert("Ваше сообщение было отправлено!");
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
var allInputs = document.querySelectorAll(".form__input, .form__textarea");
var inputsAreNotEmpty = true;
var emailValidationIsGood = true;
var telephoneValidationIsGood = true;
var nameValidationIsGood = true;
var button = document.querySelector(".form__button");
button.addEventListener("click", function (event) {
  inputsAreNotEmpty = true;
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = allInputs[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var _input = _step.value;

      if (_input.value == "") {
        inputsAreNotEmpty = false;

        _input.classList.add("error");
      } else {
        _input.classList.remove("error");
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
    toggleValidationError("Все поля обязательны к заполнению.", button.form);
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
              toggleValidationError("Неверныйформат данных при указании эл. почты.", button.form);
              input.classList.add("error");
            } else {
              input.classList.remove("error");
            }

            break;

          case "Telephone":
            var regex4 = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
            telephoneValidationIsGood = regex4.test(input.value);

            if (telephoneValidationIsGood == false) {
              toggleValidationError("Неверныйформат данных при указании телефона.", button.form);
              input.classList.add("error");
            } else {
              input.classList.remove("error");
            }

            break;

          case "Name":
            var regex1 = /^[a-zA-Zа-яА-ЯёЁ']{2,250}$/;
            nameValidationIsGood = regex1.test(input.value);

            if (nameValidationIsGood == false) {
              toggleValidationError("Неверныйформат данных при указании имени.", button.form);
              input.classList.add("error");
            } else {
              input.classList.remove("error");
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

  if (inputsAreNotEmpty == true && emailValidationIsGood == true && telephoneValidationIsGood == true && nameValidationIsGood == true) {
    invisibleSubmit.click();
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