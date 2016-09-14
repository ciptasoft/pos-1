<?php $this->load->view("partial/header"); ?>
    <div id="page_title"><?php echo $this->lang->line('module_cashier'); ?></div>
    <!--<h3><?php echo $this->lang->line('common_welcome_message'); ?></h3>-->
    <div class="col-md-12" id="">
        <div class="row col-md-12">
				<div id="register_wrapper">
<?php echo form_open("sales/change_mode",array('id'=>'mode_form')); ?>
	<span><?php echo $this->lang->line('sales_mode') ?></span>
	<br>
<?php /*echo form_dropdown('mode',$modes,$mode,'class="form-control" style="width:250px; margin:2px;" onchange="$(\'#mode_form\').submit();"');*/ ?>
	<br>
<div id="show_suspended_sales_button">
	<?php echo anchor("sales/suspended/width:425",
	"<div><button class='btn btn-sm btn-warning'>".$this->lang->line('sales_suspended_sales')."</button></div>",
	array('class'=>'thickbox none','title'=>$this->lang->line('sales_suspended_sales')));
	?>
</div>

</form>
<?php echo form_open("sales/add",array('id'=>'add_item_form')); ?>
<label id="item_label" for="item">

<?php
/*if($mode=='sale')
{
	echo $this->lang->line('sales_find_or_scan_item');
}
else
{
	echo $this->lang->line('sales_find_or_scan_item_or_receipt');
}*/
?>
</label>
<?php echo form_input(array('style'=>'width:350px; margin:2px;', 'class'=>'form-control','name'=>'item','id'=>'item','size'=>'40'));?>
<div id="new_item_button_register">
		<?php echo anchor("items/view/-1/width:360",
		"<div><button class='btn btn-warning btn-sm'>".$this->lang->line('sales_new_item')."</button></div>",
		array('class'=>'thickbox none','title'=>$this->lang->line('sales_new_item')));
		?>
	</div>

</form>
<table id="register">
<thead>
<tr>
<!--<th style="width:11%;"><?php echo $this->lang->line('common_delete'); ?></th>-->
<!--<th style="width:10%;"><?php echo $this->lang->line('sales_item_number'); ?></th>-->
<th style="width:30%;"><?php echo $this->lang->line('sales_item_name'); ?></th>
<th style="width:11%;"><?php echo $this->lang->line('sales_price'); ?></th>
<th style="width:11%;"><?php echo $this->lang->line('sales_quantity'); ?></th>
<!--<th style="width:11%;"><?php echo $this->lang->line('sales_discount'); ?></th>-->
<th style="width:15%;"><?php echo $this->lang->line('sales_total'); ?></th>
<th style="width:10%;"><label>Action</label></th>
<!--<th style="width:11%;"><?php echo $this->lang->line('sales_edit'); ?></th>-->
</tr>
</thead>
<tbody id="cart_contents">
<?php
$cart=1;
//if(count($cart)==0)
if($cart==0)
{
?>
<tr><td colspan='8'>
<div class='warning_message' style='padding:7px;'><?php echo $this->lang->line('sales_no_items_in_cart'); ?></div>
</tr></tr>


<?php 
	
}
?>

<?php
	foreach($items as $line)
	{
		
		//$this->output->enable_profiler(TRUE);
	?>
		<tr>
		<td style="align:center;">
		<input name="item_name" type="text" value="<?php echo $line["name"]; ?>" style="display:none;"/>
		<input name="unit_price" type="text" value="<?php echo $line["unit_price"]; ?>" style="display:none;"/>
		
		
		
		<?php echo $line["name"]; ?></td>
		<td><?php echo $line["unit_price"]; ?></td>
		<td><input name="item_qty" type="text" value="1" size="3" style="text-align:center;" align="center"/></td>
		<!--<td><?php echo $line["name"]; ?></td>-->
		<td><?php echo $line["unit_price"]; ?></td>
		<td><button class="btn btn-primary item-add">ADD</button><!--<?php echo form_submit("edit_item", $this->lang->line('sales_edit_item'));?>--></td>
		</tr>
		
	<?php
	}
?>
		

<?php
/*else
{
	foreach(array_reverse($cart, true) as $line=>$item)
	{
		$cur_item_info = $this->Item->get_info($item['item_id']);
		echo form_open("sales/edit_item/$line");
	?>
		<tr>
		<td><?php echo anchor("sales/delete_item/$line",'['.$this->lang->line('common_delete').']');?></td>
		<td><?php echo $item['item_number']; ?></td>
		<td style="align:center;"><?php echo $item['name']; ?><br /> [<?php echo $cur_item_info->quantity; ?> in stock]</td>



		<?php if ($items_module_allowed)
		{
		?>
			<td><?php echo form_input(array('name'=>'price','value'=>$item['price'],'size'=>'6'));?></td>
		<?php
		}
		else
		{
		?>
			<td><?php echo $item['price']; ?></td>
			<?php echo form_hidden('price',$item['price']); ?>
		<?php
		}
		?>

		<td>
		<?php
        	if($item['is_serialized']==1)
        	{
        		echo $item['quantity'];
        		echo form_hidden('quantity',$item['quantity']);
        	}
        	else
        	{
        		echo form_input(array('name'=>'quantity','value'=>$item['quantity'],'size'=>'2'));
        	}
		?>
		</td>

		<td><?php echo form_input(array('name'=>'discount','value'=>$item['discount'],'size'=>'3'));?></td>
		<td><?php echo to_currency($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100); ?></td>
		<td><?php echo form_submit("edit_item", $this->lang->line('sales_edit_item'));?></td>
		</tr>
		<tr>
		<td style="color:#2F4F4F";><?php echo $this->lang->line('sales_description_abbrv').':';?></td>
		<td colspan=2 style="text-align:left;">

		<?php
        	if($item['allow_alt_description']==1)
        	{
        		echo form_input(array('name'=>'description','value'=>$item['description'],'size'=>'20'));
        	}
        	else
        	{
				if ($item['description']!='')
				{
					echo $item['description'];
        			echo form_hidden('description',$item['description']);
        		}
        		else
        		{
        			echo 'None';
        			echo form_hidden('description','');
        		}
        	}
		?>
		</td>
		<td>&nbsp;</td>
		<td style="color:#2F4F4F";>
		<?php
        	if($item['is_serialized']==1)
        	{
				echo $this->lang->line('sales_serial').':';
			}
		?>
		</td>
		<td colspan=3 style="text-align:left;">
		<?php
        	if($item['is_serialized']==1)
        	{
        		echo form_input(array('name'=>'serialnumber','value'=>$item['serialnumber'],'size'=>'20'));
			}
			else
			{
				echo form_hidden('serialnumber', '');
			}
		?>
		</td>
		</tr>
		<tr style="height:3px">
		<td colspan=8 style="background-color:white"> </td>
		</tr>		</form>
	<?php
	}
}*/

?>
</tbody>
</table>
</div>


<div id="overall_sale">
<label>Item List</label>
	<div class="div-add-item-list" style="background-color:white;border-radius:4px;width:100%;">
		<table id="table-add-item-list" border='1' style='width:100%;border:solid thin lightgray;'>
			<thead>
				<td>Item Name</td><td>Price</td><td>Qty</td><td>Total</td>
			</thead>
			<tbody>
				<tr>
					<td colspan="3" align="center">
						<div class="item-div-list">No Item(s) Added</div></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
	if(isset($customer))
	{
		echo $this->lang->line("sales_customer").': <b>'.$customer. '</b><br />';
		echo anchor("sales/remove_customer",'['.$this->lang->line('common_remove').' '.$this->lang->line('customers_customer').']');
	}
	else
	{
		echo form_open("sales/select_customer",array('id'=>'select_customer_form')); ?>
		<label id="customer_label" for="customer"><?php echo $this->lang->line('sales_select_customer'); ?></label>
		<?php echo form_input(array('class'=>'form-control','name'=>'customer','id'=>'customer','size'=>'30','value'=>$this->lang->line('sales_start_typing_customer_name')));?>
		</form>
		<div style="margin-top:5px;text-align:center;">
		<h3 style="margin: 5px 0 5px 0"><?php echo $this->lang->line('common_or'); ?></h3>
		<?php echo anchor("customers/view/-1/width:350",
		"<div class='small_button' style='margin:0 auto;'><button class='btn btn-sm btn-warning'>".$this->lang->line('sales_new_customer')."</button></div>",
		array('class'=>'thickbox none','title'=>$this->lang->line('sales_new_customer')));
		?>
		</div>
		<div class="clearfix">&nbsp;</div>
		<?php
	}
	?>

	<div id='sale_details'>
		<div class="float_left" style="width:55%;"><?php echo $this->lang->line('sales_sub_total'); ?>:</div>
		<div class="float_left" style="width:45%;font-weight:bold;"><?php echo to_currency($subtotal); ?></div>

		<?php foreach($taxes as $name=>$value) { ?>
		<div class="float_left" style='width:55%;'><?php echo $name; ?>:</div>
		<div class="float_left" style="width:45%;font-weight:bold;"><?php echo to_currency($value); ?></div>
		<?php }; ?>

		<div class="float_left" style='width:55%;'><?php echo $this->lang->line('sales_total'); ?>:</div>
		<div class="float_left" style="width:45%;font-weight:bold;"><?php echo to_currency($total); ?></div>
	</div>




	<?php
	// Only show this part if there are Items already in the sale.
	if(count($cart) > 0)
	{
	?>

    	<div id="Cancel_sale">
		<?php echo form_open("sales/cancel_sale",array('id'=>'cancel_sale_form')); ?>
		<div class='small_button' id='cancel_sale_button' style='margin-top:5px;'>
			<span><?php echo $this->lang->line('sales_cancel_sale'); ?></span>
		</div>
    	</form>
    	</div>
		<div class="clearfix" style="margin-bottom:1px;">&nbsp;</div>
		<?php
		// Only show this part if there is at least one payment entered.
		if(count($payments) > 0)
		{
		?>
			<div id="finish_sale">
				<?php echo form_open("sales/complete",array('id'=>'finish_sale_form')); ?>
				<label id="comment_label" for="comment"><?php echo $this->lang->line('common_comments'); ?>:</label>
				<?php echo form_textarea(array('name'=>'comment', 'id' => 'comment', 'value'=>$comment,'rows'=>'4','cols'=>'23'));?>
				<br /><br />
				
				<?php
				
				if(!empty($customer_email))
				{
					echo $this->lang->line('sales_email_receipt'). ': '. form_checkbox(array(
					    'name'        => 'email_receipt',
					    'id'          => 'email_receipt',
					    'value'       => '1',
					    'checked'     => (boolean)$email_receipt,
					    )).'<br />('.$customer_email.')<br />';
				}
				 
				if ($payments_cover_total)
				{
					echo "<div class='small_button' id='finish_sale_button' style='float:left;margin-top:5px;'><span>".$this->lang->line('sales_complete_sale')."</span></div>";
				}
				echo "<div class='small_button' id='suspend_sale_button' style='float:right;margin-top:5px;'><span>".$this->lang->line('sales_suspend_sale')."</span></div>";
				?>
			</div>
			</form>
		<?php
		}
		?>



    <table width="100%"><tr>
    <td style="width:55%; "><div class="float_left"><?php echo 'Payments Total:' ?></div></td>
    <td style="width:45%; text-align:right;"><div class="float_left" style="text-align:right;font-weight:bold;"><?php echo to_currency($payments_total); ?></div></td>
	</tr>
	<tr>
	<td style="width:55%; "><div class="float_left" ><?php echo 'Amount Due:' ?></div></td>
	<td style="width:45%; text-align:right; "><div class="float_left" style="text-align:right;font-weight:bold;"><?php echo to_currency($amount_due); ?></div></td>
	</tr></table>

	<div id="Payment_Types" >

		<div style="height:100px;">

			<?php echo form_open("sales/add_payment",array('id'=>'add_payment_form')); ?>
			<table width="100%">
			<tr>
			<td>
				<?php echo $this->lang->line('sales_payment').':   ';?>
			</td>
			<td>
				<?php echo form_dropdown('payment_type',$payment_options,array(), 'id="payment_types"');?>
			</td>
			</tr>
			<tr>
			<td>
				<span id="amount_tendered_label"><?php echo $this->lang->line('sales_amount_tendered').': ';?></span>
			</td>
			<td>
				<?php echo form_input(array('name'=>'amount_tendered','id'=>'amount_tendered','value'=>to_currency_no_money($amount_due),'size'=>'10'));	?>
			</td>
			</tr>
        	</table>
			<div class='small_button' id='add_payment_button' style='float:left;margin-top:5px;'>
				<span><?php echo $this->lang->line('sales_add_payment'); ?></span>
			</div>
		</div>
		</form>

		<?php
		// Only show this part if there is at least one payment entered.
		if(count($payments) > 0)
		{
		?>
	    	<table id="register">
	    	<thead>
			<tr>
			<th style="width:11%;"><?php echo $this->lang->line('common_delete'); ?></th>
			<th style="width:60%;"><?php echo 'Type'; ?></th>
			<th style="width:18%;"><?php echo 'Amount'; ?></th>


			</tr>
			</thead>
			<tbody id="payment_contents">
			<?php
				foreach($payments as $payment_id=>$payment)
				{
				echo form_open("sales/edit_payment/$payment_id",array('id'=>'edit_payment_form'.$payment_id));
				?>
	            <tr>
	            <td><?php echo anchor("sales/delete_payment/$payment_id",'['.$this->lang->line('common_delete').']');?></td>


				<td><?php echo  $payment['payment_type']    ?> </td>
				<td style="text-align:right;"><?php echo  to_currency($payment['payment_amount'])  ?>  </td>


				</tr>
				</form>
				<?php
				}
				?>
			</tbody>
			</table>
		    <br />
		<?php
		}
		?>



	</div>

	<?php
	}
	?>
</div>



        </div>
    </div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".item-add").click(function(){
			var div_add_items = $("#table-add-item-list tbody");
			var div_add_items_html = $("#table-add-item-list tbody").html();
			var ths = $(this);
				var tr =  ths.closest("tr"),
						item_name = tr.find("input[name='item_name']").val(),
						unit_price = tr.find("input[name='unit_price']").val(),
						item_qty = tr.find("input[name='item_qty']").val(),
						item_total = unit_price*item_qty;
					
					var newTr = "<tr><td>"+item_name+"</td><td>"+unit_price+"</td><td>"+item_qty+"</td><td>"+item_total+"</td></tr>";
						var newItemList = div_add_items_html+""+newTr;
					div_add_items.html(newItemList);
					//alert(div_add_items_html);
				/*
				<div class="div-item-list" style="background-color:white;border-radius:4px;width:100%;">
					<table id="table-add-item-list" border='1' style='width:100%;border:solid thin lightgray;'>
						<thead>
							<td>Item Name</td><td>Qty</td><td>Total</td>
						</thead>
						<tbody>
							<tr>
								<td colspan="3" align="center">
								<div class="item-div-list">No Item(s) Added</div></td>
							</tr>
						</tbody>
					</table>
				</div>
				
				
				
							<input name="item_name" type="text" value="<?php echo $line["name"]; ?>" style="display:none;"/>
		<input name="item_price" type="text" value="<?php echo $line["unit_price"]; ?>" style="display:none;"/>
		<input name="item_qty" type="text" value="<?php echo $line["name"]; ?>" style="display:none;"/>
				*/
		});
	});
</script>
<?php $this->load->view("partial/footer"); ?>