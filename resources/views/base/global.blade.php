@include('base.parts.head')
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
@include('base.parts.navhead')
@include('base.parts.aside')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
@yield('content')    

</div>
<!-- /.content-wrapper -->
@include('base.parts.footer')