<?php $this->load->view("partial/header"); ?>
<br />
<h3><?php echo $this->lang->line('common_welcome_message'); ?></h3>
<div class="col-md-12" id="">
	<div class="row col-md-12">
		<?php
		foreach($allowed_modules->result() as $module)
		{
			?>
			<div align="center" class="module_item col-md-3">
				<a href="<?php echo site_url("$module->module_id");?>">
					<img width="80px" height="80px" src="<?php echo base_url().'images/menubar/'.$module->module_id.'.png';?>" border="0" alt="" /></a><br /><br />
				<a href="<?php echo site_url("$module->module_id");?>"><button class="btn btn-sm btn-warning"><?php echo $this->lang->line("module_".$module->module_id) ?></button></a>
			</div>
			<?php
		}
		?>
	</div>
</div>
<?php $this->load->view("partial/footer"); ?>