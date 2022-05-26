let form = document.querySelector('#registrationForm');
form.addEventListener('submit', async (e) => {
	e.preventDefault();
	let response = await fetch(form.action, {
		method: 'POST',
		body: new FormData(form)
	});
	if (response.ok) {
		window.location.replace("../index.php");
		alert("Учётная запись успешно создана");
	}
	else {
		alert("Request error");
	}
});

let allInputs = document.querySelectorAll("input[type=text]");

let registerButton = document.querySelector("#registerButton");
let wrapperInputs = document.querySelector(".wrapper-inputs");
let inputsAreNotEmpty = true;
let fioValidationIsGood = true;
let loginPasswordValidationIsGood = true;
let emailValidationIsGood = true;

registerButton.addEventListener("click", () => {
	inputsAreNotEmpty = true;
	for (const input of allInputs) {
		if (input.value == "" && input.id != "Flat") {
			inputsAreNotEmpty = false;
		}
	}
	if (inputsAreNotEmpty == false) {
		toggleValidationError("Все поля обязательны к заполнению.", wrapperInputs);
	}
	else {
		for (const input of allInputs) {
			if (input.id == "Email") {
				let regex3 = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				emailValidationIsGood = regex3.test(input.value);
				if (emailValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании эл. почты.", wrapperInputs);
					input.classList.add("error");
				}
				else {
					input.classList.remove("error");
				}
			}
			if (input.id == "PostIndex") {
				let regex4 = /^[0-9]{6}$/;
				fioValidationIsGood = regex4.test(input.value);
				if (fioValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании почтового индекса.", wrapperInputs);
					input.classList.add("error");
				}
				else {
					input.classList.remove("error");
				}
			}
			if (input.id == "Name" || input.id == "Surname" || input.id == "Patronymic") {
				let regex1 = /^[a-zA-Zа-яА-ЯёЁ']{2,250}$/;
				fioValidationIsGood = regex1.test(input.value);
				if (fioValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании ФИО.", wrapperInputs);
					input.classList.add("error");
				}
				else {
					input.classList.remove("error");
				}
			}
			if (input.id == "Login" || input.id == "Password") {
				let regex2 = /^[a-zA-Z0-9]{4,250}$/;
				loginPasswordValidationIsGood = regex2.test(input.value);
				if (loginPasswordValidationIsGood == false) {
					toggleValidationError("Неверныйформат данных при указании логина или пароля.", wrapperInputs);
					input.classList.add("error");
				}
				else {
					input.classList.remove("error");
				}
			}
		}
	}
	if (inputsAreNotEmpty == true && fioValidationIsGood == true && loginPasswordValidationIsGood == true && emailValidationIsGood == true) {
		let registerInput = document.querySelector("#SingUp");
		registerInput.click();
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