const mobileMenuBtn = document.getElementById("mobile-menu-button");
if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", () => {
        const menu = document.getElementById("mobile-menu");
        if (menu) menu.classList.toggle("hidden");
    });
}

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('input[name="answer"]').forEach((radio) => {
        radio.addEventListener("change", async function () {
            const questionId =
                this.closest("form")?.dataset?.questionId ||
                this.dataset.questionId;
            const answerId = this.value;

            try {
                const response = await fetch(`/soal/jawab/${questionId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({ answer: answerId }),
                });

                if (!response.ok) {
                    alert("Gagal menyimpan jawaban.");
                }
            } catch (error) {
                alert("Terjadi kesalahan koneksi.");
            }
        });
    });

    const form = document.querySelector("#report-modal form");
    if (!form) {
        console.warn("Form dalam modal tidak ditemukan");
        return;
    }

    form.addEventListener("submit", function (e) {
        const textarea = form.querySelector('textarea[name="laporan"]');
        if (!textarea || !textarea.value.trim()) {
            e.preventDefault();
            window.dispatchSweetAlert("error", "Keterangan wajib diisi!");
            return false;
        }
    });
});
