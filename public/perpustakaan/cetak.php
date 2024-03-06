<?php  
	include_once("../../config/koneksi.php");
	require("../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Buku Perpustakaan', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
	$pdf->Cell(70, 7, 'Judul Buku', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Penulis', 1, 0, 'C');
	$pdf->Cell(90, 7, 'Keterangan', 1, 0, 'C');
	$pdf->Cell(20, 7, 'Stok', 1, 0, 'C');
	$pdf->Cell(28, 7, 'ID Mata Pelajaran', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT * FROM buku ORDER BY id_buku ASC");

	while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(10, 6, $d['id_buku'], 1, 0, 'C');
		$pdf->Cell(70, 6, $d['judul'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['penulis'], 1, 0, 'C');
		$pdf->Cell(90, 6, $d['keterangan'], 1, 0, 'C');
		$pdf->Cell(20, 6, $d['stok'], 1, 0, 'C');
		$pdf->Cell(28, 6, $d['matapelajaran_idpelajaran'], 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>