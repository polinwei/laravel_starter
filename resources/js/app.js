/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

// <!-- Vendor JS Files from NPM -->
import {DataTable} from 'simple-datatables'
const myTable = document.querySelector(".datatable");
const dataTable = new DataTable(myTable);


// <!-- Vendor JS Files -->
import '../NiceAdmin/vendor/apexcharts/apexcharts.min.js'
import '../NiceAdmin/vendor/php-email-form/validate.js'

/** Vendor JS Files  */
// import '../NiceAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js'  // 會衝突以 php artisan ui vue 的套件為主
// import '../NiceAdmin/vendor/chart.js/chart.umd.js'
// import '../NiceAdmin/vendor/echarts/echarts.min.js'
// import '../NiceAdmin/vendor/quill/quill.min.js'
// import '../NiceAdmin/vendor/tinymce/tinymce.min.js'



// <!-- Template Main JS File -->
import '../NiceAdmin/js/main.js'

// Vue JS File
import './main.js'

