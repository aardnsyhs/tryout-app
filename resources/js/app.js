import './bootstrap';

document.querySelectorAll('.auto-save').forEach(radio => {
    radio.addEventListener('change', async function () {
        const questionId = this.dataset.questionId;
        const answerId = this.value;

        await fetch(`/soal/jawab/${questionId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                answer: answerId
            })
        }).then(res => {
            if (!res.ok) {
                alert('Gagal menyimpan jawaban.');
            }
        }).catch(() => {
            alert('Terjadi kesalahan koneksi.');
        });
    });
});
