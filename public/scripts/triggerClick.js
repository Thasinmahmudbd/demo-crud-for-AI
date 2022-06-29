
function add_more_fields() {
	html='<div class="disGrid">\
				<label for="sku">SKU</label>\
				<input class="p_0_h fSize_1 m_0 cusInp content--w" type="text" name="sku[]">\
			</div>\
			<div class="disGrid">\
				<label for="size">Size</label>\
				<input class="p_0_h fSize_1 m_0 cusInp" type="text" name="size[]">\
			</div>\
			<div class="disGrid">\
				<label for="quantity">Quantity</label>\
				<input class="p_0_h fSize_1 m_0 cusInp" type="number" name="quantity[]">\
			</div>\
			<div class="disGrid">\
				<label for="price">Price</label>\
				<input class="p_0_h fSize_1 m_0 cusInp" type="number" name="price[]">\
			</div>'

	var form = document.getElementById('attributes')
	form.innerHTML+=html;
}

