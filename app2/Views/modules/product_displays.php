<?= $this->extend("general/template") ?>

<?= $this->section("page_title") ?>
Data Barang StokOpname
<?= $this->endSection() ?>

<?= $this->section("page_breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
<li class="breadcrumb-item active" aria-current="page">Stok Opname</li>
<?= $this->endSection() ?>

<?= $this->section("page_content"); ?>

<!-- Modal Add -->
<form method="post" action="<?= base_url("products/stokOpname/add") ?>">
    <div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah</h5>
                    <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>Barang</label>
                        <select name="product" class="form-control select2bs4-modalAdd">
                            <?php
                            foreach ($products as $product){
                                echo"<option value='".$product->id."'>".$product->name."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gudang</label>
                        <select name="warehouse" class="form-control">
                            <?php
                            foreach ($warehouses as $warehouse){
                                echo"<option value='".$warehouse->id."'>".$warehouse->name."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type='date' name='date' value="<?= date("Y-m-d") ?>" required class='form-control'>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type='number' name='qty' class='form-control' required value="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class='fa fa-plus'></i>
                        Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Of Modal Add --> 

<!-- Modal Edit -->
<form method="post" action="<?= base_url("products/stokOpname/save") ?>">
    <div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
                    <button style="color: white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type='hidden' name='id' id='idEdit'>                    
                    <div class="form-group">
                        <label>Barang</label>
                        <select name="product" id="productEdit" class="form-control select2bs4-modalAdd">
                            <?php
                            foreach ($products as $product){
                                echo"<option value='".$product->id."'>".$product->name."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gudang</label>
                        <select name="warehouse" id="warehouseEdit" class="form-control">
                            <?php
                            foreach ($warehouses as $warehouse){
                                echo"<option value='".$warehouse->id."'>".$warehouse->name."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type='date' name='date' id="dateEdit" required class='form-control'>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type='number' name='qty' id="qtyEdit" class='form-control' required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class='fa fa-save'></i>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Of Modal Edit -->

<div class="row">
    <div class="col-md-12">
        <buttoh type='button' class='btn btn-primary float-right' data-toggle='modal' data-target='#modalAdd'>
            <i class='fa fa-plus'></i>
            Tambah
        </buttoh>
        <div class="clearfix"></div>
        <div class="card mt-2">
            <div class="card-header bg-info">
                <h5 class="card-title">Data Barang</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered table-hovered" id="datatables-default">
                    <thead>
                        <tr>
                            <th class='text-center'>No</th>
                            <th class='text-center'>Nama Barang</th>
                            <th class='text-center'>Dari Gudang</th>
                            <th class='text-center'>Tanggal</th>
                            <th class='text-center'>Jumlah</th>
                            <th></th>
                        </tr>                        
                    </thead>
                    <tbody>
                        <?php
                        $displayNo = 0;
                        foreach($displays as $display) {
                            $displayNo++;
                            ?>
                            <tr>
                                <td class='text-center'><?= $displayNo; ?></td>
                                <td><?= $display->product_name ?></td>
                                <td><?= $display->warehouse_name ?></td>
                                <td class='text-right'>
                                    <?= date("d-m-Y", strtotime($display->display_date)) ?>
                                </td>
                                <td class='text-right'>
                                    <?= $display->display_qty ?> <?= $display->product_unit ?>
                                </td>
                                <td class='text-center'>
                                    <buttoh type='button' class='btn btn-sm btn-success' onclick="edit(
                                        '<?= $display->display_id ?>',''
                                    )" data-toggle='modal' data-target='#modalEdit'>
                                        <i class='fa fa-edit'></i>
                                    </buttoh>
                                    <a href="<?= base_url('products/stokOpname/'.$display->display_id.'/delete') ?>" class='btn btn-sm btn-danger' onclick="return confirm('Yakin hapus data perbaikan (service) Barang.?')">
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
            <div class="card-footer"></div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section("page_script") ?>

<script>

function edit(id){
    $.ajax({
        url: "<?= base_url('product/displays/ajax/edit') ?>",
        type: "post",
        data: {
            id     : id,
        },
        success: function(html) {
            response = JSON.parse(html)
            $("#idEdit").val(response.id)
            $("#productEdit").val(response.product_id).change()
            $("#warehouseEdit").val(response.warehouse_id).change()
            $("#dateEdit").val(response.date)
            $("#qtyEdit").val(response.quantity)
            $("#detailsEdit").html(response.details)
        }
    })
}
</script>

<?= $this->endSection() ?>