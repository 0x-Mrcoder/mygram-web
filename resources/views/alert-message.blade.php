<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Custom iOS Alert Styling */
    div:where(.swal2-container).swal2-backdrop-show, div:where(.swal2-container).swal2-noanimation {
        background: rgba(0,0,0,0.4) !important;
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
    }
    .swal2-popup.ios-modal {
        border-radius: 20px !important;
        font-family: 'Inter', sans-serif;
        padding: 24px !important;
        background: #161B2D !important;
        border: 1px solid rgba(255,255,255,0.1) !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.5) !important;
        width: 320px !important;
    }
    .swal2-title {
        font-size: 19px !important;
        font-weight: 700 !important;
        color: #fff !important;
        margin-bottom: 8px !important;
    }
    .swal2-html-container {
        font-size: 15px !important;
        color: #A0AEC0 !important;
        margin: 0 !important;
        line-height: 1.4 !important;
    }
    .swal2-confirm.ios-btn {
        background-color: #F1C40F !important;
        color: #000 !important;
        border-radius: 14px !important;
        font-weight: 600 !important;
        font-size: 17px !important;
        padding: 14px 0 !important;
        width: 100% !important;
        margin: 20px 0 0 !important;
        box-shadow: none !important;
    }
    .swal2-confirm.ios-btn:active {
        background-color: #D4AF37 !important;
    }
    
    /* Clean up default icons */
    .swal2-icon {
        border-color: transparent !important; 
        margin: 0 auto 15px !important;
        width: 3em !important;
        height: 3em !important;
    }
    .swal2-icon.swal2-error {
        color: #FF3B30 !important;
    }
    .swal2-icon.swal2-success {
        color: #F1C40F !important;
    }
    .swal2-icon.swal2-success [class^=swal2-success-line] {
        background-color: #F1C40F !important;
    }
    .swal2-icon.swal2-error [class^=swal2-x-mark-line] {
        background-color: #FF3B30 !important;
    }
</style>
<script>
    const iOSAlert = Swal.mixin({
        customClass: {
            popup: 'ios-modal',
            confirmButton: 'ios-btn'
        },
        buttonsStyling: false,
        showConfirmButton: true,
        confirmButtonText: 'OK',
        position: 'center',
        backdrop: true,
        allowOutsideClick: false
    });

    @if(session()->has('success'))
        iOSAlert.fire({
            icon: 'success',
            title: 'Success',
            text: @json(session()->get('success'))
        });
    @endif

    @if(session()->has('error'))
        iOSAlert.fire({
            icon: 'error',
            title: 'Error',
            text: @json(session()->get('error'))
        });
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            iOSAlert.fire({
                icon: 'error',
                title: 'Error',
                text: @json($error)
            });
        @endforeach
    @endif
</script>
