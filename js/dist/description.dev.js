"use strict";

var _window;

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

// let toCartSubmit = document.querySelector('.alreadyInCart');
// toCartSubmit.addEventListener("load", (e)=> {
// 	e.preventDefault();
// });
var addToCartFormsArray = document.querySelectorAll("#addToCartForm");
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
  var _loop = function _loop() {
    var addToCartForm = _step.value;
    addToCartForm.addEventListener('submit', function _callee(event) {
      var response;
      return regeneratorRuntime.async(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              event.preventDefault();
              _context.next = 3;
              return regeneratorRuntime.awrap(fetch(addToCartForm.action, {
                method: 'POST',
                body: new FormData(addToCartForm)
              }));

            case 3:
              response = _context.sent;

              if (response.ok) {
                // alert("Товар добавлен в корзину.");
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

  for (var _iterator = addToCartFormsArray[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
    _loop();
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

var newCommentFormsArray = document.querySelectorAll(".newComment-form");
var _iteratorNormalCompletion2 = true;
var _didIteratorError2 = false;
var _iteratorError2 = undefined;

try {
  var _loop2 = function _loop2() {
    var newCommentForm = _step2.value;
    newCommentForm.addEventListener('submit', function _callee2(event) {
      var response;
      return regeneratorRuntime.async(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              event.preventDefault();
              _context2.next = 3;
              return regeneratorRuntime.awrap(fetch(newCommentForm.action, {
                method: 'POST',
                body: new FormData(newCommentForm)
              }));

            case 3:
              response = _context2.sent;

              if (response.ok) {
                alert("Комментарий успешно добавлен.");
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
  };

  for (var _iterator2 = newCommentFormsArray[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
    _loop2();
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

var deleteCommentFormsArray = document.querySelectorAll(".comment__deleteForm");
var _iteratorNormalCompletion3 = true;
var _didIteratorError3 = false;
var _iteratorError3 = undefined;

try {
  var _loop3 = function _loop3() {
    var deleteCommentForm = _step3.value;
    deleteCommentForm.addEventListener('submit', function _callee3(event) {
      var response;
      return regeneratorRuntime.async(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              event.preventDefault();
              _context3.next = 3;
              return regeneratorRuntime.awrap(fetch(deleteCommentForm.action, {
                method: 'POST',
                body: new FormData(deleteCommentForm)
              }));

            case 3:
              response = _context3.sent;

              if (response.ok) {
                alert("Комментарий успешно удалён.");
                window.location.reload();
              } else {
                alert("Request error");
              }

            case 5:
            case "end":
              return _context3.stop();
          }
        }
      });
    });
  };

  for (var _iterator3 = deleteCommentFormsArray[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
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

var cords = ['scrollX', 'scrollY']; // Перед закрытием записываем в локалсторадж window.scrollX и window.scrollY как scrollX и scrollY

window.addEventListener('unload', function (e) {
  return cords.forEach(function (cord) {
    return localStorage[cord] = window[cord];
  });
}); // Прокручиваем страницу к scrollX и scrollY из localStorage (либо 0,0 если там еще ничего нет)

(_window = window).scroll.apply(_window, _toConsumableArray(cords.map(function (cord) {
  return localStorage[cord];
})));