$(document).ready(()=> {
    $('.js-example-basic-single').select2();

    const current_thumb_img = document.querySelector("#preview-img").src;

    $("#thumb").change(function (event) {
        const [file] = event.target.files;

        if (file) {
            document.querySelector("#preview-img").src = URL.createObjectURL(file);
        }
        else {
            document.querySelector("#preview-img").src = current_thumb_img;
        }
    })

    document.getElementById("tourist_preview").addEventListener('change', function (e) {
        const files = e.target.files;

        if (files.length === 0) {
            const img = document.createElement('img');
            img.src = "/img/tourist/add.png";
            $("#preview-tourist-container").html('')
            $("#preview-tourist-container").append(img)
        }

        else{
            $("#preview-tourist-container").html("");
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
    
                reader.onload = function (event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
    
                    $("#preview-tourist-container").append(img);
                }
    
                reader.readAsDataURL(file);
            }
        }
    });

});