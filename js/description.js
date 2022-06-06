// let toCartSubmit = document.querySelector('.alreadyInCart');
// toCartSubmit.addEventListener("load", (e)=> {
// 	e.preventDefault();
// });
let addToCartFormsArray = document.querySelectorAll("#addToCartForm");
for (const addToCartForm of addToCartFormsArray) {
	addToCartForm.addEventListener('submit', async (event) => {
		event.preventDefault();
		let response = await fetch(addToCartForm.action, {
			method: 'POST',
			body: new FormData(addToCartForm)
		});
		if (response.ok) {
			// alert("Товар добавлен в корзину.");
			window.location.reload();
		}
		else {
			alert("Request error");
		}
	});
}

let newCommentFormsArray = document.querySelectorAll(".newComment-form");
for (const newCommentForm of newCommentFormsArray) {
	newCommentForm.addEventListener('submit', async (event) => {
		event.preventDefault();
		let response = await fetch(newCommentForm.action, {
			method: 'POST',
			body: new FormData(newCommentForm)
		});
		if (response.ok) {
			alert("Комментарий успешно добавлен.");
			window.location.reload();
		}
		else {
			alert("Request error");
		}
	});
}

let deleteCommentFormsArray = document.querySelectorAll(".comment__deleteForm");
for (const deleteCommentForm of deleteCommentFormsArray) {
	deleteCommentForm.addEventListener('submit', async (event) => {
		event.preventDefault();
		let response = await fetch(deleteCommentForm.action, {
			method: 'POST',
			body: new FormData(deleteCommentForm)
		});
		if (response.ok) {
			alert("Комментарий успешно удалён.");
			window.location.reload();
		}
		else {
			alert("Request error");
		}
	});
}

let cords = ['scrollX','scrollY'];
// Перед закрытием записываем в локалсторадж window.scrollX и window.scrollY как scrollX и scrollY
window.addEventListener('unload', e => cords.forEach(cord => localStorage[cord] = window[cord]));
// Прокручиваем страницу к scrollX и scrollY из localStorage (либо 0,0 если там еще ничего нет)
window.scroll(...cords.map(cord => localStorage[cord]));