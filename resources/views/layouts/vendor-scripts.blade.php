<!-- JAVASCRIPT -->

<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/eva-icons/eva.min.js') }}"></script>


<!-- Toastr CSS -->

<!-- jQuery (Agar already include nahi hai) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        console.log("Document ready, checking session messages...");

        @if(Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            };
            toastr.error("{{ session('error') }}");
        @endif
    });
</script>

<style>
    /* Remove arrows/spinners from number input */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
        }
</style>
@yield('scripts')
