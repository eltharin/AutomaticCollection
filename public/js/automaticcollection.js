window.addEventListener("DOMContentLoaded", (event) => {
	document
		.querySelectorAll('.form-collection .addbtn')
		.forEach(element => {
			let btn = document.createElement('div');
			btn.innerHTML = element.closest('.form-collection').dataset.addbtn;
			btn = btn.firstChild;
			btn.dataset.collectionHolderClass = element.dataset.collectionHolderClass;
			btn.classList.add('add_sub_element');

			btn.onclick = (event) => {
				e = event.target;

				const collectionHolder = document.querySelector('#' + e.dataset.collectionHolderClass);
				if(collectionHolder.dataset.index == undefined)
				{
					collectionHolder.dataset.index = collectionHolder.children.length;
				}

				const item = document.createElement('div');

				item.innerHTML = collectionHolder
					.dataset
					.prototype
					.replace(
						/__label__/g,
						'__'
					)
					.replace(
						/__name__/g,
						collectionHolder.dataset.index
					);

				let delbtn = document.createElement('div');
				delbtn.innerHTML = btn.closest('.form-collection').dataset.delbtn;
				delbtn = delbtn.firstChild;

				delbtn.onclick = (e) => {
					e.target.parentNode.remove();
				};
				item.firstChild.append(delbtn);
				collectionHolder.appendChild(item.firstChild);

				collectionHolder.dataset.index++;
			};

			element.parentNode.replaceChild(btn, element);
		});

	document.querySelectorAll('.form-row-deletable > div').forEach((el) => {
		let btn = document.createElement('div');
		btn.innerHTML = el.closest('.form-collection').dataset.delbtn;
		btn = btn.firstChild;

		btn.onclick = (e) => {e.target.parentNode.remove();};
		el.append(btn);
	});
});