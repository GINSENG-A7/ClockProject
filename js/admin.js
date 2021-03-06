
let tablinks = document.getElementsByClassName("tab-links");
for (let i = 0; i < tablinks.length; i++) {
	tablinks[i].addEventListener("click", () => {
		openTab(event, tablinks[i].outerText);

		localStorage.setItem("openedTab", tablinks[i].id);

		let bodyTextAreas = document.querySelectorAll(".wrapper-body");
		for (let i = 0; i < bodyTextAreas.length; i++) {
			let bTA = bodyTextAreas[i];
			//  console.log(bTA.scrollHeight);
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

let contentH2 = document.querySelectorAll("h2.ContentH2");
let outputH2 = document.querySelectorAll("h2.OutputH2");
for (let i = 0; i < contentH2.length; i++) {
	outputH2[i].style.display = "none";
	contentH2[i].style.display = "none";
}

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
			contentH2[i].style.display = "block";
		}
	}

	for (let i = 0; i < taboutput.length; i++) {
		if (taboutput[i].id != tabName) {
			taboutput[i].style.display = "none";
		}
		else {
			taboutput[i].style.display = "block";
			outputH2[i].style.display = "block";
		}
	}
  
	// Get all elements with class="tablinks" and remove the class "active"
	for (let i = 0; i < tablinks.length; i++) {
	  	tablinks[i].className = tablinks[i].className.replace("active", "");
	}
  
	// Show the current tab, and add an "active" class to the button that opened the tab
	event.currentTarget.className += " active";
}

//Rebind button click to invisible submit in the form
let picturesForms = document.querySelectorAll("form.deleteOnePictureForm");
for (let i = 0; i < picturesForms.length; i++) {
	let pictureForm = picturesForms[i];
	let xButton = pictureForm.querySelector("#X-button");
	let submitInput = pictureForm.querySelector("#X-submit");

	xButton.addEventListener("click", () => {
		submitInput.click();
	});

	pictureForm.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(pictureForm.action, {
			method: 'POST',
			body: new FormData(pictureForm)
		});
		if (response.ok) {
			alert("???????? ?????????????? ??????????????.");
			window.location.replace("../admin.php");
		}
		else {
			alert("Request error");
		}
	});
}

let insertImageForms = document.querySelectorAll("form.insertImageForm");
for (let i = 0; i < insertImageForms.length; i++) {
	let insertImage = insertImageForms[i];
	let insertButton = insertImage.querySelector("#insertImage-button");
	let filesInput = insertImage.querySelector("#files");
	let submitInput = insertImage.querySelector("#insertImage-submit");

	filesInput.addEventListener('change', handleFileSelect, false);
	function handleFileSelect(event) {
		let files = event.target.files; // FileList object
		let output = [];
		for (let i = 0, f; f = files[i]; i++) {
			output.push(escape(f.name));
		}
		if (files != null || files != undefined || output.length > 0) {
			submitInput.click();
		}
		console.log(output);

	}

	filesInput.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(filesInput.action, {
			method: 'POST',
			body: new FormData(filesInput)
		});
		if (response.ok) {
			alert("???????? ?????????????? ??????????????????.");
			window.location.replace("../admin.php");
		}
		else {
			alert("Request error");
		}
	});
	
	insertButton.addEventListener("click", (event) => {
		filesInput.click();
		event.stopPropagation();
	});
}

let outputForms = document.querySelectorAll(".outputForm");
for (const outputForm of outputForms) {
	outputForm.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(outputForm.action, {
			method: 'POST',
			body: new FormData(outputForm)
		});
		if (response.ok) {
			alert("???????????? ?????????????? ??????????????????.");
			window.location.replace("../admin.php");
		}
		else {
			alert("Request error");
		}
	});
}

let tabContentForms = document.querySelectorAll(".tab-content > form");
for (const tabContentForm of tabContentForms) {
	tabContentForm.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(tabContentForm.action, {
			method: 'POST',
			body: new FormData(tabContentForm)
		});
		if (response.ok) {
			alert("???????????? ?????????????? ??????????????????.");
			window.location.replace("../admin.php");
		}
		else {
			alert("Request error");
		}
	});
}

let updateClientDiscountForms = document.querySelectorAll(".clientForm");
for (let i = 0; i < updateClientDiscountForms.length; i++) {
	updateClientDiscountForms[i].addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch('../update_client_discount_script.php', {
			method: 'POST',
			body: new FormData(updateClientDiscountForms[i])
		});
		if (response.ok) {
			alert("???????????? ?????????????? ???????????? ?????????????? ??????????????????");
			window.location.replace("../admin.php");
		}
		else {
			alert("Request error");
		}
	});
}

let orderLinkWrappedButtonsArray = document.querySelectorAll(".order__entryes-link > button");
for (const button of orderLinkWrappedButtonsArray) {
	button.addEventListener("click", (event) => {
		event.preventDefault();
		button.closest("a").click();
	});
	button.form.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(button.form.action, {
			method: 'POST',
			body: new FormData(button.form)
		});
		if (response.ok) {
			alert("???????????? ?????????????? ??????????????????");
			window.location.replace("../admin.php");
		}
		else {
			alert("Request error");
		}
	});
}

let cancelOrderButtonsArray = document.querySelectorAll('.cancel_order_btn');
for (const cancelOrderButton of cancelOrderButtonsArray) {
	cancelOrderButton.addEventListener("click", (event) => {
		event.preventDefault();
		event.stopPropagation();
		cancelOrderButton.form.action = "../cancel_order.php";
		cancelOrderButton.previousElementSibling.click();
	});
}

let ticketForms = document.querySelectorAll(".ticketForm");
for (const form of ticketForms) {
	form.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(form.action, {
			method: 'POST',
			body: new FormData(form)
		});
		let formAction = form.action.substring(form.action.lastIndexOf("/") + 1);
		if (response.ok) {
			if (formAction == "perform_ticket_script.php") {
				alert("???? ?????????????????? ?????????????????????????? ???? ???????????????????? ?????????????? ??????????????????.");
				window.location.replace("../admin.php");
			}
			else if (formAction == "close_ticket_script.php") {
				alert("?????????????????? ???????? ??????????????.");
			}
		}
		else {
			alert("Request error");
		}
	});
}

let exitForm = document.querySelector(".exit_form");
exitForm.addEventListener('submit', async (e) => {
	e.preventDefault();
	let response = await fetch(exitForm.action, {
		method: 'POST',
		body: new FormData(exitForm)
	});
	let formAction = exitForm.action.substring(exitForm.action.lastIndexOf("/") + 1);
	if (response.ok) {
		alert("???? ?????????????? ?????????? ???? ?????????????? ????????????.");
		window.location.replace("../index.php");
	}
	else {
		alert("Request error");
	}
});

let cords = ['scrollX','scrollY'];
// ?????????? ?????????????????? ???????????????????? ?? ???????????????????????? window.scrollX ?? window.scrollY ?????? scrollX ?? scrollY
window.addEventListener('unload', (e) => {
	cords.forEach(cord => localStorage[cord] = window[cord]);
});
// ???????????????????????? ???????????????? ?? scrollX ?? scrollY ???? localStorage (???????? 0,0 ???????? ?????? ?????? ???????????? ??????)
document.querySelector("#" + localStorage.getItem('openedTab')).click();
window.scroll(...cords.map(cord => localStorage[cord]));
