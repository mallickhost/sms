
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Software Version</b> {{ App::VERSION() }}
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a target='blank' href="#">Shubhrajyoti Mallick</a>.</strong> All rights
    reserved.
</footer>

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>



<!-- jquery-validation -->
<script src="{{asset('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>


<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>



<!-- AdminLTE App -->
<script src="{{asset('assets/js/adminlte.min.js')}}"></script>


<!-- AdminLTE for demo purposes -->
<!-- <script src="{{asset('assets/js/demo.js')}}"></script> -->
@yield('scripts')
