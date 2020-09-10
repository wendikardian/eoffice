<?php
$pdf = new Pdf('P', 'mm', 'A6', true, 'UTF-8', false);
$pdf->SetTitle('Kartu Karyawan');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();
$html = '
        <img src="' . base_url('assets/img/banner1.png') . '" width="300" height="20">
        <h3 class="mb--5">     Kartu Karyawan </h3> <br>
       <br><br>
            Nama  : ' . $user['name'] . '<br>
            Email : ' . $user['email'] . ' <br><br>
         <center><img src="' . base_url('assets/img/profile/' . $user['image']) . '" width="100" height="100">
        <img src="' . base_url('assets/img/qrcode/' . $user['qrcode']) . '" width="100" height="100"></center> <br><br>
<img src="' . base_url('assets/img/banner2.png') . '" width="305" height="30">
      ';
// $pdf->Write(3, '
// Kartu Pegawai Perusahaan

// ');
$pdf->writeHTML(
    $html,
    true,
    false,
    true,
    false,
    ''
);
$pdf->Output('Kartu Pegawai ' . $user['name'] . '.pdf', 'I');
