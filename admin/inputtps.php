<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class='row'>
                    <div class='col-lg-12'>
                                         
                                         <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                        <h4 class='modal-title' id='H3'>Input Data</h4>
                                                    </div>
                                                <div class='modal-body'>
                                                    <form role='form' method='post' action='input.php?aksi=inputtps'>
                                                        <div class='form-group'>
                                                        <label>Pilih kecamatan</label>
                                                        <select class='form-control select2' style='width: 100%;' id='kecamatan' name='id_kecamatan'>
                                                            <!-- Opsi Kecamatan akan diisi dari database -->
                                                        </select><br><br>
                                                        <label>Pilih desa/Keluarahan</label>
                                                        <select id='desa' class='form-control select2' style='width: 100%;' name='id_desa'>
                                                             <!-- Opsi Desa akan diisi setelah memilih Kecamatan -->
                                                        </select>
                                                         <br><br>
                                                        <label>no tps</label>
                                                        <input type='text' class='form-control' name='no_tps'/><br>
                                                      
                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Save </button>
                                                        </div>
                                                   </form>
                                                </div>
                                         </div>
                                      
                        </div>	
</div>		
   <script>
        // Fungsi untuk mengisi opsi Kecamatan
        function populateKecamatan() {
            // Lakukan permintaan AJAX untuk mendapatkan data kecamatan dari server
            $.ajax({
                url: 'get_kecamatan.php', // Ganti dengan nama file yang sesuai di server
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Isi opsi kecamatan dengan data yang diterima
                    var kecamatanSelect = $('#kecamatan');
                    kecamatanSelect.empty();
                    $.each(data, function(index, kecamatan) {
                        kecamatanSelect.append('<option value="' + kecamatan.id_kecamatan + '">' + kecamatan.nama_kecamatan + '</option>');
                    });

                    // Panggil fungsi untuk mengisi opsi Desa setelah memilih Kecamatan pertama
                    populateDesa();
                },
                error: function() {
                    alert('Gagal memuat data kecamatan.');
                }
            });
        }

        // Fungsi untuk mengisi opsi Desa
        function populateDesa() {
            var selectedKecamatan = $('#kecamatan').val();

            // Lakukan permintaan AJAX untuk mendapatkan data desa berdasarkan kecamatan
            $.ajax({
                url: 'get_desa.php', // Ganti dengan nama file yang sesuai di server
                method: 'GET',
                data: { kecamatan_id: selectedKecamatan },
                dataType: 'json',
                success: function(data) {
                    // Isi opsi desa dengan data yang diterima
                    var desaSelect = $('#desa');
                    desaSelect.empty();
                    $.each(data, function(index, desa) {
                        desaSelect.append('<option value="' + desa.id_desa + '">' + desa.nama_desa + '</option>');
                    });
                },
                error: function() {
                    alert('Gagal memuat data desa.');
                }
            });
        }

        // Panggil fungsi untuk mengisi opsi Kecamatan saat halaman dimuat
        $(document).ready(function() {
            populateKecamatan();

            // Tambahkan event listener untuk memanggil fungsi mengisi opsi Desa saat Kecamatan berubah
            $('#kecamatan').change(function() {
                populateDesa();
            });
        });
    </script>