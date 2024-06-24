<?= $this->extend('/Admin/Layout/template'); ?>
<?= $this->section('content'); ?>
<?php ?>
<div class="row">
    <div class="col-4 mb-4">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
            Tambah Rekening
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
                <h3 class="card-title">Daftar Rekening</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>Nama Rekening</th>
                            <th>Atas Nama</th>
                            <th>No Rekening</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($rekenings as $r => $rekening) :
                        ?>
                            <tr>
                                <td style="vertical-align: middle;"><?= $no++; ?></td>
                                <td style="vertical-align: middle;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg-<?= $rekening['id']; ?>">
                                        Update
                                    </button>
                                    <br>
                                    <form action="/rekening/<?= $rekening['id']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('anda yakin?'); "> Hapus</button>
                                    </form>
                                </td>
                                <td style="vertical-align: middle;"><?= $rekening['nama_rekening']; ?></td>
                                <td style="vertical-align: middle;"><?= $rekening['atas_nama']; ?></td>
                                <td style="vertical-align: middle;"><?= $rekening['no_rekening']; ?></td>
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
                <h4 class="modal-title">Tambah Rekening</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/Admin/insertRekening" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="display: flex; justify-content:space-between;">
                    <table>
                        <tr>
                            <td>Nama Rekening</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="nama_rekening" class="form-control <?= ($validasi->hasError('nama_rekening')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_rekening'); ?>">
                                <span class="error invalid-feedback"><?= $validasi->getError('nama_rekening'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Atas Nama</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="atas_nama" class="form-control <?= ($validasi->hasError('atas_nama')) ? 'is-invalid' : ''; ?>" value="<?= old('atas_nama'); ?>">
                                <span class="error invalid-feedback"><?= $validasi->getError('atas_nama'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>No Rekening</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="no_rekening" class="form-control <?= ($validasi->hasError('no_rekening')) ? 'is-invalid' : ''; ?>" value="<?= old('no_rekening'); ?>">
                                <span class="error invalid-feedback"><?= $validasi->getError('no_rekening'); ?></span>
                            </td>
                        </tr>
                    </table>
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
<?php require '_updateRekening.php'; ?>
<?= $this->endSection(); ?>