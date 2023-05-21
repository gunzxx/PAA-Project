$(document).ready(()=>{
    const categoryTable = $("#data-table").DataTable();

    $("#form-modal-add").submit(function(e){
        e.preventDefault();
        $('.spinner-container').css('display','flex');
        const name = $(this).find("#name").val();

        $.ajax({
            url: '/api/category',
            method:'POST',
            data:{
                name:name,
            },
            headers:{
                Authorization: getJWT(),
            },
            success:(e)=>{
                $('.spinner-container').css('display','none');
                $(this).find("input").val("");
                Swal.fire({
                    text : e.message,
                    icon : 'success',
                    confirmButtonColor: 'var(--b1)',
                    customClass: {
                        popup:'swal-wide',
                    },
                })
                const category = e.category;
                categoryTable.row.add([`<td class="no">` + (categoryTable.rows().count()+1) +`.</td>`,category.name,`
                    <div class="action-table">
                        <button type="button" class="btn btn-edit" data-id="`+category.id+`"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-delete" data-id="`+category.id+`"><i class="bi bi-trash-fill"></i></button>
                    </div>
                `]).draw();
                $("#modal-add").find("modal-card").css('position','-5000');
                setTimeout(()=>{$("#modal-add").css('display','none')},300)
            },
            error:(e)=>{
                Swal.fire({
                    text : e.responseJSON.message,
                    confirmButtonColor: 'var(--r2)',
                    customClass: {
                        popup:'swal-wide',
                    },
                }).then(()=>{
                    window.location.reload();
                })
            },
        })
    });

    $("#data-table").on('click','.btn-delete',function(){
        const id = $(this).attr("data-id");
        console.log(id);
        // console.log($(this).parents('tr'));
        Swal.fire({
            text: "Hapus data?",
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            confirmButtonColor: 'var(--r2)',
            cancelButtonColor: 'var(--b1)',
            customClass: {
                popup:'swal-wide',
            },
        }).then((result)=>{
            if (result.isConfirmed){
                $.ajax({
                    url: '/api/category',
                    method: 'DELETE',
                    data: {
                        id: id,
                    },
                    headers: {
                        Authorization: getJWT(),
                    },
                    success: (e) => {
                        categoryTable.row($(this).parents("tr")).remove().draw();
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

    $(".btn-edit").click(function () {
        const name = $(this).parent().parent().siblings(".category-name").text();
        const id = $(this).attr("data-id");
        $("#modal-edit .input-category-name").val(name);
        $("#modal-edit .input-category-id").val(id);
        $("#modal-edit").css("display", 'flex');
        $("#modal-edit .modal-card").show(300).css("top", '100px');
    })

    $("#modal-edit .modal-bg").click(function () {
        $(this).parent().find('.modal-card').css("top", '-500px');
        $("#modal-edit input").val("");
        setTimeout(() => {
            $("#modal-edit").css("display", 'none');
        }, 300)
    })

    $("#form-modal-edit").submit(function (e) {
        e.preventDefault();
        $('.spinner-container').css('display', 'flex');
        const name = $(this).find(".input-category-name").val();
        const id = $(this).find(".input-category-id").val();
        console.log(name,id);

        $.ajax({
            url: '/api/category',
            method: 'PUT',
            data: {
                id: id,
                name: name,
            },
            headers: {
                Authorization: getJWT(),
            },
            success: (e) => {
                $('.spinner-container').css('display', 'none');
                $(this).find("input").val("");
                $("#modal-edit").find("modal-card").css('position', '-500');
                window.location.reload();
                setTimeout(() => { $("#modal-edit").css('display', 'none') }, 300);
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
    });
})