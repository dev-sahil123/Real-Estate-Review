<script src="{{ asset('js/app.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3rjPMzkRV9c9Gd6yY01gA1_OZ0_ho9t4&libraries=places&region=australia"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script type="text/javascript"> 
    @if(session('success'))
        showToast('success', '{{ session('success') }}');
    @elseif(session('error'))
        showToast('error', '{{ session('error') }}');
    @elseif(session('warning'))
        showToast('warning', '{{ session('warning') }}');
    @elseif(session('info'))
        showToast('info', '{{ session('info') }}');
    @elseif(session('question'))
        showToast('question', '{{ session('question') }}');
    @endif
</script>
@yield('scripts')