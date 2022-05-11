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
          e.stopPropagation();
          var input = element.nextElementSibling;
          input.stepDown();
        });
      }

      if (element.matches(".number-plus")) {
        element.addEventListener("click", function (e) {
          e.stopPropagation();
          var input = element.previousElementSibling;
          input.stepUp();
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