"use strict";

var tablinks = document.getElementsByClassName("tab-links");

var _loop = function _loop(i) {
  tablinks[i].addEventListener("click", function () {
    openTab(event, tablinks[i].outerText);
    var bodyTextAreas = document.querySelectorAll(".wrapper-body");

    for (var _i9 = 0; _i9 < bodyTextAreas.length; _i9++) {
      var bTA = bodyTextAreas[_i9];
      console.log(bTA.scrollHeight); // bTA.style.height = bTA.scrollHeight;
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
  pictureForm = picturesForms[_i6];
  var xButton = pictureForm.querySelector("#X-button");
  var submitInput = pictureForm.querySelector("#X-submit");
  xButton.addEventListener("click", function () {
    submitInput.click();
  });
};

for (var _i6 = 0; _i6 < picturesForms.length; _i6++) {
  _loop2(_i6);
}

var insertImageForms = document.querySelectorAll("form.insertImageForm");

var _loop3 = function _loop3(_i7) {
  insertImage = insertImageForms[_i7];
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

  insertButton.addEventListener("click", function (event) {
    filesInput.click();
    event.stopPropagation();
  });
};

for (var _i7 = 0; _i7 < insertImageForms.length; _i7++) {
  _loop3(_i7);
}

var updateClientDiscountForms = document.querySelectorAll(".clientForm");

var _loop4 = function _loop4(_i8) {
  updateClientDiscountForms[_i8].addEventListener('submit', function _callee(e) {
    var response;
    return regeneratorRuntime.async(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            e.preventDefault();
            _context.next = 3;
            return regeneratorRuntime.awrap(fetch('../update_client_discount_script.php', {
              method: 'POST',
              body: new FormData(updateClientDiscountForms[_i8])
            }));

          case 3:
            response = _context.sent;

            if (response.ok) {
              alert("Данные учётной записи успешно обновлены");
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

for (var _i8 = 0; _i8 < updateClientDiscountForms.length; _i8++) {
  _loop4(_i8);
}

var orderLinkWrappedButtonsArray = document.querySelectorAll(".order__entryes-link > button");
var _iteratorNormalCompletion = true;
var _didIteratorError = false;
var _iteratorError = undefined;

try {
  var _loop5 = function _loop5() {
    var button = _step.value;
    button.addEventListener("click", function (event) {
      event.preventDefault();
      button.closest("a").click();
    });
  };

  for (var _iterator = orderLinkWrappedButtonsArray[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
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