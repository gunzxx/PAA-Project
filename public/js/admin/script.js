$(document).ready(()=>{
    $("#modal-btn-add").click(function(){
        $("#modal-add").css("display",'flex')
        $("#modal-add .modal-card").show(300).css("top",'100px');
    })

    $("#modal-add .modal-bg").click(function(){
        $(this).parent().find('.modal-card').css("top",'-500px');
        $("#modal-add input").val("");
        setTimeout(()=>{
            $("#modal-add").css("display",'none');
        },300)
    })
})