<?= $this->extend('Admin/Layout/template'); ?>
<?= $this->section('content'); ?>
<!-- <div class="row mb-3">
    <div class="col-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            Tambah Customer
        </button>
    </div>
</div> -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Ulasan</h3>
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
                            <th>Action</th>
                            <th>Tanggal</th>
                            <th>Nama Paket</th>
                            <th>Nama Costumer</th>
                            <th>Ulasan</th>
                        </tr>
                    </thead>
                    <tbody class="first">
                        <?php
                        $no = 1;
                        foreach ($ulasan as $c => $r) :
                        ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $no++; ?></td>
                                <td style="vertical-align: middle;">
                                    <form action="/ulasan/<?= $r['id_ulasan']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('anda yakin?'); "> Hapus</button>
                                    </form>
                                </td>
                                <td style="vertical-align: middle;"><?= $r['tanggal_ulasan']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['nama_paket_makeup']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['nama_costumer']; ?></td>
                                <td style="vertical-align: middle;"><?= $r['ulasan']; ?></td>
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