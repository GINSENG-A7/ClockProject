let tablinks = document.getElementsByClassName("tab-links");
for (let i = 0; i < tablinks.length; i++) {
	tablinks[i].addEventListener("click", () => {
		openTab(event, tablinks[i].outerText);

		localStorage.setItem(tablinks[i].id, 1);

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
			window.location.replace("../super_admin.php");
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
			window.location.replace("../super_admin.php");
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
			window.location.replace("../super_admin.php");
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
			window.location.replace("../super_admin.php");
		}
		else {
			alert("Request error");
		}
	});
}

let sizeFormsArray = document.querySelectorAll(".sizeEditForm");
for (const sizeForm of sizeFormsArray) {
	sizeForm.addEventListener('submit', async (e) => {
		e.preventDefault();
		let response = await fetch(sizeForm.action, {
			method: 'POST',
			body: new FormData(sizeForm)
		});
		if (response.ok) {
			alert("???????????? ???????????? ???? ??????????????");
			window.location.replace("../super_admin.php");
		}
		else {
			alert("Request error");
		}
	});

	let submitInput = sizeForm.querySelector(".sizeForm-disable");
	let deleteButton = sizeForm.querySelector(".sizeForm-delete");
	deleteButton.addEventListener("click", (event) => {
		event.preventDefault();
		event.stopImmediatePropagation();
		if (confirm("???? ??????????????, ?????? ???????????? ?????????????????? ?????????????? ???????????? ?????????????")) {
			if (submitInput.name == "disableSize") {
				submitInput.name = "ableSize";
				submitInput.value = "??????????????";
			}
			else if (submitInput.name == "ableSize") {
				submitInput.name = "disableSize";
				submitInput.value = "????????????";
			}
			submitInput.form.action = "./delete_size_script.php";
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
			// window.location.replace("../index.php");
			alert("?????????????? ???????????? ?????????????? ??????????????");
			window.location.replace("../super_admin.php");
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
		if (confirm("???? ??????????????, ?????? ???????????? ?????????????????? ?????????????? ?????? ???????????? ?????????????????????????")) {
			clientForm.action = "./delete_user_script.php";
			submitInput.click();
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


