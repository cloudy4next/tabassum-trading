
<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        const Toast = swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: getBackgroundColor('{{ $type }}'),
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            showCloseButton: true
        });
        function getBackgroundColor(type) {
            switch (type) {
                case 'success':
                    return '#28a745'; // Green for success
                case 'error':
                    return '#dc3545'; // Red for error
                case 'warning':
                    return '#ffc107'; // Yellow for warning
                default:
                    return '#007bff'; // Blue for default or other types
            }
        }


        Toast.fire({
            icon: '{{ $type }}',
            title: '{{ $message }}',
        });
    });
</script>
