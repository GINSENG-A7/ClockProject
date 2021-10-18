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
let textFormsArray = [];
let filesFormsArray = [];
let buttonsArray = [];
let i = 0;
let textForm = undefined;
let file = undefined;
let button = undefined;
while (textForm !== null || fileForm !== null || button !== null) {
	textForm = document.querySelector(`#textForm-${++i}`);
	fileForm = document.querySelector(`#fileForm-${i}`);
	button = document.querySelector(`#loadDataButton-${i}`);
	if(textForm == null || fileForm == null || button == null) {
		break;
	}

	textFormsArray.push(textForm);
	filesFormsArray.push(fileForm);
	buttonsArray.push(button);
}

for (let j = 0; j < buttonsArray.length; j++) {
	buttonsArray[j].addEventListener("click", (event) => {
		event.preventDefault();
		event.stopPropagation();
		textFormsArray[j].submit();
		// textFormsArray[i].submit();
	});
}