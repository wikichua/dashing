import './bootstrap';

// Global
import "./modules/bootstrap";
import "./modules/theme";
import "./modules/feather";
import "./modules/moment";
import "./modules/sidebar";

// Charts
// import "./modules/chartjs";

// Maps
import "./modules/vector-maps";

window.daterangepicker = require('bootstrap-daterangepicker');

import swal from 'sweetalert2';
const Swal = window.Swal = swal;
const Toast = window.Toast = Swal.mixin({
  toast: true,
  position: 'bottom-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

// const CodeMirror = window.CodeMirror = require('codemirror/src/codemirror');
const SimpleMDE = window.SimpleMDE = require('simplemde/dist/simplemde.min');
require('summernote/dist/summernote');
require('gijgo/js/gijgo');
require('bootstrap-table');
require('bootstrap-table/dist/extensions/resizable/bootstrap-table-resizable');
require('bootstrap-table/dist/extensions/reorder-rows/bootstrap-table-reorder-rows');
const TomSelect = window.TomSelect = require('tom-select');
