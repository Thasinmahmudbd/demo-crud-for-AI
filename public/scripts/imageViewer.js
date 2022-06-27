function displayImage(e) {
	if (e.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e){
			document.querySelector('.placeholder_image').setAttribute('src', e.target.result);
		}

		reader.readAsDataURL(e.files[0]);
	}
}

function displayImage2(e) {
	if (e.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e){
			document.querySelector('.placeholder_image2').setAttribute('src', e.target.result);
		}

		reader.readAsDataURL(e.files[0]);
	}
}