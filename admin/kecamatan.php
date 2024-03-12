<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<?php echo"
<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>  $t[nama_kecamatan] TPS $t[no_tps]
                            </div>
                            <div class='panel-body'>
    <form id='form1'  method='post' action='input.php?aksi=inputsuarapaslontps'>
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
    <label>Pilih Paslon</label>
    <select class='form-control select2' style='width: 100%;' name=id_paslon>
    "; 
     $sql=mysqli_query($koneksi,"SELECT * FROM paslon ORDER BY id_paslon");
     while ($c=mysqli_fetch_array($sql))
     {
        echo "<option value=$c[id_paslon]>$c[nama_paslon]</option>";
     }
        echo "
    </select><br><br>
    <label>Nomor Tps</label>
    <input type='text' class='form-control' name='no_tps'/><br>
    <label>Suara Sah</label>
    <input type='number' class='form-control' name='suara_sah'/><br>
    <label>Suara tidak Sah</label>
    <input type='number' class='form-control' value='0' name='suara_rusak'/><br>
                                                
                                  
            
            <div class='modal-footer'>
                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                <button type='submit' class='btn btn-primary'>Save </button>
                                            </div> </div>
        </form></div> </div></div></div>";
?>
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