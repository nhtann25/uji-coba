<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card">
        <div class="card-body">

        <?php foreach($book as $b) : ?>
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= base_url().'/assets/img/uploads/'.$b->gambar ?>" class="card-img-top">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <td>Title</td>
                            <td><strong><?= $b->judul ?></strong></td>
                        </tr>
                        <tr>
                            <td>Publisher</td>
                            <td><strong><?= $b->penerbit ?></strong></td>
                        </tr>
                        <tr>
                            <td>Athor</td>
                            <td><strong><?= $b->pengarang ?></strong></td>
                        </tr>
                        <tr>
                            <td>Pages</td>
                            <td><strong><?= $b->jml_halaman ?></strong></td>
                        </tr>
                        <tr>
                            <td>Stock</td>
                            <td><strong><?= $b->stok ?></strong></td>
                            
                                
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><strong><div class="btn btn-sm btn-success">Rp. <?= number_format($b->harga,0,',','.') ?></div></strong></td>
                        </tr>
                        </table>
                
                <?php if($b->stok >0){
                    echo anchor('dashboard/add_shopping/'.$b->id_buku, '<div class="btn btn-sm btn-primary">Add to shopping cart</div>'); 
                    }else{
                    echo '<div class="btn btn-sm btn-primary" disabled>Sold Out</div>';
                    }
                ?>

                <?= anchor('dashboard/index/','<div class="btn btn-sm btn-danger">Back</div>'); ?>
            </div>
    <?php endforeach; ?>
        </div>
    </div>
</div>



















</div>
<!-- /.container-fluid -->
  </div>
<!-- End of Main Content -->