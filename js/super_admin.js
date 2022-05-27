let tablinks = document.getElementsByClassName("tab-links");
for (let i = 0; i < tablinks.length; i++) {
	tablinks[i].addEventListener("click", () => {
		openTab(event, tablinks[i].outerText);

		let bodyTextAreas = document.querySelectorAll(".wrapper-body");
		for (let i = 0; i < bodyTextAreas.length; i++) {
			let bTA = bodyTextAreas[i];
			// bTA.style.height = bTA.scrollHeight;
			// bTA.style.overflowY = "hidden";
			bTA.setAttribute("style", "height:" + (bTA.scrollHeight) + "px;");
			bTA.addEventListener("input", OnInput, false);
		}
		function OnInput() {
			this.style.height = "auto";
			this.style.height = (this.scrollHeight) + "px";
		}
	});
}

let tabcontent = document.getElementsByClassName("tab-content");
let taboutput = document.getElementsByClassName("tab-output");

// let contentH2 = document.querySelectorAll("h2.ContentH2");
// let outputH2 = document.querySelectorAll("h2.OutputH2");
// for (let i = 0; i < contentH2.length; i++) {
// 	outputH2[i].style.display = "none";
// 	contentH2[i].style.display = "none";
// }

for (let i = 0; i < taboutput.length; i++) {
	taboutput[i].style.display = "none";
}

function openTab(event, tabName) {
	for (let i = 0; i < tabcontent.length; i++) {
		if (tabcontent[i].id != tabName) {
			tabcontent[i].style.display = "none";
		}
		else {
			tabcontent[i].style.display = "block";
			// contentH2[i].style.display = "block";
		}
	}

	for (let i = 0; i < taboutput.length; i++) {
		if (taboutput[i].id != tabName) {
			taboutput[i].style.display = "none";
		}
		else {
			taboutput[i].style.display = "block";
			// outputH2[i].style.display = "block";
		}
	}
  
	// Get all elements with class="tablinks" and remove the class "active"
	for (let i = 0; i < tablinks.length; i++) {
	  	tablinks[i].className = tablinks[i].className.replace("active", "");
	}
  
	// Show the current tab, and add an "active" class to the button that opened the tab
	event.currentTarget.className += " active";
}

let sizeFormsArray = document.querySelectorAll(".sizeEditForm");

for (const sizeForm of sizeFormsArray) {
	// sizeForm.addEventListener('submit', async (e) => {
	// 	e.preventDefault();
	// 	let response = await fetch(sizeForm.action, {
	// 		method: 'POST',
	// 		body: new FormData(sizeForm)
	// 	});
	// 	if (response.ok) {
	// 		alert("Размер больше не активен");
	// 	}
	// 	else {
	// 		alert("Request error");
	// 	}
	// });

	let submitInput = sizeForm.querySelector(".sizeForm-disable");
	let deleteButton = sizeForm.querySelector(".sizeForm-delete");
	deleteButton.addEventListener("click", (event) => {
		event.preventDefault();
		event.stopImmediatePropagation();
		if (confirm("Вы уверены, что хотите полностью удалить все данные пользователя?")) {
			if (submitInput.name == "disableSize") {
				submitInput.name = "ableSize";
				submitInput.value = "Вернуть";
			}
			else if (submitInput.name == "ableSize") {
				submitInput.name = "disableSize";
				submitInput.value = "Убрать";
			}
			clientForm.action = "./delete_size_script.php";
			submitInput.click();
		}
	})
}


let clientFormsArray = document.querySelectorAll(".clientForm");

for (const clientForm of clientFormsArray) {
	clientForm.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(clientForm.action, {
			method: 'POST',
			body: new FormData(clientForm)
		});
		if (response.ok) {
			window.location.replace("../index.php");
			alert("Учётная запись успешно создана");
		}
		else {
			alert("Request error");
		}
	});

	let submitInput = clientForm.querySelector("#client-update__input");
	let deleteButton = clientForm.querySelector(".client-delete__button");
	deleteButton.addEventListener("click", (event) => {
		event.preventDefault();
		event.stopImmediatePropagation();
		if (confirm("Вы уверены, что хотите полностью удалить все данные пользователя?")) {
			clientForm.action = "./delete_user_script.php";
			submitInput.click();
		}
	});
}


