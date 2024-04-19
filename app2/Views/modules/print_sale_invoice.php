<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= config("App")->name ?> | <?= config("Company")->name ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('public/adminlte') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('public/adminlte') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="<?= base_url('public/adminlte') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('public/adminlte') ?>/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('public/adminlte') ?>/dist/css/adminlte.min.css">
    <!-- Datatable -->
    <link href="<?= base_url('/public/adminlte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
        rel="stylesheet" type="text/css">

    <style type='text/css'>
    @page {
        size: auto;
    }
    </style>

    <script type='text/javascript'>
    window.print();
    </script>
</head>

<body>

    <table class='table table-bordered'>
        <tbody>
            <tr>
                <td class='text-center'>
                    <h2>INVOICE</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class='table table-bordered'>
        <tbody>
            <tr>
                <td>
                    <b><?= strtoupper(config("App")->ptName) ?></b>
                    <br>
                    <?= config("App")->companyAddress ?>
                    <br>
                    <?= config("App")->companyPhone ?>
                </td>
                <td width="50%">
                    <b><?= $contact->name ?></b>
                    <br>
                    <?= $sale->invoice_address ?>
                    <br>
                    <?= $contact->phone ?>
                </td>
                <td class='text-center align-middle'>
                    <b style='font-size:25'><?= $sale->number ?></b>
                    <br>
                    <?= date("d-m-Y", strtotime($sale->transaction_date)) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class='text-center'>Barang</th>
                <th class='text-center'>Kuantitas</th>
                <th class='text-center'>Harga</th>
                <th class='text-center'>Promo</th>
                <th class='text-center'>Diskon</th>
                <th class='text-center'>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sumPrice = 0;
            foreach($items as $item){
                $thisProduct = $db->table("products");
                $thisProduct->where("id",$item->product_id);
                $thisProduct = $thisProduct->get();
                $thisProduct = $thisProduct->getFirstRow();
                ?>
            <tr>
                <td><?= $thisProduct->name ?></td>
                <td class='text-right'><?= $item->quantity ?> <?= $thisProduct->unit ?></td>
                <td class='text-right'>Rp. <?= number_format($item->price,0,",",".") ?></td>
                <td>
                    <?php
                    if($item->promo_id == 0){
                        echo "--Tanpa Promo--";
                        $discountItem = 0;
                    }else{
                        $thisPromo = $db->table("promos");
                        $thisPromo->where("id",$item->promo_id);
                        $thisPromo = $thisPromo->get();
                        $thisPromo = $thisPromo->getFirstRow();

                        echo "(".$thisPromo->code.") &nbsp;".$thisPromo->details;
                    }
                    ?>
                </td>
                <td>
                    <?php if ($item->discount <= 100): ?>
                        <?php echo $item->discount ?>%
                    <?php elseif($item->discount >= 100): ?>
                        Rp.<?php echo number_format($item->discount, 0, ",", ".") ?>
                    <?php endif ?>
                </td>
                <td class='text-right'>
                     <?php if ($item->discount <= 100): ?>
                        <?php
                            $thisPriceCount = $item->price * $item->quantity;
                            $discountCalculate = $thisPriceCount * $item->discount / 100;
                            $sumDiscountCalculate = $thisPriceCount - $discountCalculate;
                            $taxCalculate = $sumDiscountCalculate * $item->tax / 100;
                            $sumPriceCalculate = $sumDiscountCalculate;
                                                
                            echo "Rp. ".number_format($sumPriceCalculate,0,",",".");
                                                
                            $sumPrice += $sumPriceCalculate;
                        ?>
                    <?php elseif($item->discount >= 100): ?>
                        <?php
                            $thisPriceCount = $item->price * $item->quantity;
                            $discountCalculate = ($item->discount < $thisPriceCount) ? $item->discount : $thisPriceCount;
                            $sumDiscountCalculate = $thisPriceCount - $discountCalculate;
                            $taxCalculate = $sumDiscountCalculate * $item->tax / 100;
                            $sumPriceCalculate = $sumDiscountCalculate + $taxCalculate;

                            echo "Rp. " . number_format($sumPriceCalculate, 0, ",", ".");

                            $sumPrice += $sumPriceCalculate;
                            ?>
                    <?php endif ?>   
                </td>
            </tr>
            <?php
                        }
                        ?>
        </tbody>
        <tfoot>
            <tr>
                <th class='text-right' colspan='5'>TOTAL</th>
                <th class='text-right'>Rp. <?= number_format($sumPrice,0,",",".") ?></th>
            </tr>
        </tfoot>
    </table>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td width="60%">
                    <b>Catatan :</b>
                    <br>
                    <?= nl2br($sale->sales_notes) ?>
                </td>
                <td class='text-center'>
                    <?= date("d-m-Y") ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <u>(..............................................)</u>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>