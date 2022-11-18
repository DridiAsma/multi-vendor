<!-- Javascript -->
<script src="{{asset('back/assets/bundles/libscripts.bundle.js')}}"></script>
<script src="{{asset('back/assets/bundles/vendorscripts.bundle.js')}}"></script>

<script src="{{asset('back/assets/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{asset('back/assets/bundles/morrisscripts.bundle.js')}}"></script>
<script src="{{asset('back/assets/bundles/knob.bundle.js')}}"></script>
<script src="{{asset('back/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('back/assets/js/pages/ui/sortable-nestable.js')}}"></script>
<script src="{{asset('back/assets/js/index.js')}}"></script>
<script src="{{asset('back/assets/vendor/switch-button-bootstrap/src/bootstrap-switch-button.js')}}"></script>
{{--  summer  --}}
<script src="{{asset('back/summernotes/summernote.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('back/assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('back/assets/js/pages/tables/jquery-datatable.js')}}"></script>

@yield('scripts')

<script> 
    setTimeout(function () {
        $('#alert').slideUp();
    },4888);
</script>