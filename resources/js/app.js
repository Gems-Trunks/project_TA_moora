// 🔥 ADMIN LTE
import './bootstrap';

// 🔥 SWEETALERT
import Swal from 'sweetalert2';
window.Swal = Swal;

// 🔥 ADMIN LTE (Hanya import JS-nya saja di sini)
import 'admin-lte/dist/js/adminlte.min.js';
// Tambahkan log ini untuk memastikan script berjalan
console.log('Vite JS loaded, Swal is:', typeof window.Swal);
import 'sweetalert2/dist/sweetalert2.min.css';