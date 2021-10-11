let tablinks = document.getElementsByClassName("tab-links");
for (let i = 0; i < tablinks.length; i++) {
	tablinks[i].addEventListener("click", () => {
		openTab(event, tablinks[i].outerText)
	});
}

let tabcontent = document.getElementsByClassName("tab-content");
// for (let i = 0; i < tabcontent.length; i++) {
// 	tabcontent[i].addEventListener("click", () => {
// 		openTab(event, tabcontent[i].outerText);
// 	});
// }

function openTab(event, tabName) {
	for (let i = 0; i < tabcontent.length; i++) {
		if (tabcontent[i].id != tabName) {
			tabcontent[i].style.display = "none";
		} 
	}
  
	// Get all elements with class="tablinks" and remove the class "active"
	for (let i = 0; i < tablinks.length; i++) {
	  tablinks[i].className = tablinks[i].className.replace("active", "");
	}
  
	// Show the current tab, and add an "active" class to the button that opened the tab
	document.getElementById(tabName).style.display = "block";
	event.currentTarget.className += " active";
  }