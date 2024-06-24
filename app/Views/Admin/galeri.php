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
            Tambah Galeri
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
                <h3 class="card-title">Data Galeri</h3>
            </div>
            <!-- ./card-header -->
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Nama Galeri</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;
                        foreach ($galeri as $p => $paket) :
                            $desc = nl2br($paket['deskripsi']);
                        ?>
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td><?= $id++; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg-<?= $paket['id_galeri']; ?>">
                                        Update
                                    </button>
                                    <br>
                                    <form action="/galeri/<?= $paket['id_galeri']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('anda yakin?'); "> Hapus</button>
                                    </form>
                                </td>
                                <td><?= $paket['nama_galeri']; ?></td>
                                <td><?= $desc; ?></td>
                                <td>
                                    <img src="/assets/fotoGaleri/<?= $paket['foto_galeri']; ?>" alt="" height="100" width="100" style="object-fit: contain;">
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
                <h4 class="modal-title">Tambah Galeri</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Admin/insertGaleri" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="display: flex; justify-content:space-between;">
                    <div class="right-content" style="width: 55%;">
                        <table>
                            <tr>
                                <td>Nama Galeri</td>
                                <td> : </td>
                                <td>
                                    <input type="text" name="nama_galeri" class="form-control <?= ($validasi->hasError('nama_galeri')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_galeri'); ?>">
                                    <span class="error invalid-feedback"><?= $validasi->getError('nama_galeri'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td> : </td>
                                <td>
                                    <textarea name="deskripsi" id="" cols="30" rows="5" class="form-control <?= ($validasi->hasError('deskripsi')) ? 'is-invalid' : ''; ?>"><?= old('deskripsi'); ?></textarea>
                                    <span class="error invalid-feedback"><?= $validasi->getError('deskripsi'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Gambar Galeri</td>
                                <td> : </td>
                                <td>
                                    <input type="file" name="foto_galeri" id="gambar" onchange="previewImg()">
                                </td>
                            </tr>
                        </table>
                        <?php if ($validasi->hasError('foto_galeri')) : ?>
                            <p style="padding-left: 26%; color: red; font-size: 80%;"><?= $validasi->getError('foto_galeri'); ?></p>
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
<?php require '_updateGaleri.php' ?>
<?= $this->endSection(); ?>