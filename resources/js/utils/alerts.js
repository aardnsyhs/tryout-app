import Swal from 'sweetalert2';

export function showSuccess(message = 'Berhasil!') {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: message,
        confirmButtonColor: '#4F46E5',
    });
}

export function showError(message = 'Terjadi kesalahan!') {
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: message,
        confirmButtonColor: '#d33',
    });
}
