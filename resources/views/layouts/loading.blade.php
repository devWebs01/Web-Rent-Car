<div id="loading"
    style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 9999;">
    <div class="text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

@push("scripts")
    <script>
        // Tampilkan elemen loading
        function showLoading() {
            document.getElementById('loading').style.display = 'block';
        }

        // Sembunyikan elemen loading
        function hideLoading() {
            document.getElementById('loading').style.display = 'none';
        }

        // Tambahkan event listener pada link
        document.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function(event) {
                showLoading();
            });
        });

        // Sembunyikan elemen loading setelah halaman selesai dimuat
        window.addEventListener('load', function() {
            hideLoading();
        });

        // Untuk navigasi dengan AJAX, tambahkan event listener untuk AJAX events (misalnya dengan jQuery)
        // $(document).ajaxStart(function() {
        //     showLoading();
        // }).ajaxStop(function() {
        //     hideLoading();
        // });
    </script>
@endpush
