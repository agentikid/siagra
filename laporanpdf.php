<?php
include "koneksi.php";
require('fpdf17/fpdf.php');
/**
 Judul  : Laporan PDF (portait):
 Level  : Menengah
 Author : Hakko Bio Richard
 Blog   : www.hakkoblogs.com
 Web    : www.niqoweb.com
 Email  : hakkobiorichard@ygmail.com
 
 Untuk tutorial yang lainnya silahkan berkunjung ke www.hakkoblogs.com
 
 Butuh jasa pembuatan website, aplikasi, pembuatan program TA dan Skripsi.? Hubungi NiqoWeb ==>> 085694984803
 
 **/
//Menampilkan data dari tabel di database

$result=mysql_query("SELECT * FROM data_absensi ORDER BY nip ASC") or die(mysql_error());

//Inisiasi untuk membuat header kolom
$column_nip = "";
$column_nama = "";
$column_nama_skpd = "";
$column_checktime = "";
$column_waktu = "";
$column_status = "";
$column_catatan_keterangan = "";


//For each row, add the field to the corresponding column
while($row = mysql_fetch_array($result))
{
	$nip = $row["nip"];
    $nama = $row["nama"];
    $nama_skpd = $row["nama_skpd"];
    $checktime = $row["checktime"];
    $waktu = $row["waktu"];
	$status = $row["status"];
    $catatan_keterangan = $row["catatan_keterangan"];
 
    

	$column_nip = $column_nip.$nip."\n";
    $column_nama = $column_nama.$nama."\n";
    $column_nama_skpd = $column_nama_skpd.$nama_skpd."\n";
    $column_checktime = $column_checktime.$checktime."\n";
    $column_waktu = $column_waktu.$waktu."\n";
    $column_status = $column_status.$status."\n";
    $column_catatan_keterangan = $column_catatan_keterangan.$catatan_keterangan."\n";
    

//Create a new PDF file
$pdf = new FPDF('L','mm',array(330,210)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
//$pdf->Image('../foto/logo.png',10,10,-175);

$pdf->SetFont('Arial','B',20);
$pdf->Cell(80);
$pdf->Cell(150,10,'DATA ABSENSI SKPD X',0,0,'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(150,5,'PEMERINTAH PROVINSI BENGKULU',0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(80);
$pdf->Cell(150,10,'Tanggal cetak '.date("d-M-Y  h:i:s").' RefCode : ',0,0,'C');
$pdf->Ln();

}
//Fields Name position
$Y_Fields_Name_position = 40;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5); //0
$pdf->Cell(40,8,'NIP',1,0,'C',1);
$pdf->SetX(45); //25
$pdf->Cell(49,8,'NAMA',1,0,'C',1);
$pdf->SetX(94); //40
$pdf->Cell(100,8,'SKPD',1,0,'C',1);
$pdf->SetX(194); //25
$pdf->Cell(25,8,'TANGGAL',1,0,'C',1);
$pdf->SetX(219); //25
$pdf->Cell(17,8,'JAM',1,0,'C',1);
$pdf->SetX(236); //50
$pdf->Cell(40,8,'STATUS',1,0,'C',1);
$pdf->SetX(276); //25
$pdf->Cell(40,8,'KETERANGAN',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 48;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(40,6,$column_nip,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(49,6,$column_nama,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(94);
$pdf->MultiCell(100,6,$column_nama_skpd,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(194);
$pdf->MultiCell(25,6,$column_checktime,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(219);
$pdf->MultiCell(17,6,$column_waktu,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(236);
$pdf->MultiCell(40,6,$column_status,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(276);
$pdf->MultiCell(40,6,$column_catatan_keterangan,1,'C');

$pdf->Output();
?>
