<input type="hidden" value="{{ $message }}" id="session-message">
<script>
    Swal.fire({
        text : $("#session-message").val(),
        icon : 'success',
        confirmButtonColor: 'var(--b1)',
        customClass: {
            popup:'swal-wide',
        },
    })
</script>