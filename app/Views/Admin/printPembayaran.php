<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->
    <title>Laporan Pembayaran - <?= date('d-m-Y') ?></title>
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
<h2 style="text-align: center;">Laporan Pembayaran </h2>
<table border="1" cellpadding="1" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th style="text-align: center; width:6%;">No</th>
        <th style="text-align: center; width:15%;">Nama Customer</th>
        <th style="text-align: center; width:12%;">KTP</th>
        <th style="text-align: center; width:12%;">No Telepon</th>
        <th style="text-align: center; width:12%;">Tanggal Pembayaran</th>
        <th style="text-align: center; width:12%;">Biaya Admin</th>
        <th style="text-align: center; width:12%;">Total Pembayaran</th>
        <th style="text-align: center; width:12%;">Nama Rekening</th>
        <th style="text-align: center; width:12%;">Atas Nama</th>
        <th style="text-align: center; width:12%;">No. Rek</th>
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
</body>

</html>