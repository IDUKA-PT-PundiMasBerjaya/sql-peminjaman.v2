<?php
    include_once("../../config/koneksi.php");
    require("../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(0, 15, '', 0, 1);
    $pdf->Cell(250, 10, 'Data Pengembalian Buku', 0, 0, 'R');

    $pdf->Cell(10, 17, '', 0, 1);	
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    $pdf->Cell(30, 7, 'ID Pengembalian', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Nama Peminjam', 1, 0, 'C');
    $pdf->Cell(110, 7, 'Nama Buku', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Tgl. Pengembalian', 1, 0, 'C');
    $pdf->Cell(27, 7, 'Jumlah', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);

    $no = 1;
    $data = "SELECT pengembalian_buku.id_pengembalian, buku.judul AS nama_buku,
                    CASE
                        WHEN siswa.nama IS NOT NULL THEN siswa.nama
                        WHEN guru.nama IS NOT NULL THEN guru.nama
                    END AS namapeminjaman,
                    pengembalian_buku.jumlah_buku,
                    buku.stok,
                    buku.gambar AS gambar_buku,
                    pengembalian_buku.tanggal_pengembalian,
                    peminjaman.id_peminjaman AS peminjaman_id_peminjaman
                    FROM
                    pengembalian_buku
                    JOIN
                    peminjaman ON pengembalian_buku.id_pengembalian = peminjaman.id_peminjaman
                    LEFT JOIN
                    siswa ON peminjaman.siswa_idsiswa = siswa.idsiswa
                    LEFT JOIN
                    guru ON peminjaman.guru_idguru = guru.idguru
                    JOIN
                    buku ON pengembalian_buku.buku_id_buku = buku.id_buku";

    $ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);

    $prevPengembalianID = null;
    $rowSpanCounts = [];

    if ($num > 0) {
        while ($row = mysqli_fetch_array($ambildata)) {
            $pengembalianID = $row['id_pengembalian'];
            $rowSpanCounts[$pengembalianID][] = $row;
        }

        mysqli_data_seek($ambildata, 0);
        $no = 1;
        foreach ($rowSpanCounts as $pengembalianID => $rows) {
            $rowSpanCount = count($rows);
            $firstRow = true;
            foreach ($rows as $key => $userAmbilData) {
                if ($firstRow) {
                    $pdf->Cell(10, 6 * $rowSpanCount, $no++, 1, 0, 'C');
                $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['id_pengembalian'], 1, 0, 'C');
                    $pdf->Cell(40, 6 * $rowSpanCount, $userAmbilData['namapeminjaman'], 1, 0, 'C');
                    $firstRow = false;
                } else {
                    $pdf->Cell(10, 6, '', 0, 0, 'C');
                    $pdf->Cell(30, 6, '', 0, 0, 'C');
                    $pdf->Cell(40, 6, '', 0, 0, 'C');
                }

                $pdf->Cell(110, 6, $userAmbilData['nama_buku'], 1, 0, 'C');
                $pdf->Cell(30, 6, $userAmbilData['tanggal_pengembalian'], 1, 0, 'C');
                $pdf->Cell(27, 6, $userAmbilData['jumlah_buku'], 1, 1, 'C');
            }
        }
    }

    $pdf->Output();
?>