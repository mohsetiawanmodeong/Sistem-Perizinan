<?php
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetTitle('Perizinan');
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('GKS Kawungu');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    $pdf->SetTopMargin(5);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetDisplayMode('real', 'default');
    // Page 1
    $pdf->AddPage();
    $header = '
    <table cellpadding="0" border="0">
        <tr>
            <td align="center"><b><font size="30">'.$settings[0]['nama_aplikasi'].'</font></b></td>
        </tr>
        <br>
        <tr>
            <td align="center"><small>'.$settings[0]['address'].'</small></td>
        </tr>
        <tr>
            <td align="center"><small>'.$settings[0]['facebook'].'</small></td>
        </tr>
    </table>
    ';
    $pdf->writeHTML($header, true, false, false, false, '');
    // Line
    $style  = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '0', 'color' => array(0, 0, 0));
    $pdf->Line(5, 30, 205, 30, $style);
    $pdf->Line(5, 31, 205, 31, $style);

    // Tanggal Persetujuan
    $accept  = '
    <table cellpadding="0" border="0">
        <tr>
            <td>Nama Perusahaan</td>
            <td>'.$pengajuan[0]['nama_perusahaan'].'</td>
        </tr>
        <tr>
            <td>Alamat Perusahaan</td>
            <td>'.$pengajuan[0]['alamat_perusahaan'].'</td>
        </tr>
        <tr>
            <td>NPWP Perusahaan</td>
            <td>'.$pengajuan[0]['npwp'].'</td>
        </tr>
        <tr>
            <td>PIC</td>
            <td>'.$pengajuan[0]['pic_perusahaan'].'</td>
        </tr>
        <tr>
            <td>Tanggal Pengajuan</td>
            <td>'.tgl_indo($pengajuan[0]['tgl_pengajuan']).'</td>
        </tr>
        <tr>
            <td>Tanggal Disetujui</td>
            <td>'.tgl_indo($pengajuan[0]['tgl_disetujui']).'</td>
        </tr>
    </table>
    ';
    $pdf->writeHTML($accept, true, false, false, false, '');
    
    $pdf->Line(5, 68, 205, 68, $style);
    $pdf->Line(5, 85, 205, 85, $style);
    
    // Content Approve
    $table = '
    <table cellpadding="0" border="0">
        <tr>
            <td align="center">Jenis Perizinan</td>
        </tr>
        <tr>
            <td align="center"><b>'.strtoupper($pengajuan[0]['nama_perizinan']).'</b></td>
        </tr>
    </table>
    ';
    $pdf->writeHTML($table, true, false, false, false, '');

    $pdf->SetY(200);
    $pdf->SetX(150);
    $pdf->Cell(300,8 ,'Manado, '.tgl_indo(date('Y-m-d')),0,0,'L');
    $pdf->SetY(205);
    $pdf->SetX(150);
    $pdf->Cell(282,8 ,'Kepala Bagian',0,0,'L');
    $pdf->SetY(235);
    $pdf->SetX(150);
    $pdf->Cell(282,8 ,$pengajuan[0]['nama_kabag1'],0,0,'L');

    // Render Output
    ob_clean();
    $pdf->Output(APPPATH.'..\document\Approve Document - Nama Perusahaan '.$pengajuan[0]['nama_perusahaan'].'Tanggal '.date('Y-m-d').' id '.$pengajuan[0]['idPeng'].'.pdf', 'FI');
?>