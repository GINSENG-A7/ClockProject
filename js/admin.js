
let tablinks = document.getElementsByClassName("tab-links");
for (let i = 0; i < tablinks.length; i++) {
	tablinks[i].addEventListener("click", () => {
		openTab(event, tablinks[i].outerText);

		let bodyTextAreas = document.querySelectorAll(".wrapper-body");
		for (let i = 0; i < bodyTextAreas.length; i++) {
			let bTA = bodyTextAreas[i];
			 console.log(bTA.scrollHeight);
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
	pictureForm = picturesForms[i];
	let xButton = pictureForm.querySelector("#X-button");
	let submitInput = pictureForm.querySelector("#X-submit");

	xButton.addEventListener("click", () => {
		submitInput.click();
	});
}

let  insertImageForms = document.querySelectorAll("form.insertImageForm");
for (let i = 0; i < insertImageForms.length; i++) {
	insertImage = insertImageForms[i];
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


	
	insertButton.addEventListener("click", (event) => {
		filesInput.click();
		event.stopPropagation();
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
			alert("Данные учётной записи успешно обновлены");
		}
		else {
			alert("Request error");
		}
	});
}
