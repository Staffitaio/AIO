<?= $this->extend("general/template") ?>

<?= $this->section("page_title") ?>
Penjualan (SO)
<?= $this->endSection() ?>

<?= $this->section("page_breadcrumb") ?>
<li class="breadcrumb-item"><a href="<?= base_url('/dashboard'); ?>">Home</a></li>
<li class="breadcrumb-item active">Penjualan (SO)</li>
<?= $this->endSection() ?>

<?= $this->section("page_content") ?>

<div class="row">
    <div class="col-md-12">        
        <div class="card">
            <div class="card-header bg-info">
                Data Penjualan
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered" id="datatables-default">
                    <thead>
                        <tr>
                            <th class='text-center'>No</th>
                            <th class='text-center'>Tgl. Transaksi</th>
                            <th class='text-center'>Tgl. Jatuh Tempo</th>
                            <th class='text-center'>Sales</th>
                            <th class='text-center'>Pelanggan</th>
                            <th class='text-center'>Status</th>
                            <th class='text-center'>Tags</th>
                            <th class='text-center'>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($sales as $sale){
                            ?>
                            <tr>
                                <td class='text-center'><?= $sale->sale_number ?></td>
                                <td class='text-right'><?= date("d-m-Y",strtotime($sale->sale_transaction_date)) ?></td>
                                <td class='text-right'><?= date("d-m-Y",strtotime($sale->sale_expired_date)) ?></td>
                                <td>
                                    <?php
                                    $admin = $db->table("administrators");
                                    $admin->where("id",$sale->sale_admin_id);
                                    $admin = $admin->get();
                                    $admin = $admin->getFirstRow();

                                    echo $admin->name;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($sale->sale_contact_id == NULL){

                                    }else{
                                        $contact = $db->table("contacts");
                                        $contact->where("id",$sale->sale_contact_id);
                                        $contact->where("type",2);
                                        $contact = $contact->get();
                                        $contact = $contact->getFirstRow();
    
                                        echo $contact->name." | ".$contact->phone;
                                    }
                                    ?>
                                </td>
                                <td class='text-center'>
                                <span class="badge badge-<?= config("App")->orderStatusColor[$sale->sale_status] ?>"><?= config("App")->orderStatuses[$sale->sale_status] ?></span>
                                </td>
                                <td><?= $sale->sale_tags ?></td>
                                <td class='text-center'>
                                    <a href="<?= base_url('supervisor/sales/'.$sale->sale_id.'/manage') ?>" class='btn btn-success btn-sm' title="Kelola Pesanan Penjualan">
                                        <i class='fa fa-cog'></i>
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

<?= $this->endSection() ?>

<?= $this->section("page_script") ?>

<?= $this->endSection() ?>