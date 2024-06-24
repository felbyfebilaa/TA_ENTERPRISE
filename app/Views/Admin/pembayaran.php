<?= $this->extend('Admin/Layout/template'); ?>
<?= $this->section('content'); ?>
    <div class="row">
        <div class="col-4 mb-4">
            <a href="/Admin/cetakPembayaran" class="btn btn-warning">
                Cetak Data
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pembayaran</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="search" id="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>KTP</th>
                            <th>No Telepon</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Biaya Admin</th>
                            <th>Total Pembayaran</th>
                            <th>Nama Rekening</th>
                            <th>Atas Nama</th>
                            <th>No. Rek</th>
                        </tr>
                    </thead>
                    <tbody class="first">
                        <?php
                        $no = 1;
                        foreach ($pembayaran as $c => $r) :
                        ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $no++; ?></td>
                                <td style="vertical-align: middle;"><?= $r['Nama']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['NIK']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['No_HP']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['tanggal_pembayaran']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['biaya_admin']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['total_pembayaran']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['nama_rekening']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['atas_nama']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['no_rekening']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?= $this->endSection(); ?>