"use strict";

var _window;

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var buttonMinusArray = document.querySelectorAll(".number-minus");
PropagationOff(buttonMinusArray);
var buttonPlusArray = document.querySelectorAll(".number-plus");
PropagationOff(buttonPlusArray);
var inputNumberArray = document.querySelectorAll(".number_input");
PropagationOff(inputNumberArray);
var inputSubmitArray = document.querySelectorAll(".submit_input");
PropagationOff(inputSubmitArray);
var deleteFormsArray = document.querySelectorAll("#deleteItemForm");
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
  var _loop2 = function _loop2() {
    var deleteForm = _step.value;
    deleteForm.addEventListener('submit', function _callee(e) {
      var response;
      return regeneratorRuntime.async(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              e.preventDefault();
              _context.next = 3;
              return regeneratorRuntime.awrap(fetch(deleteForm.action, {
                method: 'POST',
                body: new FormData(deleteForm)
              }));

            case 3:
              response = _context.sent;

              if (response.ok) {
                window.location.reload();
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
  };

  for (var _iterator = deleteFormsArray[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
    _loop2();
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

function PropagationOff(arrayOfElements) {
  var _iteratorNormalCompletion2 = true;
  var _didIteratorError2 = false;
  var _iteratorError2 = undefined;

  try {
    var _loop = function _loop() {
      var element = _step2.value;

      if (element.matches(".number-minus")) {
        element.addEventListener("click", function (e) {
          // e.stopPropagation();
          var input = element.nextElementSibling;
          input.stepDown();
          input.dispatchEvent(new Event('change'));
        });
      }

      if (element.matches(".number-plus")) {
        element.addEventListener("click", function (e) {
          // e.stopPropagation();
          var input = element.previousElementSibling;
          input.stepUp();
          input.dispatchEvent(new Event('change'));
        });
      }
    };

    for (var _iterator2 = arrayOfElements[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
      _loop();
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

var cloneFormsWrapper = document.querySelector(".cloneFormsWrapper");
var numberInputsArray = document.querySelectorAll(".number_input");
var _iteratorNormalCompletion3 = true;
var _didIteratorError3 = false;
var _iteratorError3 = undefined;

try {
  var _loop3 = function _loop3() {
    var numberInput = _step3.value;
    var hiddenInputClone = numberInput.cloneNode(false);
    hiddenInputClone.removeAttribute('readonly');
    numberInput.addEventListener('change', function (e) {
      var value = parseInt(e.target.value);
      hiddenInputClone.defaultValue = value;
    });
    var form = document.createElement('form');
    form.className = "invisible";
    form.action = "/new_order_script.php";
    form.method = 'POST';
    form.appendChild(hiddenInputClone); // Асинхронные отпарвки форм

    form.addEventListener('submit', function _callee2(e) {
      var response;
      return regeneratorRuntime.async(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              e.preventDefault();
              _context2.next = 3;
              return regeneratorRuntime.awrap(fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
              }));

            case 3:
              response = _context2.sent;

              if (response.ok) {
                alert("Ваш заказ обрабатывается, ожидайте отправки.");
                window.location.reload();
              } else {
                alert("Request error");
              }

            case 5:
            case "end":
              return _context2.stop();
          }
        }
      });
    });
    var iIdInput = numberInput.form.querySelector("#itemId");
    var iIdInputClone = iIdInput.cloneNode(false);
    form.appendChild(iIdInputClone);
    var eioIdInput = numberInput.form.querySelector("#entryesInOrderId");
    var eioIdInputClone = eioIdInput.cloneNode(false);
    form.appendChild(eioIdInputClone);
    var oIdInput = numberInput.form.querySelector("#orderId");
    var oIdInputClone = oIdInput.cloneNode(false);
    form.appendChild(oIdInputClone);
    var select = numberInput.form.querySelector(".sizeSelect");

    if (select != undefined) {
      var selectClone = select.cloneNode(true);
      select.addEventListener('change', function (e) {
        var value = e.target.value;
        selectClone.value = value;
      });
      form.appendChild(selectClone);
    }

    var invisibleSubmit = document.createElement("input");
    invisibleSubmit.type = "submit";
    form.appendChild(invisibleSubmit);
    cloneFormsWrapper.appendChild(form);
  };

  for (var _iterator3 = numberInputsArray[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
    _loop3();
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

try {
  var newOrderButton = document.querySelector("#newOrderButton");
  var submitInputsArray = cloneFormsWrapper.querySelectorAll('input[type="submit"]');
  newOrderButton.addEventListener('click', function (event) {
    var _iteratorNormalCompletion4 = true;
    var _didIteratorError4 = false;
    var _iteratorError4 = undefined;

    try {
      for (var _iterator4 = submitInputsArray[Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
        var submitInput = _step4.value;
        submitInput.click();
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
  });
} catch (error) {}

var backwardButton = document.querySelector(".backwardButton");
backwardButton.addEventListener("click", function (e) {
  history.go(-1);
});
var cords = ['scrollX', 'scrollY']; // Перед закрытием записываем в локалсторадж window.scrollX и window.scrollY как scrollX и scrollY

window.addEventListener('unload', function (e) {
  return cords.forEach(function (cord) {
    return localStorage[cord] = window[cord];
  });
}); // Прокручиваем страницу к scrollX и scrollY из localStorage (либо 0,0 если там еще ничего нет)

(_window = window).scroll.apply(_window, _toConsumableArray(cords.map(function (cord) {
  return localStorage[cord];
})));