<input type="hidden" value="{{ $message }}" id="session-message">
<script>
    Swal.fire({
        text : $("#session-message").val(),
        icon :'error',
        confirmButtonColor: 'var(--r2)',
        customClass: {
            popup:'swal-wide',
        },
    })
</script>