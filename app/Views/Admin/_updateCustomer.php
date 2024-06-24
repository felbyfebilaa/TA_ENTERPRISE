<?php foreach ($customers as $index => $values) : ?>
    <div class="modal fade" id="modal-lg-<?= $values['NIK']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/Admin/updateCustomer/<?= $values['NIK']; ?>" method="POST">
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Nama Customer</td>
                                <td> : </td>
                                <td>
                                    <input type="text" name="nama" value="<?= $values['Nama']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>KTP</td>
                                <td> : </td>
                                <td>
                                    <input type="text" name="nik" value="<?= $values['NIK']; ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td> : </td>
                                <td>
                                    <input type="text" name="notelp" value="<?= $values['No_HP']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td> : </td>
                                <td>
                                    <input type="text" name="alamat" value="<?= $values['Alamat']; ?>">
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
<?php endforeach; ?>