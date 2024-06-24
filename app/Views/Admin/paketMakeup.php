<?= $this->extend('/Admin/Layout/template'); ?>
<?= $this->section('content'); ?>
<style>
    .table>tbody>tr * {
        vertical-align: middle;
    }

    .alert-success {
        background-color: #28a7459c !important;
    }
</style>
<div class="row">
    <div class="col-4 mb-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            Tambah Paket Makeup
        </button>
    </div>
</div>
<div class="row">
    <div class="col">
        <?php if (session()->get('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Paket Makeup</h3>
            </div>
            <!-- ./card-header -->
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Nama Paket</th>
                            <th>Harga Paket</th>
                            <th>Deskripsi Paket</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($paketMakeup as $p => $paket) :
                            $desc = nl2br($paket['deskripsi_paket_makeup']);
                            $harga = "Rp " . number_format($paket['harga_paket_makeup'], 0, ',', '.');
                        ?>
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td><?= $id++; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg-<?= $paket['id_paket_makeup']; ?>">
                                        Update
                                    </button>
                                    <br>
                                    <form action="/paketmakeup/<?= $paket['id_paket_makeup']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('anda yakin?'); "> Hapus</button>
                                    </form>
                                </td>
                                <td><?= $paket['nama_paket_makeup']; ?></td>
                                <td><?= $harga; ?></td>
                                <td><?= $desc; ?></td>
                                <td>
                                    <img src="/assets/fotoMakeup/<?= $paket['foto_paket_makeup']; ?>" alt="" height="100" width="100" style="object-fit: contain;">
                                </td>
                            </tr>
                            <tr class="expandable-body">
                                <td colspan="5">
                                    <p>
                                        <?= $desc; ?>
                                    </p>
                                </td>
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
                <h4 class="modal-title">Tambah Paket Makeup</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Admin/insertPaketMakeup" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="display: flex; justify-content:space-between;">
                    <div class="right-content" style="width: 55%;">
                        <table>
                            <tr>
                                <td>Nama Paket Makeup</td>
                                <td> : </td>
                                <td>
                                    <input type="text" name="nama_paket_makeup" class="form-control <?= ($validasi->hasError('nama_paket_makeup')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_paket_makeup'); ?>">
                                    <span class="error invalid-feedback"><?= $validasi->getError('nama_paket_makeup'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Deskripsi Paket Makeup</td>
                                <td> : </td>
                                <td>
                                    <textarea name="deskripsi_paket_makeup" id="" cols="30" rows="5" class="form-control <?= ($validasi->hasError('deskripsi_paket_makeup')) ? 'is-invalid' : ''; ?>"><?= old('deskripsi_paket_makeup'); ?></textarea>
                                    <span class="error invalid-feedback"><?= $validasi->getError('deskripsi_paket_makeup'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Harga Paket Makeup</td>
                                <td> : </td>
                                <td><input type=" text" name="harga_paket_makeup" class="form-control <?= ($validasi->hasError('harga_paket_makeup')) ? 'is-invalid' : ''; ?>" value="<?= old('harga_paket_makeup'); ?>">
                                    <span class="error invalid-feedback"><?= $validasi->getError('harga_paket_makeup'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Gambar Paket</td>
                                <td> : </td>
                                <td>
                                    <input type="file" name="paket_foto_makeup" id="gambar" onchange="previewImg()">
                                </td>
                            </tr>
                        </table>
                        <?php if ($validasi->hasError('paket_foto_makeup')) : ?>
                            <p style="padding-left: 26%; color: red; font-size: 80%;"><?= $validasi->getError('paket_foto_makeup'); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="left-content" style="width: 45%;">
                        <img src="" alt="" style="width: 100%;" class="img-preview">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php require '_updatePaketMakeup.php' ?>
<?= $this->endSection(); ?>