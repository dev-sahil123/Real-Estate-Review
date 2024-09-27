<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
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