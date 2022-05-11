let buttonMinusArray = document.querySelectorAll(".number-minus");
PropagationOff(buttonMinusArray);

let buttonPlusArray = document.querySelectorAll(".number-plus");
PropagationOff(buttonPlusArray);

let inputNumberArray = document.querySelectorAll(".number_input");
PropagationOff(inputNumberArray);

let inputSubmitArray = document.querySelectorAll(".submit_input");
PropagationOff(inputSubmitArray);

function PropagationOff(arrayOfElements) {
	for (const element of arrayOfElements) {
		if(element.matches(".number-minus")) {
			element.addEventListener("click", (e) => {
				e.stopPropagation();
				let input = element.nextElementSibling;
				input.stepDown();
			});
		}
		if(element.matches(".number-plus")) {
			element.addEventListener("click", (e) => {
				e.stopPropagation();
				let input = element.previousElementSibling; 
				input.stepUp(); 
			});
		}
	}
}