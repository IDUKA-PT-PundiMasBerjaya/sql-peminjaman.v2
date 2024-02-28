<?php 
    include_once("../../config/koneksi.php");
    require("../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Guru', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(10, 7, 'No', 1, 0, 'C');
	$pdf->Cell(20, 7, 'ID Siswa', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Nama Siswa', 1, 0, 'C');
	$pdf->Cell(40, 7, 'Alamat', 1, 0, 'C');
	$pdf->Cell(80, 7, 'Email', 1, 0, 'C');
	$pdf->Cell(40, 7, 'No. HP', 1, 0, 'C');
    $pdf->Cell(20, 7, 'ID User', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT * FROM siswa ORDER BY idsiswa ASC");

    while ($d = mysqli_fetch_array($data)) {
		$pdf->Cell(10, 6, $no++, 1, 0, 'C');
		$pdf->Cell(20, 6, $d['idsiswa'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['nama'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['alamat'], 1, 0, 'C');
		$pdf->Cell(80, 6, $d['email'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['no_hp'], 1, 0, 'C');
        $pdf->Cell(20, 6, $d['users_id'], 1, 0, 'C');
		$pdf->Ln();
	}
	$pdf->Output();
?>