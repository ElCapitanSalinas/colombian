<section class="page-contents">
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
Template::Show('finance_header.php'); 
?>




<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-money" fa-lg style="color:#FFFFFF"></i> <?php echo $title?></font></b></h5>
        <div class="card-body">
        <table class="table table-bordered" width="600px">
		<tr class="balancesheet_header">
		<td align="" colspan="2">Offer and expense</td>
	</tr>
	<tr>
		<td align="right">Revenues per flight: <br />
			Número de vuelos: <?php echo $month_data->total; ?>
		</td>
		<td align="right" valign="top"><?php echo FinanceData::FormatMoney($month_data->gross);?></td>
	</tr>
	
	<tr>
		<td align="right">Pilot payments: </td>
		<td align="right"> <?php echo str_replace('$', Config::Get('MONEY_UNIT'), FinanceData::FormatMoney(-1*$month_data->pilotpay));?></td>
	</tr>
	<tr>
		<td align="right">Fuel Expenses: </td>
		<td align="right"> <?php echo str_replace('$', Config::Get('MONEY_UNIT'), FinanceData::FormatMoney(-1*$month_data->fuelprice));?></td>
	</tr>
	
	<tr class="balancesheet_header" style="border-bottom: 1px dotted">
		<td align="" colspan="2" style="padding: 1px;"></td>
	</tr>
	
	<tr>
		<td align="right"><strong>Total:</strong></td>
		<td align="right"> <?php 
		$running_total = $month_data->gross - $month_data->pilotpay - $month_data->fuelprice;
		echo str_replace('$', Config::Get('MONEY_UNIT'), FinanceData::FormatMoney($running_total));?></td>
	</tr>
	
	<tr class="balancesheet_header">
		<td align="" colspan="2">Expenses (Monthly)</td>
	</tr>

<?php
	/* COUNT EXPENSES */
	if(!is_array($month_data->expenses))
	{
		$month_data->expenses = array();
		?>
		<tr>
		<td align="right">None</td>
		<td align="right"> <?php echo str_replace('$', Config::Get('MONEY_UNIT'), FinanceData::FormatMoney(0));?></td>
	</tr>
	<?php
	}
		
	$type = Config::Get('EXPENSE_TYPES');
	
	foreach($month_data->expenses as $expense)
	{
	?>		
	<tr>
		<td align="right"><?php echo $expense->name.'<br />'.$type[$expense->type]; ?>: </td>
		<td align="right"> <?php echo str_replace('$', Config::Get('MONEY_UNIT'), FinanceData::FormatMoney(-1 * $expense->total));?></td>
	</tr>
	<?php
		# Load charts data too
		OFCharts::add_data_set($expense->name, $expense->total);		
	}
	?>
	<tr class="balancesheet_header" style="border-bottom: 1px dotted">
		<td align="" colspan="2" style="padding: 1px;"></td>
	</tr>
	<tr>
		<td align="right"><strong>Total expenses:</strong></td>
		<td align="right"> <?php echo str_replace('$', Config::Get('MONEY_UNIT'), FinanceData::FormatMoney(-1 * $month_data->expenses_total));?></td>
	</tr>
	
	<tr class="balancesheet_header">
		<td align="" colspan="2">Total revenues</td>
	</tr>
	
	<tr class="balancesheet_header" style="border-bottom: 1px dotted">
		<td align="" colspan="2" style="padding: 1px;"></td>
	</tr>
	<tr>
		<td align="right"><strong>revenue:</strong></td>
		<td align="right"> <?php echo str_replace('$', Config::Get('MONEY_UNIT'), FinanceData::FormatMoney($month_data->revenue)); ?></td>
	</tr>
	</table>
	</div>
</section>

<section class="page-contents">
<div class="container">
<br />
<div class="row">
  <div class="col-sm-1">
  </div>
  <div class="col-lg-10">
        <div class="card w-175">
        <h5 class="card-header" style="background-color: #0A1437;"><b><font color="#FFFFFF"><i class="fa fa-sort-asc" fa-lg style="color:#FFFFFF"></i> Statistic</font></b></h5>
        <div class="card-body">
        <div align="center">
			<?php
			/*
				Added in 2.0!
			*/
			$chart_width = '800';
			$chart_height = '500';

			/* Don't need to change anything below this here */
			?>
			<div align="center" style="width: 100%;">
				<div align="center" id="summary_chart"></div>
			</div>

			<script type="text/javascript" src="<?php echo fileurl('/lib/js/ofc/js/json/json2.js')?>"></script>
			<script type="text/javascript" src="<?php echo fileurl('/lib/js/ofc/js/swfobject.js')?>"></script>
			<script type="text/javascript">
			swfobject.embedSWF("<?php echo fileurl('/lib/js/ofc/open-flash-chart.swf');?>", 
				"summary_chart", "<?php echo $chart_width;?>", "<?php echo $chart_height;?>", 
				"9.0.0", "expressInstall.swf", 
				{"data-file":"<?php echo actionurl('/finances/viewexpensechart?'.$_SERVER['QUERY_STRING']); ?>"});
			</script>
			<?php
			/* End added in 2.0
			*/
			?>
			</div>

	</div>
</section>


</div>
</section>
