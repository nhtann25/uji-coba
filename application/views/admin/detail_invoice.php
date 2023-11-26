<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> <div class="btn btn-sm btn-success">No. Invoice: <?= $invoice->id_invoice ?></div></h1>
   


    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Sub-Total</th>
        </tr>
        <?php $total = 0;
        if($pesanan){
            foreach ($pesanan as $psn) :
            $subtotal = $psn->jumlah * $psn->harga;
            $total += $subtotal;

        ?>
        <tr>
            <td><?= $psn->id_buku ?></td>
            <td><?= $psn->nama_buku ?></td>
            <td><?= $psn->jumlah ?></td>
            <td><?= number_format($psn->harga,0,',','.')?></td>
            <td><?= number_format($subtotal,0,',','.') ?></td>
        </tr>

        <?php endforeach; } ?>

        <tr>
            <td colspan="4" align="right">Grand Total</td>
            <td align="right">Rp. <?= number_format($total,0,',','.') ?></td>
        </tr>
    </table>
    <a href="<?= base_url('admin/invoice'); ?>"><div class="btn btn-sm btn-primary">Back</div></a>






</div>
<!-- /.container-fluid -->
  </div>
<!-- End of Main Content -->