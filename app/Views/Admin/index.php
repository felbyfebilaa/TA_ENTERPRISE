<?= $this->extend('Admin/Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $statusPending; ?></h3>
                <p>Reservasi / Order</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-paper"></i>
            </div>
            <!-- <div class="small-box-footer"></div> -->
            <a href="/Admin/reservasi" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $paket[0]['data']; ?></h3>

                <p>Paket MakeUp</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-box"></i>
            </div>
            <a href="/Admin/paketMakeup" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $customer[0]['data']; ?></h3>

                <p>Customer</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="/Admin/customer" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $status ?></h3>
                <p>Reservasi Yang Telah Selesai</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-cloud-done"></i>
            </div>
            <a href="/Admin/reservasi" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Reservasi / Order</h3>
            </div>
            <!-- ./card-header -->
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>NIK</th>
                            <th>Paket Foto</th>
                            <th>Tanggal Reservasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $d => $values) :?>
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td><?= $no++; ?></td>
                                <td><?= $values['Nama']; ?></td>
                                <td><?= $values['NIK']; ?></td>
                                <td><?= $values['nama_paket_makeup']; ?></td>
                                <td><?= date('d F Y', strtotime($values['tanggal_makeup'])); ?></td>
                                <td><?= $values['status_booking']; ?></td>
                            </tr>
                            <tr class="expandable-body">
                                <td colspan="6">
                                    <div class="sub-table" style="display: flex; justify-content:space-between;">
                                        <div class="left-table">
                                            <p><b>Informasi Reservasi</b></p>
                                            <table>
                                                <tr>
                                                    <td>Tanggal Makeup</td>
                                                    <td>:</td>
                                                    <td><?= date('d F Y', strtotime($values['tanggal_makeup'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu</td>
                                                    <td>:</td>
                                                    <td><?= $values['waktu_makeup']; ?></td>
                                                </tr>
                                            </table>
                                            <div class="action">
                                                <div class="delete-reservasi">
                                                    <p style="margin: 0;"><b>Delete Reservasi</b></p>
                                                    <form action="/reservasi/<?= $values['id_reservasi']; ?>" method="post" class="d-inline">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger mt-2" onclick="return confirm('reservasi akan dihapus'); "> Hapus</button>
                                                    </form>
                                                </div>
                                                <div class="update-status">
                                                    <?php if ($values['status_booking'] != "Selesai") : ?>
                                                        <p style="margin: 0;"><b>Update Status</b></p>
                                                        <?php if ($values['status_booking']) ?>
                                                        <div class="update-status">
                                                            <form action="/status/<?= $values['id_reservasi']; ?>" method="post" class="d-inline">
                                                                <?= csrf_field(); ?>
                                                                <?php if ($values['status_booking'] == "Selesai") {
                                                                    $status = "Menunggu";
                                                                } else {
                                                                    $status = "Selesai";
                                                                }
                                                                ?>
                                                                <input type="hidden" name="status" value="<?= $status; ?>">
                                                                <button type="submit" class="btn btn-primary mt-2 <?= ($values['status_booking'] == "Selesai") ? 'disabled' : ''; ?>" onclick="return confirm('status akan diupdate menjadi <?= ($status == 1) ? 'menunggu' : 'selesai'; ?>'); "> <?= ($status == 1) ? 'menunggu' : 'selesai'; ?></button>
                                                            </form>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="middle-table">
                                            <div class="alamat">
                                                <span><b>Alamat Costumer</b></span>
                                                <p style="width:280px"><?= $values['alamat_makeup']; ?></p>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p><b>Informasi Customer</b></p>
                                            <table>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>:</td>
                                                    <td><?= $values['Nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>NIK</td>
                                                    <td>:</td>
                                                    <td><?= $values['NIK']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>No Telepon</td>
                                                    <td>:</td>
                                                    <td><?= $values['No_HP']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td><?= $values['Alamat']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        $(document).ready(function() {
            toastr.success('<?= session()->getFlashdata('pesan'); ?>')
        })
    </script>
<?php endif; ?>
<?= $this->endSection(); ?>