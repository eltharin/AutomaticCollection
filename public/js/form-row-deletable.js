window.addEventListener("DOMContentLoaded", (event) => {
	console.log("DOM entièrement chargé et analysé");

	document.querySelectorAll('.form-row-deletable > div.form-row').forEach((el) => {
		console.log(el);

		let btn = document.createElement('span');
		btn.innerHTML = 'suppr';
		btn.onclick = (e) => {
			console.log(e);
			console.log(e.target);
			e.target.parentNode.remove();
		};
		el.append(btn);
	});
});