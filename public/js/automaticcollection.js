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

				const htmlToAdd = collectionHolder
					.dataset
					.prototype.replace(
						/__label__/g,
						'__'
					)
					.replace(
						/__name__/g,
						collectionHolder.dataset.index
					);

				if(collectionHolder.nodeName == 'TBODY')
				{
					collectionHolder.insertRow().outerHTML = htmlToAdd;
				}
				else
				{
					collectionHolder.append(htmlToAdd);
				}

				e.dispatchEvent(new CustomEvent('addLine', {"bubbles":true, "cancelable":false, 'detail':{'index' : collectionHolder.dataset.index}}));

				collectionHolder.dataset.index++;
			};
		});


		document.addEventListener('click', function(e) {
			for (var target = e.target; target && target != this; target = target.parentNode) {
				if (target.matches('.automatic_collection_delBtn')) {
					e.eventTarget = target;
					e.target.closest('.form-row').remove();
					break;
				}
			}
		}, false);
});
