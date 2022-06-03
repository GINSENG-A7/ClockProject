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

let cloneFormsWrapper = document.querySelector(".cloneFormsWrapper");
let numberInputsArray = document.querySelectorAll(".number_input");
for (const numberInput of numberInputsArray) {
	let hiddenInputClone = numberInput.cloneNode(false);
	hiddenInputClone.removeAttribute('readonly')
	numberInput.addEventListener('change', function (e) {
		let value = parseInt(e.target.value);
		hiddenInputClone.defaultValue = value;
	});
	
	let form = document.createElement('form');
	form.className = "invisible";
	form.action = "/new_order_script.php";
	form.method = 'POST';
	form.appendChild(hiddenInputClone);
	// Асинхронные отпарвки форм
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

	let iIdInput = numberInput.form.querySelector("#itemId");
	let iIdInputClone = iIdInput.cloneNode(false);
	form.appendChild(iIdInputClone);

	let eioIdInput = numberInput.form.querySelector("#entryesInOrderId");
	let eioIdInputClone = eioIdInput.cloneNode(false);
	form.appendChild(eioIdInputClone);

	let oIdInput = numberInput.form.querySelector("#orderId");
	let oIdInputClone = oIdInput.cloneNode(false);
	form.appendChild(oIdInputClone);

	let select = numberInput.form.querySelector(".sizeSelect");
	if (select != undefined) {
		let selectClone = select.cloneNode(true);
		select.addEventListener('change', function (e) {
			let value = e.target.value;
			selectClone.value = value;
		});
	
		form.appendChild(selectClone);
	}

	let invisibleSubmit = document.createElement("input");
	invisibleSubmit.type = "submit";
	form.appendChild(invisibleSubmit);

	cloneFormsWrapper.appendChild(form);
}

let newOrderButton = document.querySelector("#newOrderButton");
let submitInputsArray = cloneFormsWrapper.querySelectorAll('input[type="submit"]');
newOrderButton.addEventListener('click', (event) => {
	for (const submitInput of submitInputsArray) {
		submitInput.click();
	}
});
