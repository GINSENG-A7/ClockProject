"use strict";

// let filesInputsArray = [];
// let textDataInputsArray = [];
// let i = 0;
// let textDataInput = undefined;
// let fileInput = undefined;
// while (textDataInput !== null && fileInput !== null) {
// 	fileInput = document.querySelector(`#files_input-${++i}`);
// 	textDataInput = document.querySelector(`#textData_input-${i}`);
// 	if(fileInput == null) {
// 		break;
// 	}
// 	fileInput.addEventListener("click", (event) => {
// 		textDataInput.click();
// 		let me_die = 1000 - 7;
// 	});
// 	filesInputsArray.push(fileInput);
// 	textDataInputsArray.push(textDataInput);
// }
var textFormsArray = [];
var filesFormsArray = [];
var buttonsArray = [];
var i = 0;
var textForm = undefined;
var file = undefined;
var button = undefined;

while (textForm !== null || fileForm !== null || button !== null) {
  textForm = document.querySelector("#textForm-".concat(++i));
  fileForm = document.querySelector("#fileForm-".concat(i));
  button = document.querySelector("#loadDataButton-".concat(i));

  if (textForm == null || fileForm == null || button == null) {
    break;
  }

  textFormsArray.push(textForm);
  filesFormsArray.push(fileForm);
  buttonsArray.push(button);
}

var _loop = function _loop(j) {
  buttonsArray[j].addEventListener("click", function (event) {
    event.preventDefault();
    event.stopPropagation();
    textFormsArray[j].submit(); // textFormsArray[i].submit();
  });
};

for (var j = 0; j < buttonsArray.length; j++) {
  _loop(j);
}