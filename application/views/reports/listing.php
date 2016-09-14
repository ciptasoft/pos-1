
<?php $this->load->view("partial/header"); ?>
<div id="page_title" style="margin-bottom:8px;"><?php echo $this->lang->line('reports_reports'); ?></div>
<div id="welcome_message"><?php echo $this->lang->line('reports_welcome_message'); ?>
<ul id="report_list">
	<li><h3><?php echo $this->lang->line('reports_graphical_reports'); ?></h3>
		<ul>
			<li><a href="<?php echo site_url('reports/graphical_summary_sales');?>"><button class="btn"><?php echo $this->lang->line('reports_sales'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/graphical_summary_categories');?>"><button class="btn "><?php echo $this->lang->line('reports_categories'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/graphical_summary_customers');?>"><button class="btn"><?php echo $this->lang->line('reports_customers'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/graphical_summary_suppliers');?>"><button class="btn"><?php echo $this->lang->line('reports_suppliers'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/graphical_summary_items');?>"><button class="btn"><?php echo $this->lang->line('reports_items'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/graphical_summary_employees');?>"><button class="btn"><?php echo $this->lang->line('reports_employees'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/graphical_summary_taxes');?>"><button class="btn"><?php echo $this->lang->line('reports_taxes'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/graphical_summary_discounts');?>"><button class="btn"><?php echo $this->lang->line('reports_discounts'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/graphical_summary_payments');?>"><button class="btn"><?php echo $this->lang->line('reports_payments'); ?></button></a></li>
		</ul>
	</li>
	
	<li><h3><?php echo $this->lang->line('reports_summary_reports'); ?></h3>
		<ul>
			<li><a href="<?php echo site_url('reports/summary_sales');?>"><button class="btn"><?php echo $this->lang->line('reports_sales'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/summary_categories');?>"><button class="btn"><?php echo $this->lang->line('reports_categories'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/summary_customers');?>"><button class="btn"><?php echo $this->lang->line('reports_customers'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/summary_suppliers');?>"><button class="btn"><?php echo $this->lang->line('reports_suppliers'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/summary_items');?>"><button class="btn"><?php echo $this->lang->line('reports_items'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/summary_employees');?>"><button class="btn"><?php echo $this->lang->line('reports_employees'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/summary_taxes');?>"><button class="btn"><?php echo $this->lang->line('reports_taxes'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/summary_discounts');?>"><button class="btn"><?php echo $this->lang->line('reports_discounts'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/summary_payments');?>"><button class="btn"><?php echo $this->lang->line('reports_payments'); ?></button></a></li>
		</ul>
	</li>
	
	<li><h3><?php echo $this->lang->line('reports_detailed_reports'); ?></h3>
		<ul>
			<li><a href="<?php echo site_url('reports/detailed_sales');?>"><button class="btn"><?php echo $this->lang->line('reports_sales'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/detailed_receivings');?>"><button class="btn"><?php echo $this->lang->line('reports_receivings'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/specific_customer');?>"><button class="btn"><?php echo $this->lang->line('reports_customer'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/specific_employee');?>"><button class="btn"><?php echo $this->lang->line('reports_employee'); ?></button></a></li>
		</ul>
	
	</li>
	
	<li><h3><?php echo $this->lang->line('reports_inventory_reports'); ?></h3>
		<ul>
			<li><a href="<?php echo site_url('reports/inventory_low');?>"><button class="btn"><?php echo $this->lang->line('reports_low_inventory'); ?></button></a></li>
			<li><a href="<?php echo site_url('reports/inventory_summary');?>"><button class="btn"><?php echo $this->lang->line('reports_inventory_summary'); ?></button></a></li>
		</ul>
	</li>
</ul>
<?php
if(isset($error))
{
	echo "<div class='error_message'>".$error."</div>";
}
?>
<?php $this->load->view("partial/footer"); ?>

<script type="text/javascript" language="javascript">
$(document).ready(function()
{
});
</script>
