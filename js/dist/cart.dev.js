"use strict";

var buttonMinusArray = document.querySelectorAll(".number-minus");
PropagationOff(buttonMinusArray);
var buttonPlusArray = document.querySelectorAll(".number-plus");
PropagationOff(buttonPlusArray);
var inputNumberArray = document.querySelectorAll(".number_input");
PropagationOff(inputNumberArray);
var inputSubmitArray = document.querySelectorAll(".submit_input");
PropagationOff(inputSubmitArray);

function PropagationOff(arrayOfElements) {
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    var _loop = function _loop() {
      var element = _step.value;

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

    for (var _iterator = arrayOfElements[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
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
}

var newOfferForm = document.querySelector("#newOfferForm");
var numberInputsArray = document.querySelectorAll(".number_input");
var _iteratorNormalCompletion2 = true;
var _didIteratorError2 = false;
var _iteratorError2 = undefined;

try {
  var _loop2 = function _loop2() {
    var numberInput = _step2.value;
    var idInput = numberInput.form.querySelector("#itemId");
    var hiddenInputClone = numberInput.cloneNode(false);
    hiddenInputClone.removeAttribute('readonly');
    var idInputClone = idInput.cloneNode(false);
    numberInput.addEventListener('change', function (e) {
      var value = parseInt(e.target.value);
      hiddenInputClone.defaultValue = value;
    });
    var div = document.createElement('div');
    div.className = "invisible";
    div.appendChild(hiddenInputClone);
    div.appendChild(idInputClone);
    newOfferForm.appendChild(div);
  };

  for (var _iterator2 = numberInputsArray[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
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