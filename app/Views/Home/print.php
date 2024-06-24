<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css"> -->
    <title><?= $transaksi['Nama']; ?></title>
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
    <h2 style="text-align: center;">Bukti Reservasi MakeUp. <br> Makeup By Eby <br> </h2>
    <div class="data-customer">
        <table>
            <tr>
                <td>Nama Customer</td>
                <td>:</td>
                <td><?= $transaksi['Nama']; ?></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>:</td>
                <td><?= $transaksi['No_HP']; ?></td>
            </tr>
            <tr>
                <td>Tanggal MakeUp</td>
                <td>:</td>
                <td><?= date('d F Y', strtotime($transaksi['tanggal_makeup'])); ?></td>
            </tr>
            <tr>
                <td>Alamat MakeUp</td>
                <td>:</td>
                <td><?= $transaksi['alamat_makeup']; ?></td>
            </tr>
        </table>
    </div>
    <div class="data-tranksaksi">
        <table>
            <tr>
                <td>Nama Paket</td>
                <td>:</td>
                <td style="text-align:right;"><?= $transaksi['nama_paket_makeup']; ?></td>
            </tr>
            <tr>
                <td>Harga Paket</td>
                <td>:</td>
                <td style="text-align:right;"><?= 'Rp ' . number_format($transaksi['harga_paket_makeup'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Biaya Admin</td>
                <td>:</td>
                <td style="text-align:right;"><?= 'Rp ' . number_format($transaksi['biaya_admin'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Total Pembayaran</td>
                <td>:</td>
                <td style="text-align:right;"><?= 'Rp ' . number_format($transaksi['jumlah_pembayaran'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td>:</td>
                <td style="text-align:right;"><?= $transaksi['nama_rekening']; ?></td>
            </tr>
        </table>
    </div>
</body>

</html>