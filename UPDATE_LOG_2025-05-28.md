# Dokumentasi Update Fitur Cart & Produk - 28 Mei 2025

## 1. Fitur Filter & Sorting Produk
- Menambahkan filter kategori dan sorting (termurah, termahal, terbaru) pada halaman produk.
- Filter dan sorting menggunakan form GET, diproses di controller `ProdukController@index`.
- User dapat memilih kategori dan urutan, lalu klik "Terapkan" untuk melihat hasil filter/sorting.

## 2. Fitur Update Ukuran Cart
- Pada halaman cart, tombol "Update Ukuran" ditambahkan di kolom aksi setiap item.
- Jika tombol diklik, user diarahkan ke halaman baru (`cart/update-page/{itemId}`) untuk memilih ukuran (S, M, L, XL).
- Setelah memilih ukuran dan submit, perubahan disimpan dan user kembali ke halaman cart.
- Route baru: `Route::get('/cart/update-page/{itemId}', [CartController::class, 'updatePage'])`.
- Method baru di `CartController`: `updatePage($itemId)` untuk menampilkan form update ukuran.
- Method `update($itemId)` di `CartController` kini juga menangani update ukuran selain jumlah.

## 3. Perubahan pada Halaman Cart
- Kolom aksi pada cart kini hanya berisi tombol hapus dan tombol update ukuran.
- Input jumlah di kolom aksi dihapus, update jumlah tetap dilakukan lewat tombol +/- di kolom jumlah.

## 4. Penghapusan Fitur Invoice PDF
- Semua logic, route, dan tampilan terkait invoice PDF dihapus dari project.

---

**Catatan:**
- Semua perubahan sudah terintegrasi dengan autentikasi (hanya user login yang bisa akses cart).
- Pastikan validasi ukuran dan jumlah tetap berjalan di backend.
- Jika ingin menambah ukuran lain, edit juga view dan validasi di controller.
