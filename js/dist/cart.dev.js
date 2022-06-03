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

var cloneFormsWrapper = document.querySelector(".cloneFormsWrapper");
var numberInputsArray = document.querySelectorAll(".number_input");
var _iteratorNormalCompletion2 = true;
var _didIteratorError2 = false;
var _iteratorError2 = undefined;

try {
  var _loop2 = function _loop2() {
    var numberInput = _step2.value;
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
    // form.addEventListener('submit', async (e) => {
    // 	e.preventDefault();
    // 	let response = await fetch(form.action, {
    // 		method: 'POST',
    // 		body: new FormData(form)
    // 	});
    // 	if (response.ok) {
    // 		alert("Ваш заказ обрабатывается, ожидайте отправки.");
    // 	}
    // 	else {
    // 		alert("Request error");
    // 	}
    // });

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

var newOrderButton = document.querySelector("#newOrderButton");
var submitInputsArray = cloneFormsWrapper.querySelectorAll('input[type="submit"]');
newOrderButton.addEventListener('click', function (event) {
  var _iteratorNormalCompletion3 = true;
  var _didIteratorError3 = false;
  var _iteratorError3 = undefined;

  try {
    for (var _iterator3 = submitInputsArray[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
      var submitInput = _step3.value;
      submitInput.click();
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
});