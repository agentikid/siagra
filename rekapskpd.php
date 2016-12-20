<?php
include "koneksi.php";
require('fpdf17/fpdf.php');

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
   // $nama_skpd = $row["nama_skpd"];
    //$checktime = $row["checktime"];
    //$waktu = $row["waktu"];
	//$status = $row["status"];
    //$catatan_keterangan = $row["catatan_keterangan"];
 
    

	$column_nip = $column_nip.$nip."\n";
    $column_nama = $column_nama.$nama."\n";
    $column_nama_skpd = $column_nama_skpd."\n";
    $column_checktime = $column_checktime."\n";
    $column_waktu = $column_waktu."\n";
    $column_status = $column_status."\n";
    $column_catatan_keterangan = $column_catatan_keterangan."\n";
    

 
//Create a new PDF file
$pdf = new FPDF('L','mm',array(330,210)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
//$pdf->Image('../foto/logo.png',10,10,-175);

$pdf->SetFont('Arial','B',20);
$pdf->Cell(5);
$pdf->Cell(35,10,'REKAP SKPD X',0,0,'C');
$pdf->Ln();
//$pdf->Cell(80);
//$pdf->Cell(150,10,'PEMERINTAH PROVINSI BENGKULU',0,0,'C');
//$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(200);
$pdf->Cell(0,6,'Bulan    : '.date("M-Y"),0,0,'L');
$pdf->Ln();
$pdf->Cell(200);
$pdf->Cell(0,6,'Jumlah Hari Kerja.......'.' atau........Jam Kerja',0,0,'L');
$pdf->Ln();
$pdf->Cell(200);
$pdf->Cell(0,6,'Tanggal cetak '.date("d-M-Y  h:i:s").' RefCode : ',0,0,'L');
$pdf->Ln();

}
//Fields Name position
$Y_Fields_Name_position = 50;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5); //0
$pdf->Cell(40,16,'NIP',1,0,'C',1);
$pdf->SetX(45); //25
$pdf->Cell(70,16,'NAMA',1,0,'C',1);
$pdf->SetX(115); //40
$pdf->Cell(30,8,'HT',1,0,'C',1);
$pdf->SetY(58);
$pdf->SetX(115); //40
$pdf->Cell(15,8,'JAM',1,0,'C',1);
$pdf->Cell(15,8,'%',1,0,'C',1);
$pdf->SetY(50);
$pdf->SetX(145); //25
$pdf->Cell(30,8,'PLC',1,0,'C',1);
$pdf->SetY(58);
$pdf->SetX(145); //25
$pdf->Cell(15,8,'JAM',1,0,'C',1);
$pdf->Cell(15,8,'%',1,0,'C',1);
$pdf->SetY(50);
$pdf->SetX(174); //25
$pdf->Cell(30,8,'TMK',1,0,'C',1);
$pdf->SetY(58);
$pdf->SetX(174); //25
$pdf->Cell(15,8,'JAM',1,0,'C',1);
$pdf->Cell(15,8,'%',1,0,'C',1);
$pdf->SetY(50);
$pdf->SetX(204); //50
$pdf->MultiCell(30,8,"JAM KERJA \n (7.5 JAM-4-5-6)",1,0,'C',1);
$pdf->SetY(50);
$pdf->SetX(234); //25
$pdf->Cell(50,16,'KETERANGAN',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 66;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(40,6,$column_nip,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(70,6,$column_nama,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(15,6,$column_nama_skpd,1,'C');//HT JAM
$pdf->SetY($Y_Table_Position);
$pdf->SetX(130);
$pdf->MultiCell(15,6,$column_nama_skpd,1,'C');//HT %

$pdf->SetY($Y_Table_Position);
$pdf->SetX(145);
$pdf->MultiCell(15,6,$column_checktime,1,'C');//PLC JAM

$pdf->SetY($Y_Table_Position);
$pdf->SetX(160);
$pdf->MultiCell(14,6,$column_checktime,1,'C');//PLC %

$pdf->SetY($Y_Table_Position);
$pdf->SetX(174);
$pdf->MultiCell(15,6,$column_checktime,1,'C');// TMK JAM

$pdf->SetY($Y_Table_Position);
$pdf->SetX(189);
$pdf->MultiCell(15,6,$column_waktu,1,'L');//TMK %

$pdf->SetY($Y_Table_Position);
$pdf->SetX(204);
$pdf->MultiCell(30,6,$column_status,1,'C');//JMK

$pdf->SetY($Y_Table_Position);
$pdf->SetX(234);
$pdf->MultiCell(50,6,$column_catatan_keterangan,1,'C');

$pdf->Output();
?>
