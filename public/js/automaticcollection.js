window.addEventListener("DOMContentLoaded", (event) => {
	document
		.querySelectorAll('.form-collection .automatic_collection_addBtn')
		.forEach(btn => {
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

				item.querySelector('.automatic_collection_delBtn').onclick = (e) => {
					e.target.parentNode.remove();
				};
				collectionHolder.appendChild(item.firstChild);

				collectionHolder.dataset.index++;
			};
		});

	document.querySelectorAll('.form-row-deletable .automatic_collection_delBtn').forEach((btn) => {
		btn.onclick = (e) => {e.target.parentNode.remove();};
	});
});
