<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-capsules"></i> Stok Obat Kurang</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Stok Obat Kurang</h4></div>
		<div class="col-6 text-right">
      		<a href="?page=peramalan">
				<button class="btn btn-sm btn-info">Form Peramalan</button>
			</a>
		</div>
	</div>
	<div class="table-container">
		<table id="tbl_riwayatperamalan" class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Obat</th>
					<th>Nama Obat</th>
					<th>Kategori Obat</th>			
					<th>Satuan Obat</th>
					<!-- <th>Satuan Obat</th> -->
					<th>Stok Minimal Obat</th>
					<th>Stok Obat</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$no=1;
                $query_stok = "SELECT * FROM tbl_dataobat WHERE stk_obat<=minstk_obat";
				$sql_prm = mysqli_query($conn, $query_stok) or die ($conn->error);
				while($data=mysqli_fetch_array($sql_prm)) {
			?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data['kd_obat']; ?></td>
						<td><?php echo $data['nm_obat']; ?></td>
						<td><?php echo $data['ktg_obat']; ?></td>
						<td><?php echo $data['sat_obat']; ?></td>
                        <td><?php echo $data['minstk_obat']; ?></td>
                        <td><?php echo $data['stk_obat']; ?></td>
						
						<td class="td-opsi">
							<button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihobat" name="tombol_pilihobat" data-dismiss="modal" method = "POST"
                            data-kode="<?php echo $data['kd_obat']; ?>"
                            data-nama="<?php echo $data['nm_obat']; ?>"
                            data-harga="<?php echo $data['hrgbeli_obat']; ?>"
                            data-satuan="<?php echo $data['sat_obat']; ?>"
                        >
                            Forecast
                        	</button>

						</td>
					</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
    $("button[name='tombol_pilihobat']").click(function() {
        // var kode = $(this).data("kode");
        // // console.log(kode);
		// window.location='?page=peramalan2&kode=' + kode;
        window.location='?page=peramalan';
    });
</script>