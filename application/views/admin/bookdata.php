<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
     <a href="<?= base_url('admin/bookReport') ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm text-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
        <button class="btn btn-sm btn-primary mb-3 " data-toggle="modal" data-target="#addBook"> Add New Book</button>
    
    <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
    <table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Book Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>Publisher</th>
        <th>Author</th>
        <th>Pages</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Image</th>
        <th colspan="3">Action</th>
    </tr>
        <?php 
        $no = 1;
        foreach($book as $b) : ?>
        <!-- buat ressult_array pakenya kaya yang dibawah  
        kalo result doang baru pake -> soalnya dia ngasilinya data object bukan data array
        -->
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $b["id_buku"] ?></td>
            <td><?= $b["kategori"] ?></td>
            <td><?= $b["judul"] ?></td>
            <td><?= $b["penerbit"] ?></td>
            <td><?= $b["pengarang"] ?></td>
            <td><?= $b["jml_halaman"] ?></td>
            <td><?= $b["harga"] ?></td>
            <td><?= $b["stok"] ?></td>
            <td><img src="<?php echo base_url('');?>assets/img/uploads/<?php echo $b["gambar"] ?> "width="70px" height="70px"</td>
            <td>
               

                <?= anchor('admin/edit/' .$b["id_buku"], '<div class="btn btn-primary btn-sm mt-1"><i class="fa fa-edit"></i></div>') ?>
                
                <?= anchor('admin/delete/' .$b["id_buku"], '<div class="btn btn-danger btn-sm mt-1"><i class="fa fa-trash"></i></div>')?>
          </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBook">Add Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  
      <div class="modal-body">
      
      <?php echo form_open_multipart('admin/upload'); ?>
            <div class="form-group">
                <label>Category Id</label>
                <input type="text" name="id_kategori" id="id_kategori" class="form-control">
                
            </div>
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="judul" id="judul" class="form-control">
                
            </div>
            <div class="form-group">
                <label>Publisher</label>
                <input type="text" name="penerbit" id="penerbit" class="form-control">
                
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="pengarang" id="pengarang" class="form-control">
                
            </div>

            <div class="form-group">
                <label>Pages</label>
                <input type="text" name="jml_halaman" id="jml_halaman" class="form-control">
                
                
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="harga" id="harga" class="form-control">
               
                
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="text" name="stok" id="stok" class="form-control">
                
                
            </div>
            <div class="form-group">
                <label>Image</label><br>
                <input type="file" name="gambar" id="gambar" class="form-control">
                
                
            </div>
            <div class="form-group">
                <img id="img-file" src="" class="img-thumbnail" class="gambar" width="100px">
                
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

      
      <?php echo form_close(); ?> 
   
        
    </div>
  </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -- >     