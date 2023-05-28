function getAll() {
    const cookieString =  document.cookie;
    var cookies = cookieString.split(';');

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split('=');
        console.log(cookie);
    }
    
}

function getCookie(cookieName) {
    var cookieString = document.cookie;
    var cookies = cookieString.split(';');

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split('=');
        if (cookie[0].trim() === cookieName) {
            return cookie[1];
        }
    }
    // jika tidak ditemukan
    return null;
}

function deleteCookie(cookieName) {
    document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}


// JWT
function getJWT() {
    return "Bearer " + getCookie("jwt").trim();
}
function deleteJWT() {
    return deleteCookie("jwt");
}
$(document).ready(()=>{
    
    $(".logout").click(function (e) {
        e.preventDefault();
        const token = getJWT();

        Swal.fire({
            text: "Logout?",
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            confirmButtonColor: 'var(--r1)',
            cancelButtonColor: 'var(--b2)',
            customClass: {
                popup:'swal-wide',
            },
        }).then((result)=>{
            if(result.isConfirmed){
                $('.spinner-container').css('display','flex');

                $.ajax({
                    method: "POST",
                    url: '/api/auth/logout',
                    dataType: 'json',
                    headers: {
                        Authorization: token,
                    },
                    success: (e) => {
                        deleteJWT();
                        window.location.href = '/admin/logout';
                        Swal.fire({
                            text : e.message,
                            icon : 'success',
                            confirmButtonColor: 'var(--b1)',
                            customClass: {
                                popup:'swal-wide',
                            },
                        })
                    },
                    error: (e) => {
                        window.location.href = '/admin/logout';
                        console.log(e);
                        Swal.fire({
                            text : e.responseJSON.message,
                            confirmButtonColor: 'var(--r2)',
                            customClass: {
                                popup:'swal-wide',
                            },
                        })
                    },
                });
            }
        })
    })
})