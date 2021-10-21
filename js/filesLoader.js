if (window.File && window.FileReader && window.FileList && window.Blob) {
	function handleFileSelect(event) {
		let files = event.target.files; // FileList object
	
		// files is a FileList of File objects. List some properties.
		let output = [];
		for (let i = 0, f; f = files[i]; i++) {
		  	output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
					  f.size, ' bytes, last modified: ',
					  f.lastModifiedDate.toLocaleDateString(), '</li>');
		}
		document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
	}
} 
else {
	alert('The File APIs are not fully supported in this browser.');
}