<?php
require_once ("secure_area.php");
class Cashier extends Secure_area
{
    function __construct()
    {
        parent::__construct();
		$this->load->library('sale_lib');
		$this->load->model('Item');
		$this->load->model('Cash');
    }

    function index($category=NULL)
    {
		if($category==NULL){
			$item = $this->Item->get_all();
		}else{
			$item = $this->Cash->get_all_items_by_category($category);
		}
		$data["items"] = $item->result_array();
		
		$data["category"] = $this->Cash->category();
		$data["cashier_added_items"] = $this->session->userdata("cashier_added_items");
	
		$person_info = $this->Employee->get_logged_in_employee_info();
		$data['cart']=$this->sale_lib->get_cart();
		$data['modes']=array('sale'=>$this->lang->line('sales_sale'),'return'=>$this->lang->line('sales_return'));
		$data['mode']=$this->sale_lib->get_mode();
		$data['subtotal']=$this->sale_lib->get_subtotal();
		$data['taxes']=$this->sale_lib->get_taxes();
		$data['total']=$this->sale_lib->get_total();
		$data['items_module_allowed'] = $this->Employee->has_permission('items', $person_info->person_id);
		$data['comment'] = $this->sale_lib->get_comment();
		$data['email_receipt'] = $this->sale_lib->get_email_receipt();
		$data['payments_total']=$this->sale_lib->get_payments_total();
		$data['amount_due']=$this->sale_lib->get_amount_due();
		$data['payments']=$this->sale_lib->get_payments();
		$data['payment_options']=array(
			$this->lang->line('sales_cash') => $this->lang->line('sales_cash'),
			$this->lang->line('sales_check') => $this->lang->line('sales_check'),
			$this->lang->line('sales_giftcard') => $this->lang->line('sales_giftcard'),
			$this->lang->line('sales_debit') => $this->lang->line('sales_debit'),
			$this->lang->line('sales_credit') => $this->lang->line('sales_credit')
		);

		$customer_id=$this->sale_lib->get_customer();
		if($customer_id!=-1)
		{
			$info=$this->Customer->get_info($customer_id);
			$data['customer']=$info->first_name.' '.$info->last_name;
			$data['customer_email']=$info->email;
		}
		$data['payments_cover_total'] = $this->_payments_cover_total();
		#$this->load->view("sales/register",$data);
        $this->load->view("cashier/cashier",$data);
    }

	function server_side()
	{
		session_start();
		for($x=0;count($_POST["item_id"])>$x;$x++){
			$total_amount_row= $_POST["total_amount_row"][$x];
			$item_id= $_POST["item_id"][$x];
			$item_no= $_POST["item_no"][$x];
			$item_name= $_POST["item_name"][$x];
			$unit_price= $_POST["unit_price"][$x];
			$item_qty= $_POST["item_qty"][$x];
			
			$_SESSION["cashier_items"][$item_id] = array("total_amount_row"=>$total_amount_row, "item_id"=>$item_id, "item_no"=>$item_no, "item_name"=>$item_name, "unit_price"=>$unit_price, "item_qty"=>$item_qty);
		}
			//$this->session->set_userdata("cashier_added_items", $this->input->post("data"));
			//$this->session->set_userdata("cashier_added_items_count", "1");
		#echo $this->session->userdata("cashier_added_items");
		//$_SESSION["cashier_added_items"] = $this->input->post("data");
		print_r($_SESSION["cashier_items"]);
		#echo $item_id;
		//exit();
		
	}
	function remove_item()
	{
		session_start();
		$item_id = $this->input->post("item_id");
		unset($_SESSION["cashier_items"][$item_id]);
	}
	function complete()
	{
			$this->load->model('Cash');
			/*item_id<input type='hidden' value='"+item_no+"' name='item_no[]'/><input type='hidden' value='"+item_name+"' name='item_name[]'/><input type='hidden' value='"+unit_price+"' name='unit_price[]'/><input type='hidden' value='"+item_qty+"' name='item_qty[]'/><input type='hidden' value='"+unit_price+"' name='unit_price[]'/>
			*/


			
			#select max sales id
			$this->db->select_max('sale_id');
			$query_max_salesid = $this->db->get('sales');
			$sales_max_id = $query_max_salesid->row()->sale_id + 1;



			$item_no = $this->input->post("item_no");
			$item_name = $this->input->post("item_name");
			$unit_price = $this->input->post("unit_price");
			$item_id = $this->input->post("item_id");
			$final_array = array();
			for($i = 0; $i < count($item_no); $i++){
				$final_array[$i]['item_no'] = $item_no[$i];
				$final_array[$i]['item_id'] = $item_id[$i];
				$final_array[$i]['item_name'] = $item_name[$i];
				$final_array[$i]['unit_price'] = $unit_price[$i];
				$final_array[$i]['sales_id'] = $sales_max_id;
				// etc.
			}

			$amount_tendered = $this->input->post('money-gave');





        #print_r($amount_tendered);

			$data_sales = array('sale_time' => date('Y-m-d H:i:s'), 'customer_id' => '2', 'employee_id' => '1', 'payment_type' => 'Cash: Php'.$amount_tendered.'<br/>');
			

			$this->Cash->insert_sale($data_sales);
//			$this->Cash->cmplete($final_array);
			
			//print_r($final_array);
			//exit();
			//for($x=0;$x<count($this->input->post("item_no"));$x++){
				
			//}
			
			/*foreach($this->post->input("item_no")){
				
				
			}*/
			
			/*
				$data = array(
				   array(
					  'title' => 'My title' ,
					  'name' => 'My Name' ,
					  'date' => 'My date'
				   ),
				   array(
					  'title' => 'Another title' ,
					  'name' => 'Another Name' ,
					  'date' => 'Another date'
				   )
				);
			*/
	}
	
	function _payments_cover_total()
	{
		$total_payments = 0;

		foreach($this->sale_lib->get_payments() as $payment)
		{
			$total_payments += $payment['payment_amount'];
		}

		/* Changed the conditional to account for floating point rounding */
		if ( ( $this->sale_lib->get_mode() == 'sale' ) && ( ( to_currency_no_money( $this->sale_lib->get_total() ) - $total_payments ) > 1e-6 ) )
		{
			return false;
		}
		
		return true;
	}
	
    function logout()
    {
        $this->Employee->logout();
    }
}
?>