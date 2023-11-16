<script>
    const Toast = swal.mixin({
        toast: true,
        position: 'top-right',
        iconColor: 'white',
        customClass: {
            popup: 'colored-toast'
        },
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    })
    Toast.fire({
        icon: '{{ $type }}',
        title: '{{ $message }}'
    })
</script>
