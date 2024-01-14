<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-history"></i> Hasil Peramalan Penjualan</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Hasil Peramalan Penjualan</h4></div>
		<div class="col-6 text-right">
      		<a href="?page=entry_datapembelian">
				<button class="btn btn-sm btn-info">Form Pembelian</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<table id="tbl_riwayatperamalan" class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>No Peramalan</th>
					<th>Tanggal Peramalan</th>
					<th>Kode Obat</th>			
					<th>Nama Obat</th>
					<th>Metode Terbaik</th>
					<th>Hasil peramalann</th>
					<th>Periode Ramalan</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$no=1;
		
				$query_prm = "SELECT * FROM tbl_peramalan INNER JOIN tbl_obatramal ON tbl_peramalan.no_rml = tbl_obatramal.no_rml INNER JOIN tbl_dataobat ON tbl_obatramal.kd_obat = tbl_dataobat.kd_obat WHERE tbl_peramalan.tgl_rml <= date_add(CURDATE(), INTERVAL -30 DAY) ORDER BY tgl_rml ASC";

				$sql_prm = mysqli_query($conn, $query_prm) or die ($conn->error);
				while($data=mysqli_fetch_array($sql_prm)) {
			?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['no_rml']; ?></td>
						<td><?php echo $data['tgl_rml']; ?></td>
						<td><?php echo $data['kd_obat']; ?></td>
						<td><?php echo $data['nm_obat']; ?></td>
						<td><?php echo $data['mtd_terbaik']; ?></td>
						<td><?php echo round($data['hasil_rml']) . " " . $data['sat_obat']; ?></td>
						<td><?php echo $data['periode_rml']; ?></td>
						</td> 
						<td class="td-opsi">
							<button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihobat" name="tombol_pilihobat" data-dismiss="modal" method = "POST"
								data-kode="<?php echo $data['kd_obat']; ?>"
								data-nama="<?php echo $data['nm_obat']; ?>"
								data-harga="<?php echo $data['hrgbeli_obat']; ?>"
								data-satuan="<?php echo $data['sat_obat']; ?>"
                        	>
                            	Beli Obat
                        	</button>

                            <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-norml="<?php echo $data['no_rml']; ?>">
	                            <i class="fas fa-trash"></i>
	                        </button>
						</td>
					</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$("button[name='tombol_hapus']").click(function() {
		var no_rml = $(this).data("norml");
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus riwayat peramalan '+no_rml+', anda tidak dapat mengembalikan data yang telah dihapus.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Hapus'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=riwayat_peramalan",
              data: "id="+no_rml,
              success: function(hasil) {
                Swal.fire({
		          title: 'Berhasil',
		          text: 'Data Berhasil Dihapus',
		          type: 'success',
		          confirmButtonColor: '#3085d6',
		          confirmButtonText: 'OK'
		        }).then((ok) => {
		          if (ok.value) {
		            window.location='?page=riwayat_peramalan';
		          }
		        })
              }
            })  
          }
        })
	});

	$("button[name='tombol_pilihobat']").click(function() {
		// // window.location='?page=entry_datapembelian';
        // // document.getElementById("jml_obat").focus();
        // var kode = $(this).data("kode");
        // var nama = $(this).data("nama");
        // // var exp = $(this).data("expired");
        // var hrg = $(this).data("harga");
        // var satuan = $(this).data("satuan");

		// $.ajax({
		// 	type: "POST",
		// 	url: "pages/form_entrypembelian.php",
		// 	data: {
		// 		kode : kode,
		// 		nama: nama,
		// 		hrg: hrg,
		// 		satuan: satuan
		// 	},
		// 	success: function(response){
		// 		// $("#kode_obat").val(kode);
		// 		// $("#nm_obat").val(nama);
		// 		// // $("#tgl_exp").val(exp);
		// 		// $("#jml_obat").val(1);
		// 		// $("#hrg_obat").val(hrg);
		// 		// $("#toth_obat").val(hrg);
		// 		// $(".span_satuan").text(satuan);
				
		// 		// 	$("#tombil_pilihobat").submit();
		// 		// var form = document.getElementById("tombol_pilihobat");
		// 		// 		form.action = '?page=entry_datapembelian';
						
				
		// 		window.location='?page=entry_datapembelian';
		// 		console.log(document.getElementById("tombol_pilihobat"));
				
        //     },
		// 	error: function(xhr, status, error){
		// 		// window.location='?page=entry_datapembelian';
		// 		// console.log("masuk");
        //     }
		// })
		
				var kode = $(this).data('kode');
				window.location = '?page=entry_datapembelian2&kode=' + kode;


        // $("#kode_obat").val(kode);
        // $("#nm_obat").val(nama);
        // // $("#tgl_exp").val(exp);
        // $("#jml_obat").val(1);
        // $("#hrg_obat").val(hrg);
        // $("#toth_obat").val(hrg);
        // $(".span_satuan").text(satuan);

		// $("#tombil_pilihobat").submit();

    });

</script>