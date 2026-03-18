<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Belanja Mudah & Aman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm py-4">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <h1 class="font-bold text-2xl text-blue-600">TokoKita.</h1>
            <div>
                <a href="/login" class="text-gray-600 hover:text-blue-600 font-medium mr-4">Masuk</a>
                <a href="/register"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">Daftar</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center text-center px-4 py-20">
        <div class="max-w-3xl">
            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold mb-6 inline-block">✨
                Selamat Datang di Toko Kami</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Temukan Kebutuhan Anda dengan <span class="text-blue-600">Harga Terbaik</span>
            </h2>
            <p class="text-lg text-gray-600 mb-10">
                Kami menyediakan berbagai produk berkualitas dengan sistem pembayaran yang aman, mudah, dan transparan.
                Belanja sekarang dan nikmati kemudahannya.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/product"
                    class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-blue-700 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    🛍️ Mulai Belanja
                </a>
                <a href="#fitur"
                    class="bg-white text-gray-700 border border-gray-300 px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-50 transition">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </main>
    <section id="fitur" class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kenapa Belanja di TokoKita?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami berkomitmen memberikan pengalaman belanja terbaik dengan
                    sistem yang transparan dan mudah digunakan.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-2xl text-center hover:shadow-lg transition">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl">🛍️</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Produk Berkualitas</h3>
                    <p class="text-gray-600">Katalog produk yang selalu *up-to-date* dengan stok yang terjamin
                        akurasinya.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-2xl text-center hover:shadow-lg transition">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl">💳</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pembayaran Aman</h3>
                    <p class="text-gray-600">Sistem verifikasi pembayaran manual memastikan setiap transaksi Anda
                        tercatat dengan aman.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-2xl text-center hover:shadow-lg transition">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl">🖨️</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Nota Otomatis (PDF)</h3>
                    <p class="text-gray-600">Dapatkan *invoice* atau nota pembelian digital secara otomatis setelah
                        pesanan dikonfirmasi.</p>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-white py-6 border-t border-gray-200 text-center text-gray-500 text-sm">
        <p>&copy; 2026 TokoKita. Dibuat dengan 💙 untuk portofolio.</p>
    </footer>

</body>

</html>