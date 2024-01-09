function previewImage(inputId, preview) {
    var input = document.getElementById(inputId);
    var imgPreview = document.getElementById(preview);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            imgPreview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}