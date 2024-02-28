<?php 
    include_once("../../config/koneksi.php");
    require("../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Mata Pelajaran', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
	$pdf->Cell(10, 7, 'ID', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Mata Pelajaran', 1, 0, 'C');
	$pdf->Cell(25, 7, 'ID Guru', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT * FROM matapelajaran ORDER BY idpelajaran ASC");

    while ($d = mysqli_fetch_array($data)) {
		$pdf->Cell(10, 6, $no++, 1, 0, 'C');
		$pdf->Cell(10, 6, $d['idpelajaran'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['namapelajaran'], 1, 0, 'C');
		$pdf->Cell(25, 6, $d['guru_idguru'], 1, 0, 'C');
		$pdf->Ln();
	}
	$pdf->Output();
?>