<input type="hidden" id="base_url" value="<?= base_url(); ?>">
<!-- Begin Page Content -->
    <div class="container-fluid">
    <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<div class="row">
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buyers</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_buyers ?></div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-users fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-6 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Books</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_buku ?></div>
            </div>
          </div>
        </div>
        <div class="col-auto">
        <i class="fas fa-swatchbook fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<!-- Content Row -->
<div class="row">

  <div class="col-xl-12 col-lg-7">

    <!-- Area Chart -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Selling Result</h6>
      </div>
      <div class="card-body">
        <div id="container"></div>
        <!-- <hr>
        <h6 class="m-0 font-weight-bold text-primary text-center">Selling Result</h6> -->
      </div>
    </div>

  </div>

  

</div>
  </div>
<!-- /.container-fluid -->
  </div>
<!-- End of Main Content -->

