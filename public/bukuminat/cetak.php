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
	$pdf->Cell(20, 7, 'ID Buku', 1, 0, 'C');
	$pdf->Cell(120, 7, 'Judul Buku', 1, 0, 'C');
	$pdf->Cell(40, 7, 'Penulis', 1, 0, 'C');
	$pdf->Cell(25, 7, 'Total Dipinjam', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT p.buku_id_buku, b.judul, b.penulis, SUM(p.jumlah_buku) as total_pinjaman
                                FROM peminjaman_buku p
                                JOIN buku b ON p.buku_id_buku = b.id_buku
                                GROUP BY p.buku_id_buku, b.judul
                                ORDER BY total_pinjaman DESC");

	while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(20, 6, $d['buku_id_buku'], 1, 0, 'C');
		$pdf->Cell(120, 6, $d['judul'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['penulis'], 1, 0, 'C');
		$pdf->Cell(25, 6, $d['total_pinjaman'], 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>