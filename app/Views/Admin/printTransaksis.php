<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->
    <title>Laporan Transaksi - <?= date('d-m-Y') ?></title>
    <style>
        .data-customer {
            float: left;
            position: absolute;
            top: 66;
        }

        .data-tranksaksi {
            float: right;
            position: absolute;
            top: 60;
        }
    </style>
</head>

<body>
<h2 style="text-align: center;">Laporan Transaksi </h2>
<table border="1" cellpadding="1" cellspacing="0">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Customer</th>
        <th>KTP</th>
        <th>Tanggal Transaksi</th>
        <th>Biaya Admin</th>
        <th>Harga Paket</th>
        <th>Jumlah</th>
        <th>Jenis Pembayaran</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    foreach ($transaksi as $a => $values) :
        ?>
        <tr>
            <td><?= $no++; ?></td>

            <td ><?= $values['Nama']; ?></td>
            <td ><?= $values['NIK']; ?></td>
            <td style="text-align: center;"><?= date('d F Y', strtotime($values['tanggal_transaksi'])); ?></td>
            <td ><?= "Rp " . number_format($values['biaya_admin'], 0, ',', '.'); ?></td>
            <td ><?= "Rp " . number_format($values['harga_paket_makeup'], 0, ',', '.'); ?></td>
            <td ><?= "Rp " . number_format($values['jumlah_pembayaran'], 0, ',', '.'); ?></td>
            <td style="text-align: center;"><?= $values['nama_rekening']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
</body>

</html>