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
				// e.stopPropagation();
				let input = element.nextElementSibling;
				input.stepDown();
				input.dispatchEvent(new Event('change'));
			});
		}
		if(element.matches(".number-plus")) {
			element.addEventListener("click", (e) => {
				// e.stopPropagation();
				let input = element.previousElementSibling; 
				input.stepUp(); 
				input.dispatchEvent(new Event('change'));
			});
		}
	}
}

let newOfferForm = document.querySelector("#newOfferForm");
let numberInputsArray = document.querySelectorAll(".number_input");
for (const numberInput of numberInputsArray) {
	let idInput = numberInput.form.querySelector("#itemId");
	let hiddenInputClone = numberInput.cloneNode(false);
	hiddenInputClone.removeAttribute('readonly')
	let idInputClone = idInput.cloneNode(false);
	numberInput.addEventListener('change', function (e) {
		let value = parseInt(e.target.value);
		hiddenInputClone.defaultValue = value;
	});
	
	let div = document.createElement('div');
	div.className = "invisible";
	div.appendChild(hiddenInputClone);


	div.appendChild(idInputClone);

	let select = numberInput.form.querySelector(".sizeSelect");
	if (select != undefined) {
		let selectClone = select.cloneNode(true);
		select.addEventListener('change', function (e) {
			let value = parseInt(e.target.value);
			selectClone.defaultValue = value;
		});
	
		div.appendChild(selectClone);
	}

	newOfferForm.appendChild(div);
}
