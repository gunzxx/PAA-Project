$(document).ready(()=>{
    $(".delete-btn").click(function(e){
        e.preventDefault();
        const id = $(this).attr("data-id");
        const token = getJWT();
        
        Swal.fire({
            text: "Hapus data?",
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            allowOutsideClick: false,
            confirmButtonColor: 'var(--r2)',
            cancelButtonColor: 'var(--b1)',
            customClass: {
                popup:'swal-wide',
            },
        }).then((result)=>{
            if(result.isConfirmed){
                $('.spinner-container').css('display','flex');
                $.ajax({
                    url: "/api/tourist",
                    method: 'delete',
                    data: {
                        id: id
                    },
                    headers:{
                        Authorization: token,
                    },
                    success: (e) => {
                        $(this).parents("tr").remove();
                        console.log(e);
                        window.location.reload();
                        Swal.fire({
                            text: e.message,
                            icon: 'success',
                            confirmButtonColor: 'var(--b1)',
                            customClass: {
                                popup: 'swal-wide',
                            },
                        })
                    },
                    error: (e) => {
                        Swal.fire({
                            text: e.responseJSON.message,
                            confirmButtonColor: 'var(--r2)',
                            customClass: {
                                popup: 'swal-wide',
                            },
                        }).then(() => {
                            window.location.reload();
                        })
                    },
                })
            }
        })
    })
})