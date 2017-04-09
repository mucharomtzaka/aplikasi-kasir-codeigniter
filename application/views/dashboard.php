<section class="content">
	<div class="col-md-10">
		<div class="panel panel-default">
			<div class="panel-header">
			<?php if(isset($message)):?>
                     <?php echo $message;?>
			<?php endif;?>
				<div class="alert alert-success">
          Dashboard System <br>
        </div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="icon">
                                   <p>
                                       <i class="fa fa-dollar"></i> Sale
                                    </p>
                                </div>
                                <div class="inner">
                                <p class="alert alert-info">Sales All:
                                    <h3> 
                                       <?php foreach($pendapatan as $t):?>
                                         <?= 'Rp. ' . number_format($t->total_pendapatan, 0 , '' , '.' ) . ',-'?>
                                        <?php endforeach;?>
                                    </h3>
                                </p>
                                <p class="alert alert-success">Sales this date:
                                    <?php foreach($pendapatan_tgl as $t):?>
                                     Jumlah  : <?= 'Rp. ' . number_format($t->total_pendapatan, 0 , '' , '.' ) . ',-'?>
                                    <?php endforeach;?>
                                </p>
                                </div>
                                
                                <a href="<?php echo base_url();?>report/data_transaksi" class="small-box-footer">
                                    View <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                     <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="icon">
                                       <p>
                                           <i class="fa fa-users"></i> Users
                                        </p>
                                    </div>
                                    <div class="inner">
                                        <h3>
                                          <?= $count_users;?>
                                        </h3>
                                    </div>
                                    
                                    <a href="<?php echo base_url();?>users/index" class="small-box-footer">
                                        View <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                             </div>
                             <div class="small-box bg-aqua">
                                    <div class="icon">
                                       <p>
                                           <i class="fa fa-users"></i> Members
                                        </p>
                                    </div>
                                    <div class="inner">
                                        <h3>
                                          <?= $count_member;?>
                                        </h3>
                                    </div>
                                    
                                    <a href="<?php echo base_url();?>member/index" class="small-box-footer">
                                        View <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                             </div>
                        </div>

                     <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="icon">
                                       <p>
                                           <i class="fa fa-stack-exchange"></i> Product
                                        </p>
                                    </div>
                                    <div class="inner">
                                       <p class="alert alert-danger">Stock Sold Out : <?=$count_product_habis;?></p>
                                        <p class="alert alert-info">Stock Tersedia : <?=$count_product_tersedia;?></p>
                                         <a href="<?php echo base_url();?>product/index" class="small-box-footer">
                                        View <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                    </div>
                             </div>
                        </div>

                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                                <div class="small-box bg-aqua">
                                    <div class="icon">
                                       <p>
                                           <i class="fa fa-calendar"></i> Schedule
                                        </p>
                                    </div>
                                    <div class="inner">
                                      <h3><?=$agenda;?> </h3>
                                    </div>
                                    
                                    <a href="<?php echo base_url();?>schedule/index" class="small-box-footer">
                                        View <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                             </div>
                        </div>

                     </div>
				</div>
			</div>
		</div>
	</div>
</section>
<link rel="stylesheet" href="<?= base_url('assets/highchart/highcharts.css') ?>">
<script src="<?= base_url('assets/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/highchart/highcharts.js') ?>"></script>
<script src="<?= base_url('assets/highchart/themes/dark-blue.js') ?>"></script>
<script src="<?= base_url('assets/highchart/modules/exporting.js') ?>"></script>

<section class="content">
    <div class="col-md-10">
    <div class="panel panel-default">
    <div class="panel-header text-center">
       <h1> Panel Monitoring Sales </h1>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-7">
                 <div id="chart" style="height: 300px;"></div>
            </div>
            <div class="col-md-5">
                                        <fieldset>
                                          <legend>
                                          <i class="fa fa-cart-plus"></i>
                                          Product Terlaris  <?=date('d-m-Y');?>
                                          </legend>
                                          <table class="table">
                                              <thead>
                                                <tr>
                                                  <th>Nama Product</th>
                                                <th>Jumlah</th>
                                                </tr>
                                              </thead>
                                            <tbody>
                                              <?php foreach($product_terlaris as $t):?>
                                              <tr class="alert alert-success">
                                              <td> <?= $t->product ?></td>
                                              <td><?= $t->jml ?></td> 
                                              </tr>
                                              <?php endforeach;?>
                                            </tbody>
                                          </table>
                                        </fieldset>
            </div>
        </div>
     </div>
    </div>
    </div>
</section>
<script type="text/javascript">

Highcharts.chart('chart', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Sales Product <?=$header;?>'
    },
    subtitle: {
        text: 'Year : <?=date('Y');?>'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Quantity'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Sales',
        data: <?=json_encode($dt);?>
    }]
});

    </script>   
