<?php
require('../../assets/fpdf183/fpdf.php');
include_once('../../koneksi.php');

class PDF extends FPDF {

    function Header() {
            $this->Image('../../images/sultra.png',1.5,1,2);  
            $this->Image('../../images/tutwuri.png',18,1,2);       
            $this->SetFont('Arial','B',11);        
            $this->Cell(0,0.75,'PEMERINTAH PROVINSI SULAWESI TENGGARA',0,0,'C');        
            $this->Ln();        
            $this->SetFont('Arial','B',14);        
            $this->Cell(0,0.75,'NAMA SEKOLAH',0,0,'C');        
            $this->Ln();        
            $this->SetFont('Arial','',9);        
            $this->Cell(0,0.5,'Jl. Kijang No. 5 .....',0,0,'C');        
            $this->Ln();        
            $this->Ln();
            $this->SetFont('Arial','',14);
            $this->Line(1, 3.5, 20.5, 3.5);        
            $this->Ln();
            $this->SetFont('Arial','B',11);
            $this->Cell(0,0.75,'Laporan Rekap Absen',0,0,'C');        
            $this->Ln();
        }    
    }
    
    $pdf=new PDF('P','cm','Letter');    
    $pdf->AliasNbPages();    
    $pdf->AddPage();    
    $pdf->SetMargins(1.5,1,1.5);    
    $pdf->SetFont('Arial','B',12);
    
    
    //membuat kop tabel
    $x=$pdf->GetY();    
    $pdf->SetY($x+1);    
    $pdf->SetFont('Courier','B',11);
    $pdf->Cell(3,1.4,'NIS',1,0,'C');
    $pdf->Cell(7,1.4,'Nama Siswa',1,0,'C');
    $pdf->Cell(2,1.4,'Kelas',1,0,'C');
    $pdf->Cell(6.8,0.7,'Kehadiran',1,0,'C');
    $pdf->Ln();
    $pdf->Cell(12);
    $pdf->Cell(1.7,0.7,'Hadir',1,0,'C');
    $pdf->Cell(1.7,0.7,'Sakit',1,0,'C');
    $pdf->Cell(1.7,0.7,'Izin',1,0,'C');
    $pdf->Cell(1.7,0.7,'Alpa',1,0,'C');
    
    //query dan arraying
    $sql   ="SELECT * FROM tbl_siswa";    
    $query = mysqli_query($conn, $sql);   
    while( $result= mysqli_fetch_array( $query )){    
        $id_siswa = $result['0'];
        //nama siswa dari tabel siswa
        $siswa=mysqli_query($conn,"SELECT * FROM tbl_siswa WHERE id_siswa='$id_siswa'");
        $data_siswa=mysqli_fetch_array($siswa);
        $nis    = $data_siswa['nis'];
        $nama   = $data_siswa['nama'];
        //kelas siswa dari tabel kelas
        $id_kelas= $data_siswa['id_kelas'];
        $kelas = mysqli_query($conn,"SELECT * FROM tbl_kelas WHERE id_kelas='$id_kelas'");
        $data_kelas=mysqli_fetch_array($kelas);
        $nama_kelas=$data_kelas['nama_kelas'];

        //jumlah hadir
        $hadir=mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$id_siswa' AND keterangan='Hadir'");
        $jumlah_hadir=mysqli_num_rows($hadir);

        //jumlah sakit
        $sakit=mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$id_siswa' AND keterangan='Sakit'");
        $jumlah_sakit=mysqli_num_rows($sakit);

        //jumlah izin
        $izin=mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$id_siswa' AND keterangan='Izin'");
        $jumlah_izin=mysqli_num_rows($izin);
        
        //jumlah alpa
        $alpa=mysqli_query($conn,"SELECT * FROM tbl_absensi WHERE id_siswa='$id_siswa' AND keterangan='Alpa'");
        $jumlah_alpa=mysqli_num_rows($alpa);


        $pdf->SetFont('Courier','B',10);
        $pdf->Ln();
        $pdf->Cell(3,0.7,$nis,1,0,'L');
        $pdf->Cell(7,0.7,$nama,1,0,'L');
        $pdf->Cell(2,0.7,$nama_kelas,1,0,'L');
       $pdf->Cell(1.7,0.7,$jumlah_hadir,1,0,'C');
       $pdf->Cell(1.7,0.7,$jumlah_sakit,1,0,'C');
       $pdf->Cell(1.7,0.7,$jumlah_izin,1,0,'C');
       $pdf->Cell(1.7,0.7,$jumlah_alpa,1,0,'C');
    }
    
    
    $pdf->Output();
?>