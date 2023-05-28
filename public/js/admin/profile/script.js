$('.spinner-container').css('display','flex');
$(document).ready(()=>{
    var latitude,longitude;

    if (navigator.geolocation) {
        $('.spinner-container').css('display','none');
        navigator.geolocation.getCurrentPosition(getLocation);
    } else {
        window.location.href = '/admin/tourist';
        Swal.fire({
            text : "GPS tidak diizinkan",
            confirmButtonColor: 'var(--r2)',
            customClass: {
                popup:'swal-wide',
            },
        }).then(()=>{
            window.location.href = '/admin/tourist';
        })
    }

    function getLocation(position) {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;

        console.log("Latitude: " + latitude);
        console.log("Longitude: " + longitude);

        $("#latitude").val(latitude);
        $("#longitude").val(longitude);
    }

    const current_inv_img = document.querySelector("#preview-img").src;
    
    $("#profile-img").change(function(event){
        const [file] = event.target.files;

        if (file) {
            document.querySelector("#preview-img").src = URL.createObjectURL(file);
        }
        else {
            document.querySelector("#preview-img").src = current_inv_img;
        }
    })

})