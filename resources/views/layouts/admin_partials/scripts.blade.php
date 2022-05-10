<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script src="//unpkg.com/alpinejs" defer></script>

<!-- Sweet-Alert  -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Sweet Alert
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    @if(session()->get('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
    @elseif (session()->get('error'))
        Toast.fire({
            icon: 'error',
            title: '{{ session()->get('error') }}'
        })
    @endif

    // Validation errors alert
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            Toast.fire({
                icon: 'error',
                title: '{{ $error }}'
            })
        @endforeach
    @endif

    function makeDeleteRequest(
        event,
        id,
        titleTxt = "Are you sure?",
        textMsg = "You won't be able to revert this!"
    ) {
        event.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success mb-2",
                cancelButton: "btn btn-danger me-2 mb-2",
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons
            .fire({
                icon: "warning",
                title: titleTxt,
                text: textMsg,
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete",
                cancelButtonText: "No",
                reverseButtons: true,
            })
            .then((result) => {
                console.log(id);
                if (result.value) {
                    let form_id = $("#delete-form-" + id);
                    $(form_id).submit();
                }
            });
    }
</script>


@stack('scripts')
