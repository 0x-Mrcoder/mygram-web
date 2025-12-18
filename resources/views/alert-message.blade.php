<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    @if(session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: @json(session()->get('success'))
        });
    @endif

    @if(session()->has('error'))
        Toast.fire({
            icon: 'error',
            title: @json(session()->get('error'))
        });
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            Toast.fire({
                icon: 'error',
                title: @json($error)
            });
        @endforeach
    @endif
</script>
