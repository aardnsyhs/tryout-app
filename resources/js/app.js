import './bootstrap';
import Swal from 'sweetalert2';
import { showSuccess, showError } from './utils/alerts.js';

window.dispatchSweetAlert = function (type, message) {
    if (type === 'success') showSuccess(message);
    if (type === 'error') showError(message);
};

window.Swal = Swal;

const alertDiv = document.getElementById('alert-message');
const type = alertDiv?.dataset.type;
const message = alertDiv?.dataset.message;

if (type && message) {
    window.dispatchSweetAlert(type, message);
}
