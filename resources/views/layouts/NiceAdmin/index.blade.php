<!DOCTYPE html>
<html lang="en">
  @include('layouts.NiceAdmin.header')
<body>
  <!-- ======= Header ======= -->
  @include('layouts.NiceAdmin.siteHeader')
  <!-- End Header -->
  
  <!-- ======= Sidebar ======= -->
  @include('layouts.NiceAdmin.siteSidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">
    <!-- Page Breadcrumb -->
    @include('layouts.NiceAdmin.siteBreadcrumb')
    <!-- End Page Breadcrumb -->

    <!-- Page Content -->
    @yield('pageContent')   

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('layouts.NiceAdmin.footer');
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @vite('resources/js/app.js')

</body>

</html>