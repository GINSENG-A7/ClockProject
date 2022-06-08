"use strict";

var _window;

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var tablinks = document.getElementsByClassName("tab-links");

var _loop = function _loop(i) {
  tablinks[i].addEventListener("click", function () {
    openTab(event, tablinks[i].outerText);
    localStorage.setItem(tablinks[i].id, 1);
    var bodyTextAreas = document.querySelectorAll(".wrapper-body");

    for (var _i5 = 0; _i5 < bodyTextAreas.length; _i5++) {
      var bTA = bodyTextAreas[_i5]; // bTA.style.height = bTA.scrollHeight;
      // bTA.style.overflowY = "hidden";

      bTA.setAttribute("style", "height:" + bTA.scrollHeight + "px;");
      bTA.addEventListener("input", OnInput, false);
    }

    function OnInput() {
      this.style.height = "auto";
      this.style.height = this.scrollHeight + "px";
    }
  });
};

for (var i = 0; i < tablinks.length; i++) {
  _loop(i);
}

var tabcontent = document.getElementsByClassName("tab-content");
var taboutput = document.getElementsByClassName("tab-output"); // let contentH2 = document.querySelectorAll("h2.ContentH2");
// let outputH2 = document.querySelectorAll("h2.OutputH2");
// for (let i = 0; i < contentH2.length; i++) {
// 	outputH2[i].style.display = "none";
// 	contentH2[i].style.display = "none";
// }

for (var _i = 0; _i < taboutput.length; _i++) {
  taboutput[_i].style.display = "none";
}

function openTab(event, tabName) {
  for (var _i2 = 0; _i2 < tabcontent.length; _i2++) {
    if (tabcontent[_i2].id != tabName) {
      tabcontent[_i2].style.display = "none";
    } else {
      tabcontent[_i2].style.display = "block"; // contentH2[i].style.display = "block";
    }
  }

  for (var _i3 = 0; _i3 < taboutput.length; _i3++) {
    if (taboutput[_i3].id != tabName) {
      taboutput[_i3].style.display = "none";
    } else {
      taboutput[_i3].style.display = "block"; // outputH2[i].style.display = "block";
    }
  } // Get all elements with class="tablinks" and remove the class "active"


  for (var _i4 = 0; _i4 < tablinks.length; _i4++) {
    tablinks[_i4].className = tablinks[_i4].className.replace("active", "");
  } // Show the current tab, and add an "active" class to the button that opened the tab


  event.currentTarget.className += " active";
}

var sizeFormsArray = document.querySelectorAll(".sizeEditForm");
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
  var _loop2 = function _loop2() {
    var sizeForm = _step.value;
    sizeForm.addEventListener('submit', function _callee(e) {
      var response;
      return regeneratorRuntime.async(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              e.preventDefault();
              _context.next = 3;
              return regeneratorRuntime.awrap(fetch(sizeForm.action, {
                method: 'POST',
                body: new FormData(sizeForm)
              }));

            case 3:
              response = _context.sent;

              if (response.ok) {
                alert("Размер больше не активен");
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
    var submitInput = sizeForm.querySelector(".sizeForm-disable");
    var deleteButton = sizeForm.querySelector(".sizeForm-delete");
    deleteButton.addEventListener("click", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      if (confirm("Вы уверены, что хотите полностью удалить данный размер?")) {
        if (submitInput.name == "disableSize") {
          submitInput.name = "ableSize";
          submitInput.value = "Вернуть";
        } else if (submitInput.name == "ableSize") {
          submitInput.name = "disableSize";
          submitInput.value = "Убрать";
        }

        submitInput.form.action = "./delete_size_script.php";
        submitInput.click();
      }
    });
  };

  for (var _iterator = sizeFormsArray[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
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

var clientFormsArray = document.querySelectorAll(".clientForm");
var _iteratorNormalCompletion2 = true;
var _didIteratorError2 = false;
var _iteratorError2 = undefined;

try {
  var _loop3 = function _loop3() {
    var clientForm = _step2.value;
    clientForm.addEventListener('submit', function _callee2(e) {
      var response;
      return regeneratorRuntime.async(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              e.preventDefault();
              _context2.next = 3;
              return regeneratorRuntime.awrap(fetch(clientForm.action, {
                method: 'POST',
                body: new FormData(clientForm)
              }));

            case 3:
              response = _context2.sent;

              if (response.ok) {
                // window.location.replace("../index.php");
                alert("Учётная запись успешно создана");
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
    var submitInput = clientForm.querySelector("#client-update__input");
    var deleteButton = clientForm.querySelector(".client-delete__button");
    deleteButton.addEventListener("click", function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();

      if (confirm("Вы уверены, что хотите полностью удалить все данные пользователя?")) {
        clientForm.action = "./delete_user_script.php";
        submitInput.click();
      }
    });
  };

  for (var _iterator2 = clientFormsArray[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
    _loop3();
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

var cords = ['scrollX', 'scrollY']; // Перед закрытием записываем в локалсторадж window.scrollX и window.scrollY как scrollX и scrollY

window.addEventListener('unload', function (e) {
  cords.forEach(function (cord) {
    return localStorage[cord] = window[cord];
  });
}); // Прокручиваем страницу к scrollX и scrollY из localStorage (либо 0,0 если там еще ничего нет)

document.querySelector("#" + localStorage.getItem('openedTab')).click();

(_window = window).scroll.apply(_window, _toConsumableArray(cords.map(function (cord) {
  return localStorage[cord];
})));