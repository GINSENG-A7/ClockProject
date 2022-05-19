let form = document.querySelector('.form');
let invisibleSubmit = document.querySelector('#invisibleSubmit');
form.addEventListener('submit', async (event) => {
	event.preventDefault();
	let response = await fetch('/create_ticket_scrpt.php', {
		method: 'POST',
		body: new FormData(form)
	});
	if (response.ok) {
		alert("Ваше сообщение было отправлено!");
	}
	else {
		alert("Request error");
	}
});

let allInputs = document.querySelectorAll(".form__input, .form__textarea");
let inputsAreNotEmpty = true;
let emailValidationIsGood = true;
let telephoneValidationIsGood = true;
let nameValidationIsGood = true;

let button = document.querySelector(".form__button");
button.addEventListener("click", (event) => {
	inputsAreNotEmpty = true;
	for (const input of allInputs) {
		if (input.value == "") {
			inputsAreNotEmpty = false;
			input.classList.add("error");
		}
		else {
			input.classList.remove("error");
		}
	}
	if (inputsAreNotEmpty == false) {
		toggleValidationError("Все поля обязательны к заполнению.", button.form);
	}
	else {
		for (const input of allInputs) {
			switch (input.id) {
				case "Email":
					let regex3 = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					emailValidationIsGood = regex3.test(input.value);
					if (emailValidationIsGood == false) {
						toggleValidationError("Неверныйформат данных при указании эл. почты.", button.form);
						input.classList.add("error");
					}
					else {
						input.classList.remove("error");
					}
					break;
				case "Telephone":
					let regex4 = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
					telephoneValidationIsGood = regex4.test(input.value);
					if (telephoneValidationIsGood == false) {
						toggleValidationError("Неверныйформат данных при указании телефона.", button.form);
						input.classList.add("error");
					}
					else {
						input.classList.remove("error");
					}
					break;
				case "Name":
					let regex1 = /^[a-zA-Zа-яА-ЯёЁ']{2,250}$/;
					nameValidationIsGood = regex1.test(input.value);
					if (nameValidationIsGood == false) {
						toggleValidationError("Неверныйформат данных при указании имени.", button.form);
						input.classList.add("error");
					}
					else {
						input.classList.remove("error");
					}
					break;
			}
		}
	}
	if (inputsAreNotEmpty == true && emailValidationIsGood == true && telephoneValidationIsGood == true && nameValidationIsGood == true) {
		invisibleSubmit.click();
	}
});

function toggleValidationError(errorMessage, parentElement) {
	let validationError = document.querySelector(".validationError");
	if (validationError != null) {
		validationError.remove();
	}
	let validationErrorNode = document.createElement("p");
	validationErrorNode.innerText = errorMessage;
	validationErrorNode.classList.add('validationError');
	parentElement.appendChild(validationErrorNode);
}