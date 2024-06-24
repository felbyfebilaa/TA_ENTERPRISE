<?= $this->extend('Admin/Layout/template'); ?>
<?= $this->section('content'); ?>
    <div class="row">
        <div class="col-4 mb-4">
            <a href="/Admin/cetakCostumer" class="btn btn-warning">
                Cetak Data
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Customer</h3>
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
                            <th>Nama Customer</th>
                            <th>KTP</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody class="first">
                        <?php
                        $no = 1;
                        foreach ($customers as $c => $customer) :
                        ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $no++; ?></td>
                                <td style="vertical-align: middle;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg-<?= $customer['NIK']; ?>">
                                        Update
                                    </button>
                                    <br>
                                    <form action="/customer/<?= $customer['NIK']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('anda yakin?'); "> Hapus</button>
                                    </form>
                                </td>
                                <td style="vertical-align: middle;"><?= $customer['Nama']; ?></td>
                                <td style="vertical-align: middle;"><?= $customer['NIK']; ?></td>
                                <td style="vertical-align: middle;"><?= $customer['No_HP']; ?></td>
                                <td style="vertical-align: middle;"><?= $customer['Alamat']; ?></td>
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
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Admin/insertCustomer">
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Nama Customer</td>
                            <td> : </td>
                            <td>
                                <input type="text" name="nama" class="form-control <?= ($validasi->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= old('nama'); ?>">
                                <span class="error invalid-feedback"><?= $validasi->getError('nama'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>KTP</td>
                            <td> : </td>
                            <td>
                                <input type="text" name="nik" class="form-control <?= ($validasi->hasError('nik')) ? 'is-invalid' : ''; ?>" value="<?= old('nik'); ?>">
                                <span class="error invalid-feedback"><?= $validasi->getError('nik'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>No Telepon</td>
                            <td> : </td>
                            <td>
                                <input type="text" name="notelp" class="form-control <?= ($validasi->hasError('notelp')) ? 'is-invalid' : ''; ?>" value="<?= old('notelp'); ?>">
                                <span class="error invalid-feedback"><?= $validasi->getError('notelp'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td> : </td>
                            <td>
                                <input type="text" name="alamat" class="form-control <?= ($validasi->hasError('alamat')) ? 'is-invalid' : ''; ?>" value="<?= old('alamat'); ?>">
                                <span class="error invalid-feedback"><?= $validasi->getError('alamat'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php if (session()->getFlashdata('pesan eror')) : ?>
    <script>
        $(document).ready(function() {
            toastr.error('\
                <ul>\
                    <?php if ($validasi->hasError('nama')) : ?>\
                        <li><?= $validasi->getError('nama'); ?></li>\
                    <?php endif; ?>\
                    <?php if ($validasi->hasError('nik')) : ?>\
                        <li><?= $validasi->getError('nik'); ?></li>\
                    <?php endif; ?>\
                    <?php if ($validasi->hasError('notelp')) : ?>\
                        <li><?= $validasi->getError('notelp'); ?></li>\
                    <?php endif; ?>\
                    <?php if ($validasi->hasError('alamat')) : ?>\
                        <li><?= $validasi->getError('alamat'); ?></li>\
                    <?php endif; ?>\
                </ul>\
            ');
        })
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        $(document).ready(function() {
            toastr.success('<?= session()->getFlashdata('pesan'); ?>')
        })
    </script>
<?php endif; ?>
<?php require '_updateCustomer.php'; ?>
<script>
    $(document).ready(function() {
        var a = false;
        $('#search').on('keyup', function() {
            // console.log($(this).val());
            if ($(this).val() != '') {
                a = true;
                var no = 1;
                $('.first').empty();
                $.ajax({
                    url: '/Home/cari/' + $(this).val(),
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log(data);
                        // var rowCount = data.length;
                        // console.log(no)
                        $.each(data, function(key, value) {
                            $('.first').append('\
                        <tr>\
                        <td style="vertical-align: middle;">' + no + '</td>\
                                <td style="vertical-align: middle;">\
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg-' + data[key].NIK + '">\
                                        Update\
                                    </button>\
                                    <br>\
                                    <form action="/customer/' + data[key].NIK + '" method="post" class="d-inline">\
                                        <?= csrf_field(); ?>\
                                        <input type="hidden" name="_method" value="DELETE">\
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm("anda yakin?"); "> Hapus</button>\
                                    </form>\
                                </td>\
                                <td style="vertical-align: middle;">' + data[key].Nama + '</td>\
                                <td style="vertical-align: middle;">' + data[key].NIK + '</td>\
                                <td style="vertical-align: middle;">' + data[key].No_HP + '</td>\
                                <td style="vertical-align: middle;">' + data[key].Alamat + '</td>\
                        </tr>\
                        ')
                            no++;
                        })
                    }
                });
            } else {
                if (a == 1) {
                    $('.first').empty();
                    var no = 1;
                    $.ajax({
                        url: '/Home/cari/' + $(this).val(),
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            $.each(data, function(key, value) {
                                // console.log(data[key])
                                $('.first').append('\
                        <tr>\
                        <td style="vertical-align: middle;">' + no + '</td>\
                                <td style="vertical-align: middle;">\
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg-' + data[key].NIK + '">\
                                        Update\
                                    </button>\
                                    <br>\
                                    <form action="/customer/' + data[key].NIK + '" method="post" class="d-inline">\
                                        <?= csrf_field(); ?>\
                                        <input type="hidden" name="_method" value="DELETE">\
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm("anda yakin?"); "> Hapus</button>\
                                    </form>\
                                </td>\
                                <td style="vertical-align: middle;">' + data[key].Nama + '</td>\
                                <td style="vertical-align: middle;">' + data[key].NIK + '</td>\
                                <td style="vertical-align: middle;">' + data[key].No_HP + '</td>\
                                <td style="vertical-align: middle;">' + data[key].Alamat + '</td>\
                        </tr>\
                        ')
                                no++;
                            })
                        }
                    });
                }
                a = false
            }
            // console.log(a);
        })
    })
</script>
<?= $this->endSection(); ?>