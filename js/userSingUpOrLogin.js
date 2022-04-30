let form = document.querySelector("#loginOrRegisterForm");

let loginButton = document.querySelector("#loginButton");
loginButton.addEventListener("click", () => {
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