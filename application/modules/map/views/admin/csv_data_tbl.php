<!--main content start-->
<section id="main-content" class="">
    <section class="wrapper">
    <!-- page start-->
    <!-- page start-->


    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    Block level button
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-cog"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
                </header>
                <div class="panel-body">
                <a href="create_categories_tbl?tbl='.<?php echo $tbl ;?>.'&& id='.<?php echo $tbl ;?>">    <button type="button" class="btn btn-warning btn-lg btn-block">Create Table</button></a>

                </div>
                <div class="panel-body"> <?php //print_r(base64_decode($categoryname));die; ?>
                <!-- <a href="<?php echo base_url(FOLDER_ADMIN) ?>/csvtable/upload_csv_emerg/?tbl='.<?php echo $tbl ;?>.'&& id='.<?php echo $tbl ;?>.'&& catname='.<?php echo $categoryname ;?>">    <button type="button" class="btn btn-info btn-lg btn-block">Upload Csv</button></a> -->
                <a href="<?php echo base_url(FOLDER_ADMIN) ?>/csvtable/upload_layer/?tbl='.<?php echo $tbl ;?>.'&& id='.<?php echo $tbl ;?>.'&& catname='.<?php echo $categoryname ;?>">    <button type="button" class="btn btn-info btn-lg btn-block">Upload Csv</button></a>

                </div>
            </section>

        </div>
    </div>

    <!-- page end-->
    </section>
</section>
<!--main content end-->
