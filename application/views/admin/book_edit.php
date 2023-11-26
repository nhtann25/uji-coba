<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
        
        
        <?php foreach ($book as $b)?>
        <?= $this->session->flashdata('message');?>
        <?php echo form_open_multipart('admin/update'); ?>

        <div class="form-group row">
                <label for="id_buku" class="col-sm-2 col-form-label">Book Id</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_buku" name="id_buku" value="<?= $b->id_buku ?>" readonly>
                </div>
            </div>
            
        <div class="form-group row">
                <label for="id_kategori" class="col-sm-2 col-form-label">Category Id</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="<?= $b->id_kategori ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="judul" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $b->judul ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="penerbit" class="col-sm-2 col-form-label">Publisher</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $b->penerbit ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="pengarang" class="col-sm-2 col-form-label">Author</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= $b->pengarang ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="jml_halaman" class="col-sm-2 col-form-label">Pages</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jml_halaman" name="jml_halaman" value="<?= $b->jml_halaman ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" value="<?= $b->harga ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="stok" class="col-sm-2 col-form-label">Stock</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stok" name="stok" value="<?= $b->stok ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2">Image</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img id="img-file" src="<?= base_url('assets/img/uploads/') . $b->gambar ?>" class="img-thumbnail" class="gambar">
                            <input type="hidden" name="gambar_lama" value="<?= $b->gambar ?>">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="gambar" id="gambar">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="<?= base_url('admin/bookdata'); ?>"><div class="btn  btn-danger">Cancel</div></a>

                </div>
            </div>
            
            <?php echo form_close(); ?>
         </div>
    </div>
</div>
    
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -- > 

