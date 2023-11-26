<?php
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Book Report');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage();
            $i=0;
            $html='<h3>Book Report</h3>
                    <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                        <tr bgcolor="#ffffff">
                            
                            <th width="10%" align="center">Title</th>
                            <th width="12%" align="center">Publisher</th>
                            <th width="12%" align="center">Author</th>
                            <th width="12%" align="center">Pages</th>
                            <th width="10%" align="center">Price</th>
                            <th width="10%" align="center">Stock</th>
                            <th width="17%" align="center">Image</th>
                            
                            
                        </tr>';
                                
            foreach ($report as $r) 
           
                {
                    $html.='<tr bgcolor="#ffffff">
                            
                        
                            
                            <td>'.$r['judul'].'</td>
                            <td>'.$r['penerbit'].'</td>
                            <td>'.$r['pengarang'].'</td>
                            <td>'.$r['jml_halaman'].'</td>
                            <td>'.$r['harga'].'</td>
                            <td>'.$r['stok'].'</td>
                            <td><img src="'.base_url('assets/img/uploads/').$r['gambar'].'" width="100px" height="100px"></td>

                            
                 
                        </tr>';      
                        
                }
            $html.='</table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('bookreport.pdf', 'I');
?>