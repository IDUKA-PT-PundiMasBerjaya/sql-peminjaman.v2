<?php  
	include_once("../../config/koneksi.php");
	require("../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Peminjaman', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(30, 7, 'ID Peminjaman', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Nama Pengguna', 1, 0, 'C');
	$pdf->Cell(40, 7, 'Tanggal Pinjam', 1, 0, 'C');
	$pdf->Cell(40, 7, 'Tanggal Kembali', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT p.id_peminjaman, p.tanggal_pinjam, p.tanggal_kembali,
                                    CASE
                                        WHEN p.guru_idguru IS NOT NULL THEN g.nama
                                        WHEN p.siswa_idsiswa IS NOT NULL THEN s.nama
                                    END AS namapengguna
                                FROM peminjaman p
                                LEFT JOIN guru g ON p.guru_idguru = g.idguru
                                LEFT JOIN siswa s ON p.siswa_idsiswa = s.idsiswa
                                ORDER BY p.id_peminjaman ASC");

	while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(30, 6, $d['id_peminjaman'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['namapengguna'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['tanggal_pinjam'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['tanggal_kembali'], 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>