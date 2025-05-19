import Swal from 'sweetalert2';

export function showSuccess(message = 'Berhasil!') {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: message,
        confirmButtonColor: '#3085d6',
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
