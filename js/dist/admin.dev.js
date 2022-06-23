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
    localStorage.setItem("openedTab", tablinks[i].id);
    var bodyTextAreas = document.querySelectorAll(".wrapper-body");

    for (var _i9 = 0; _i9 < bodyTextAreas.length; _i9++) {
      var bTA = bodyTextAreas[_i9]; //  console.log(bTA.scrollHeight);
      // bTA.style.height = bTA.scrollHeight;
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
var taboutput = document.getElementsByClassName("tab-output");
var contentH2 = document.querySelectorAll("h2.ContentH2");
var outputH2 = document.querySelectorAll("h2.OutputH2");

for (var _i = 0; _i < contentH2.length; _i++) {
  outputH2[_i].style.display = "none";
  contentH2[_i].style.display = "none";
}

for (var _i2 = 0; _i2 < taboutput.length; _i2++) {
  taboutput[_i2].style.display = "none";
}

function openTab(event, tabName) {
  for (var _i3 = 0; _i3 < tabcontent.length; _i3++) {
    if (tabcontent[_i3].id != tabName) {
      tabcontent[_i3].style.display = "none";
    } else {
      tabcontent[_i3].style.display = "block";
      contentH2[_i3].style.display = "block";
    }
  }

  for (var _i4 = 0; _i4 < taboutput.length; _i4++) {
    if (taboutput[_i4].id != tabName) {
      taboutput[_i4].style.display = "none";
    } else {
      taboutput[_i4].style.display = "block";
      outputH2[_i4].style.display = "block";
    }
  } // Get all elements with class="tablinks" and remove the class "active"


  for (var _i5 = 0; _i5 < tablinks.length; _i5++) {
    tablinks[_i5].className = tablinks[_i5].className.replace("active", "");
  } // Show the current tab, and add an "active" class to the button that opened the tab


  event.currentTarget.className += " active";
} //Rebind button click to invisible submit in the form


var picturesForms = document.querySelectorAll("form.deleteOnePictureForm");

var _loop2 = function _loop2(_i6) {
  var pictureForm = picturesForms[_i6];
  var xButton = pictureForm.querySelector("#X-button");
  var submitInput = pictureForm.querySelector("#X-submit");
  xButton.addEventListener("click", function () {
    submitInput.click();
  });
  pictureForm.addEventListener('submit', function _callee2(e) {
    var response;
    return regeneratorRuntime.async(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            e.preventDefault();
            _context2.next = 3;
            return regeneratorRuntime.awrap(fetch(pictureForm.action, {
              method: 'POST',
              body: new FormData(pictureForm)
            }));

          case 3:
            response = _context2.sent;

            if (response.ok) {
              alert("Фото успешно удалено.");
              window.location.replace("../admin.php");
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

for (var _i6 = 0; _i6 < picturesForms.length; _i6++) {
  _loop2(_i6);
}

var insertImageForms = document.querySelectorAll("form.insertImageForm");

var _loop3 = function _loop3(_i7) {
  var insertImage = insertImageForms[_i7];
  var insertButton = insertImage.querySelector("#insertImage-button");
  var filesInput = insertImage.querySelector("#files");
  var submitInput = insertImage.querySelector("#insertImage-submit");
  filesInput.addEventListener('change', handleFileSelect, false);

  function handleFileSelect(event) {
    var files = event.target.files; // FileList object

    var output = [];

    for (var _i10 = 0, f; f = files[_i10]; _i10++) {
      output.push(escape(f.name));
    }

    if (files != null || files != undefined || output.length > 0) {
      submitInput.click();
    }

    console.log(output);
  }

  filesInput.addEventListener('submit', function _callee3(e) {
    var response;
    return regeneratorRuntime.async(function _callee3$(_context3) {
      while (1) {
        switch (_context3.prev = _context3.next) {
          case 0:
            e.preventDefault();
            _context3.next = 3;
            return regeneratorRuntime.awrap(fetch(filesInput.action, {
              method: 'POST',
              body: new FormData(filesInput)
            }));

          case 3:
            response = _context3.sent;

            if (response.ok) {
              alert("Фото успешно добавлено.");
              window.location.replace("../admin.php");
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
  insertButton.addEventListener("click", function (event) {
    filesInput.click();
    event.stopPropagation();
  });
};

for (var _i7 = 0; _i7 < insertImageForms.length; _i7++) {
  _loop3(_i7);
}

var outputForms = document.querySelectorAll(".outputForm");
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
  var _loop5 = function _loop5() {
    var outputForm = _step.value;
    outputForm.addEventListener('submit', function _callee4(e) {
      var response;
      return regeneratorRuntime.async(function _callee4$(_context4) {
        while (1) {
          switch (_context4.prev = _context4.next) {
            case 0:
              e.preventDefault();
              _context4.next = 3;
              return regeneratorRuntime.awrap(fetch(outputForm.action, {
                method: 'POST',
                body: new FormData(outputForm)
              }));

            case 3:
              response = _context4.sent;

              if (response.ok) {
                alert("Данные успешно обновлены.");
                window.location.replace("../admin.php");
              } else {
                alert("Request error");
              }

            case 5:
            case "end":
              return _context4.stop();
          }
        }
      });
    });
  };

  for (var _iterator = outputForms[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
    _loop5();
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

var tabContentForms = document.querySelectorAll(".tab-content > form");
var _iteratorNormalCompletion2 = true;
var _didIteratorError2 = false;
var _iteratorError2 = undefined;

try {
  var _loop6 = function _loop6() {
    var tabContentForm = _step2.value;
    tabContentForm.addEventListener('submit', function _callee5(e) {
      var response;
      return regeneratorRuntime.async(function _callee5$(_context5) {
        while (1) {
          switch (_context5.prev = _context5.next) {
            case 0:
              e.preventDefault();
              _context5.next = 3;
              return regeneratorRuntime.awrap(fetch(tabContentForm.action, {
                method: 'POST',
                body: new FormData(tabContentForm)
              }));

            case 3:
              response = _context5.sent;

              if (response.ok) {
                alert("Данные успешно добавлены.");
                window.location.replace("../admin.php");
              } else {
                alert("Request error");
              }

            case 5:
            case "end":
              return _context5.stop();
          }
        }
      });
    });
  };

  for (var _iterator2 = tabContentForms[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
    _loop6();
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

var updateClientDiscountForms = document.querySelectorAll(".clientForm");

var _loop4 = function _loop4(_i8) {
  updateClientDiscountForms[_i8].addEventListener('submit', function _callee6(e) {
    var response;
    return regeneratorRuntime.async(function _callee6$(_context6) {
      while (1) {
        switch (_context6.prev = _context6.next) {
          case 0:
            e.preventDefault();
            _context6.next = 3;
            return regeneratorRuntime.awrap(fetch('../update_client_discount_script.php', {
              method: 'POST',
              body: new FormData(updateClientDiscountForms[_i8])
            }));

          case 3:
            response = _context6.sent;

            if (response.ok) {
              alert("Данные учётной записи успешно обновлены");
              window.location.replace("../admin.php");
            } else {
              alert("Request error");
            }

          case 5:
          case "end":
            return _context6.stop();
        }
      }
    });
  });
};

for (var _i8 = 0; _i8 < updateClientDiscountForms.length; _i8++) {
  _loop4(_i8);
}

var orderLinkWrappedButtonsArray = document.querySelectorAll(".order__entryes-link > button");
var _iteratorNormalCompletion3 = true;
var _didIteratorError3 = false;
var _iteratorError3 = undefined;

try {
  var _loop7 = function _loop7() {
    var button = _step3.value;
    button.addEventListener("click", function (event) {
      event.preventDefault();
      button.closest("a").click();
    });
    button.form.addEventListener('submit', function _callee7(e) {
      var response;
      return regeneratorRuntime.async(function _callee7$(_context7) {
        while (1) {
          switch (_context7.prev = _context7.next) {
            case 0:
              e.preventDefault();
              _context7.next = 3;
              return regeneratorRuntime.awrap(fetch(button.form.action, {
                method: 'POST',
                body: new FormData(button.form)
              }));

            case 3:
              response = _context7.sent;

              if (response.ok) {
                alert("Данные успешно обновлены");
                window.location.replace("../admin.php");
              } else {
                alert("Request error");
              }

            case 5:
            case "end":
              return _context7.stop();
          }
        }
      });
    });
  };

  for (var _iterator3 = orderLinkWrappedButtonsArray[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
    _loop7();
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

var cancelOrderButtonsArray = document.querySelectorAll('.cancel_order_btn');
var _iteratorNormalCompletion4 = true;
var _didIteratorError4 = false;
var _iteratorError4 = undefined;

try {
  var _loop8 = function _loop8() {
    var cancelOrderButton = _step4.value;
    cancelOrderButton.addEventListener("click", function (event) {
      event.preventDefault();
      event.stopPropagation();
      cancelOrderButton.form.action = "../cancel_order.php";
      cancelOrderButton.previousElementSibling.click();
    });
  };

  for (var _iterator4 = cancelOrderButtonsArray[Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
    _loop8();
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

var ticketForms = document.querySelectorAll(".ticketForm");
var _iteratorNormalCompletion5 = true;
var _didIteratorError5 = false;
var _iteratorError5 = undefined;

try {
  var _loop9 = function _loop9() {
    var form = _step5.value;
    form.addEventListener('submit', function _callee8(e) {
      var response, formAction;
      return regeneratorRuntime.async(function _callee8$(_context8) {
        while (1) {
          switch (_context8.prev = _context8.next) {
            case 0:
              e.preventDefault();
              _context8.next = 3;
              return regeneratorRuntime.awrap(fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
              }));

            case 3:
              response = _context8.sent;
              formAction = form.action.substring(form.action.lastIndexOf("/") + 1);

              if (response.ok) {
                if (formAction == "perform_ticket_script.php") {
                  alert("Вы назначены ответственным за разрешение данного обращения.");
                  window.location.replace("../admin.php");
                } else if (formAction == "close_ticket_script.php") {
                  alert("Обращение было закрыто.");
                }
              } else {
                alert("Request error");
              }

            case 6:
            case "end":
              return _context8.stop();
          }
        }
      });
    });
  };

  for (var _iterator5 = ticketForms[Symbol.iterator](), _step5; !(_iteratorNormalCompletion5 = (_step5 = _iterator5.next()).done); _iteratorNormalCompletion5 = true) {
    _loop9();
  }
} catch (err) {
  _didIteratorError5 = true;
  _iteratorError5 = err;
} finally {
  try {
    if (!_iteratorNormalCompletion5 && _iterator5["return"] != null) {
      _iterator5["return"]();
    }
  } finally {
    if (_didIteratorError5) {
      throw _iteratorError5;
    }
  }
}

var exitForm = document.querySelector(".exit_form");
exitForm.addEventListener('submit', function _callee(e) {
  var response, formAction;
  return regeneratorRuntime.async(function _callee$(_context) {
    while (1) {
      switch (_context.prev = _context.next) {
        case 0:
          e.preventDefault();
          _context.next = 3;
          return regeneratorRuntime.awrap(fetch(exitForm.action, {
            method: 'POST',
            body: new FormData(exitForm)
          }));

        case 3:
          response = _context.sent;
          formAction = exitForm.action.substring(exitForm.action.lastIndexOf("/") + 1);

          if (response.ok) {
            alert("Вы успешно вышли из учётной записи.");
            window.location.replace("../index.php");
          } else {
            alert("Request error");
          }

        case 6:
        case "end":
          return _context.stop();
      }
    }
  });
});
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