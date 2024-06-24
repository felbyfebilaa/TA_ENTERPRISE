<?= $this->extend('/Admin/layout/template'); ?>
<?= $this->section('content'); ?>
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
                            <th>Nama Customer</th>
                            <th>NIK</th>
                            <th>Tanggal Transaksi</th>
                            <th>Biaya Admin</th>
                            <th>Harga Paket</th>
                            <th>Jumlah</th>
                            <th>Jenis Pembayaran</th>
                            <th>Bukti Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($datas as $a => $values) :
                        ?>
                            <tr>
                                <td style="vertical-align:middle;"><?= $no++; ?></td>
                                <td style="vertical-align: middle;"><?= $values['Nama']; ?></td>
                                <td style="vertical-align: middle;"><?= $values['NIK']; ?></td>
                                <td style="vertical-align: middle;"><?= date('d F Y', strtotime($values['Tanggal_Transaksi'])); ?></td>
                                <td style="vertical-align: middle;"><?= "Rp " . number_format($values['Biaya_Admin'], 0, ',', '.'); ?></td>
                                <td style="vertical-align: middle;"><?= "Rp " . number_format($values['Harga_Paket'], 0, ',', '.'); ?></td>
                                <td style="vertical-align: middle;"><?= "Rp " . number_format($values['Jumlah_Pembayaran'], 0, ',', '.'); ?></td>
                                <td style="vertical-align: middle;"><?= $values['nama_rekening']; ?></td>
                                <td style="vertical-align: middle;">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-bukti-<?= $values['Id_Transaksi']; ?>">
                                        Detail
                                    </button>
                                    <div class="modal fade" id="modal-bukti-<?= $values['Id_Transaksi']; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Bukti Pembayaran</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="display: flex; justify-content:center;">
                                                    <img src="/assets/bukti_transaksi/<?= $values['Bukti_Pembayaran']; ?>" alt="" style="width:640px; height:360px;object-fit:contain;">
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
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
<?= $this->endSection(); ?>