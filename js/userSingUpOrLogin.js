let form = document.querySelector("#loginOrRegisterForm");

let loginButton = document.querySelector("#loginButton");
loginButton.addEventListener("click", () => {

	form.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(form.action, {
			method: 'POST',
			body: new FormData(form)
		});
		if (response.ok) {
			window.location.replace("../index.php");
			alert("Вы успешно авторизированы.");
		}
		else {
			alert("Request error");
		}
	})

	let singInInput = document.querySelector("#SingIn");
	singInInput.click();
});

let loginVKButton = document.querySelector("#loginVKButton");
loginVKButton.addEventListener("click", () => {
	form.action = "https://www.google.com/";
	let singInVKInput = document.querySelector("#SingInVK");
	singInVKInput.click();
});

let registerButton = document.querySelector("#registerButton");
registerButton.addEventListener("click", () => {
	form.action = "newRegistration.php";
	let registerInput = document.querySelector("#SingUp");
	registerInput.click();
});

function toggleValidationError(errorMessage) {
	let validationError = document.querySelector(".validationError");
	if (validationError != null) {
		validationError.remove();
	}
	let validationErrorNode = document.createElement("p");
	validationErrorNode.innerText = errorMessage;
	validationErrorNode.classList.add('validationError');
	let lastDiv = document.querySelector(".wrapper-buttons");
	lastDiv.appendChild(validationErrorNode);
}