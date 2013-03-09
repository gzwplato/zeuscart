<?php
/**
* GNU General Public License.

* This file is part of ZeusCart V2.3.

* ZeusCart V2.3 is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* ZeusCart V2.3 is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with Foobar. If not, see <http://www.gnu.org/licenses/>.
*
*/

/**
 * MOrderManagement
 *
 * This class contains functions to display the existing orders and to update the status
 * 
 * @package		Model_MOrderManagement
 * @category	Model
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Model_MOrderManagement
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();	
	
	/**
	 * Function displays the list of orders and there current status  
	 * 
	 * 
	 * @return array
	 */
	
	function dispOrders()
	{
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');	
		include('classes/Core/CAdminHome.php');
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{		
			$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
			$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
			$output['totalorders']=(int)Core_CAdminHome::totalOrders();
			$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
			$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
			$output['totalusers']=(int)Core_CAdminHome::totalUsers();
			$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
			$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
			$output['totalincome']=Core_CAdminHome::totalIncome();
			$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
			$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
			$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
			$output['lowstock']=(int)Core_CAdminHome::lowStock();
			$output['totalproducts']=(int)Core_CAdminHome::totalProducts();		
			$output['enabledproducts']=(int)Core_CAdminHome::enabledProducts();
			$output['disabledproducts']=(int)Core_CAdminHome::disabledProducts();
			$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();
			$output['orderlist'] =   Core_COrderManagement::dispOrders();	
//			$output['updatedroporderstatus'] =   Core_COrderManagement::updateDropDownOrderStatus();	
			
		}
		else
		{
		 	$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		//include('classes/Core/CAdminHome.php');
		$output['username']=Core_CAdminHome::userName();
		$output['currentDate']=date('l, M d, Y H:i:s');	
		$output['currency_type']=$_SESSION['currency']['currency_tocken'];					
		Bin_Template::createTemplate('OrderManagement.html',$output);
	}	
	
	/**
	 * Function display an order for updation   
	 * 
	 * 
	 * @return array
	 */
	
	function editOrders()
	{
	
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
		$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
		$output['totalorders']=(int)Core_CAdminHome::totalOrders();
		$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
		$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
		$output['totalusers']=(int)Core_CAdminHome::totalUsers();
		$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
		$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
		$output['totalincome']=Core_CAdminHome::totalIncome();
		$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
		$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
		$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
		$output['lowstock']=(int)Core_CAdminHome::lowStock();
		$output['totalproducts']=(int)Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=(int)Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=(int)Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();

		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$output['editorderlist'] =   Core_COrderManagement::dispOrders();				
			Bin_Template::createTemplate('EditOrderManagement.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
		
	}
	
	/**
	 * Function updates the changes made in an order
	 * 
	 * 
	 * @return array
	 */
	
	function updateOrders()
	{
		include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$output['editorderlist'] =Core_COrderManagement::updateOrdersAndShipments();	
		header("Location:?do=disporders&action=detail&msg=Updated%20Sucessfully&id=".$output['editorderlist']);
			exit;				
			//Bin_Template::createTemplate('EditOrderManagement.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}
	}
	
	/**
	 * Function displays the details of orders for updation  
	 * 
	 * 
	 * @return array
	 */
	
	function dispDetailOrders()
	{
		include('classes/Core/CAdminHome.php');
		include('classes/Display/DAdminHome.php');
	    include('classes/Core/COrderManagement.php');
		include('classes/Display/DOrderManagement.php');		
		include('classes/Core/CRoleChecking.php');
		
		$output['monthlyorders']= (int)Core_CAdminHome::monthlyOrders();
		$output['previousmonthorders']=(int)Core_CAdminHome::previousMonthOrders();
		$output['totalorders']=(int)Core_CAdminHome::totalOrders();
		$output['currentmonthuser']=(int)Core_CAdminHome::currentMonthUser();
		$output['previousmonthuser']=(int)Core_CAdminHome::previousMonthUser();
		$output['totalusers']=(int)Core_CAdminHome::totalUsers();
		$output['currentmonthincome']=Core_CAdminHome::currentMonthIncome();
		$output['previousmonthincome']=Core_CAdminHome::previoustMonthIncome();
		$output['totalincome']=Core_CAdminHome::totalIncome();
		$output['currentmonthproudctquantity']=(int)Core_CAdminHome::currentMonthProudctQuantity();
		$output['previousmonthproudctquantity']=(int)Core_CAdminHome::previousMonthProudctQuantity();
		$output['totalproudctquantity']=(int)Core_CAdminHome::totalProudctQuantity();
		$output['lowstock']=(int)Core_CAdminHome::lowStock();
		$output['totalproducts']=(int)Core_CAdminHome::totalProducts();		
		$output['enabledproducts']=(int)Core_CAdminHome::enabledProducts();
		$output['disabledproducts']=(int)Core_CAdminHome::disabledProducts();
		$output['pendingorders']=(int)Core_CAdminHome::pendingOrders();
		$output['processingorders']=(int)Core_CAdminHome::processingOrders();
		$output['deliveredorders']=(int)Core_CAdminHome::deliveredOrders();

		$chkuser=Core_CRoleChecking::checkRoles();
		if($chkuser)
		{	
			$output['detailorder'] = Core_COrderManagement::dispDetailOrders();	
			$output['transdetails'] = Core_COrderManagement::dispTransactionDetails();	
			$output['productorders'] = Core_COrderManagement::displayProductsForOrder();
					
			Bin_Template::createTemplate('DisplayOrderManagement.html',$output);
		}
		else
		{
			$output['usererr'] = 'You are Not having Privilege to view this page contact your Admin for detail';
			Bin_Template::createTemplate('Errors.html',$output);
		}

	}
	
	/**
	 * Function displays an popup window at the admin side for selecting the search keywords.  
	 * 
	 * 
	 * @return array
	 */		
	
	
	function autoComplete()
	{
		include('classes/Core/COrderManagement.php');
		$default = new Core_COrderManagement();
		if($_GET['ids']==1)
			$output['orderid']=$default->autoComplete();
		elseif($_GET['ids']==2)
			$output['dispname']=$default->autoComplete();
		elseif($_GET['ids']==3)
			$output['billname']=$default->autoComplete();
		elseif($_GET['ids']==4)
			$output['shipname']=$default->autoComplete();
		//Bin_Template::createTemplate('autocomplete.html',$output);
	}
}
?>