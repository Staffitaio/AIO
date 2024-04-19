<?= $this->extend("general/template") ?>

<?= $this->section("page_title") ?>
Pengelolaan Kontak
<?= $this->endSection() ?>

<?= $this->section("page_breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('/dashboard'); ?>">Home</a></li>
<li class="breadcrumb-item active">Pengelolaan Kontak</li>
<?= $this->endSection() ?>

<?= $this->section("page_content") ?>

<!-- Modal Add -->
<form method="post" action="<?= base_url("contacts/add") ?>">
    <div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Kontak</h5>
                    <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="phone">No. Telepon</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="No. Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="nama" required>
                    </div>
                    <div class='form-group mt-4'>
                        <label>Tipe</label>
                        <br>
                        <label class="mx-2">
                            <input type='radio' name='type' value="1" checked>
                            Pemasok
                        </label>
                        <label class="mx-2">
                            <input type='radio' name='type' value="2">
                            Pelanggan
                        </label>
                    </div>
                    
                    <!-- <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
                    </div> -->
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" name="address" id="address" rows="3" placeholder="alamat" required></textarea>
                    </div>
                    <!-- <div class="form-group">
                        <label for="phone">No. Referensi</label>
                        <input type="text" class="form-control" id="reference" name="reference" placeholder="No. Referensi" required>
                    </div> -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Of Modal Add -->

<!-- Modal Add -->
<form method="post" action="<?= base_url("contacts/edit") ?>">
    <div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Kontak</h5>
                    <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editContact">
                    <div class="form-group">
                        <label for="editName">Nama</label>
                        <input type="text" class="form-control" id="editName" name="name" placeholder="nama" required>
                    </div>
                    <div class='form-group mt-4'>
                        <label>Tipe</label>
                        <br>
                        <label class="mx-2">
                            <input type='radio' id="editTypeSupplier" value='1' name='type'>
                            Pemasok
                        </label>
                        <label class="mx-2">
                            <input type='radio' id="editTypeCustomer" value='2' name='type'>
                            Pelanggan
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="editPhone">No. Telepon</label>
                        <input type="text" class="form-control" id="editPhone" name="phone" placeholder="No. Telepon" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" placeholder="email" required>
                    </div> -->
                    <div class="form-group">
                        <label for="editAddress">Alamat</label>
                        <textarea class="form-control" name="address" id="editAddress" rows="3" placeholder="alamat" required></textarea>
                    </div>
                    <!-- <div class="form-group">
                        <label for="phone">No. Referensi</label>
                        <input type="text" class="form-control" id="editReference" name="reference" placeholder="No. Referensi" required>
                    </div> -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Of Modal Add -->


<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12 mb-3">

            <button type="button" class="btn btn-primary float-right" style="margin-left:20px;" data-toggle="modal" data-target="#modalAdd">
                <i class='fa fa-plus'></i>
                Tambah Kontak
            </button>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Pemasok</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped dataTable dtr-inline" id="datatables-default">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Nama</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $d = 0;
                            foreach ($contacts as $contact) {
                                $d++;
                            ?>
                                <tr>
                                    <td class='text-center'><?= $d ?></td>                                    
                                    <td>
                                    <?php
                                    if ($contact->type == 1) {
                                        echo 'Pemasok';
                                    } else {
                                        echo  'Pelanggan';
                                    }
                                    ?>
                                    </td>
                                    <td class="text-uppercase"><?= $contact->name ?></td>
                                    <td><?= $contact->phone ?></td>
                                    <td><?= $contact->address ?></td>
                                    <td class='text-center'>
                                        <a href="javascript:void(0)" title="Edit" onclick="edit('<?= $contact->id ?>', '<?= $contact->type ?>', '<?= $contact->name ?>','<?= $contact->phone ?>','<?= $contact->address ?>')" data-toggle="modal" data-target="#modalEdit" class="btn btn-success btn-sm text-white">
                                            <i class='fa fa-edit'></i>
                                        </a>
                                        <a href="<?= base_url('contacts') . '/' . $contact->id . '/delete' ?>" title="Hapus" onclick="return confirm('Yakin hapus kontak : <?= $contact->name ?> ?')" class='btn btn-sm btn-danger text-white'>
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function edit(id, type, name, phone, address) {
            $("#editContact").val(id)
            if (type == 1) {
                $("#editTypeSupplier").prop("checked", true);
            } else {
                $("#editTypeCustomer").prop("checked", true);
            }
            $("#editName").val(name)
            $("#editPhone").val(phone)
            // $("#editEmail").val(email)
            $("#editAddress").html(address)
            // $("#editReference").val(reference)
        }
    </script>

</div><!-- /.container-fluid -->


<?= $this->endSection() ?>