## Cara Penggunaan

1. Daftar dan login ke aplikasi.
2. Pilih tryout yang ingin dikerjakan.
3. Kerjakan soal tryout yang tersedia.
4. **Jika sudah menyelesaikan tryout harus logout terlebih dahulu sebelum memulai lagi.**

## Instalasi

1. Clone repository ini:

    ```bash
    git clone https://github.com/aardnsyhs/tryout-app.git
    ```

2. Masuk ke direktori project:

    ```bash
    cd tryout-app
    ```

3. Install dependensi backend menggunakan Composer:

    ```bash
    composer install
    ```

4. Install dependensi frontend menggunakan npm:

    ```bash
    npm install
    ```

5. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database:

    ```bash
    cp .env.example .env
    ```

6. Generate aplikasi key:

    ```bash
    php artisan key:generate
    ```

7. Jalankan migrasi database:

    ```bash
    php artisan migrate
    ```

8. Jalankan aplikasi backend:

    ```bash
    php artisan serve
    ```

9. Jalankan development server frontend:

    ```bash
    npm run dev
    ```
