<?php

include "lib/config.php";     			
include "lib/koneksi.php";

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \mPDF();

$body = '';

// items
$table = '';
$sql=mysqli_query($koneksi, "select * from cera_user");
while($mem=mysqli_fetch_array($sql)){
	$table = $table.'<tr>

                      <td>'.$mem[id_user].'</td>
                      <td>'.$mem[nama_user].'</td>
                      <td>'.$mem[email_user].'</td>
                      <td>'.$mem[position_user].'</td>
                      <td>'.$mem[phone_user].'</td>

	</tr>';
}

$imagex="../newcera/module/quotation/image/penghargaan.png";

$body = $body.'
	
	<img src="'.$imagex.'">
	<p style="page-break-after: always;">&nbsp;</p>
<p style="page-break-before: always;">&nbsp;</p>
    <table border="1" width="90%" align="center">
    <tr>
                      <th>No</th>
                      <th>Nama Sales</th>            
                      <th>Email</th>
                      <th>Jabatan</th>
                      <th>No HP</th>

    </tr>
    '.$table.'
    </table>

';

$mpdf->SetHeader('Document Title|Center Text|{PAGENO}');
$mpdf->SetFooter('Document Title');

$mpdf->WriteHTML($body);
$mpdf->Output();