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
 * CCurrencySettings
 *
 * This class contains functions to add, edit and delete the existing currency settings
 *
 * @package		Core_Settings_CCurrencySettings
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Core_Settings_CCurrencySettings
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */	
	var $output = array();
	
	
	/**
	 * Function displays all the currency list from the table
	 * 
	 * 
	 * @return string
	 */	 	
	
	function showCurrencyList()
	{
		
		
	   $pagesize=10;
	  
	   if(isset($_GET['page']))
		{
		    
			$start = trim($_GET['page']-1) *  $pagesize;
			$end =  $pagesize;
		}
		else 
		{
			$start = 0;
			$end =  $pagesize;
		}
		$total = 0;
					
		$sql='SELECT a.id,a.currency_name,a.currency_code,a.country_code,a.conversion_rate,a.currency_tocken,a.status,a.default_currency,b.cou_name FROM currency_master_table a LEFT JOIN country_table b ON a.country_code=b.cou_code ';
						
		//print_r(mysql_fetch_array(mysql_query($sql) or die(mysql_error())));
	  
		$obj=new Bin_Query();
  	    if($obj->executeQuery($sql))
		{
				$total = ceil($obj->totrows/ $pagesize);
				include('classes/Lib/Paging.php');
				$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
				$this->data['paging'] = $tmp->output;
				$this->data['prev'] =$tmp->prev;
				$this->data['next'] = $tmp->next;
				$sql1 =$sql." LIMIT ".$start.",".$end;
				//	echo $sql1;exit;
				$query = new Bin_Query();
				//$sql1="select orders_status_id,orders_status_name from orders_status_table";
				$obj1=new Bin_Query();
				$obj1->executeQuery($sql1);
				
				
		}
		
			if ($obj1->totrows>0)
				return Display_DCurrencySettings::showCurrencyList($obj1->records,$this->data['paging'],$this->data['prev'],$this->data['next']);
			else
				return 'No Currencies Found';	
	
	}
	
	/**
	 * Function gets the currecny details from the database 
	 * 
	 * @param array $Err
	 * @return string
	 */	 	
	

	function showAddCurrency($Err)
	{
	
		
		
		$sqlCat="SELECT * FROM country_table ORDER BY cou_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);
		
		$sqlCat1="SELECT * FROM currency_codes_table ORDER BY currency_name";
		$queryCat1 = new Bin_Query();
		$queryCat1->executeQuery($sqlCat1);
		return Display_DCurrencySettings::showAddCurrency($queryCat->records,$queryCat1->records,$Err);
	
	}
	
	/**
	 * Function adds a new currency into the database
	 * 
	 * 
	 * @return string
	 */	 		
	
	function addNewCurrency()
	{
			$currname = trim($_POST['currency_name']);
			$currcode = trim($_POST['currency_code']);
			$currtoken = trim($_POST['currency_tocken']);
			$convertrate = trim($_POST['conversion_rate']);
			$countrycode=$_POST['taxratecountry'];
			$status=$_POST['taxratestatus'];
		
			$obj1 = new Bin_Query();
			//$sql="select count(*)as numcurrency from currency_master_table where currency_code='$currcode' or country_code='$countrycode'";
			$sql="select count(*)as numcurrency from currency_master_table where currency_code='$currcode' and country_code='$countrycode'";
			$obj1->executeQuery($sql);
			
			if($obj1->records[0]['numcurrency']>0)
			{
				$result = "Country code/Currency code is already set";
				return $result;
			}
			else
			{
				if($status=='')
				{
					$status=0;	
				}
				$sql="INSERT INTO currency_master_table(currency_name,currency_code,country_code,conversion_rate,currency_tocken,status) VALUES('$currname','$currcode','$countrycode',$convertrate,'$currtoken',$status)"; 
				$qry=new Bin_Query();
				if($qry->updateQuery($sql))
					{
						$result = "Added Successfully";
						return $result;		
					}
				else
				{
					$result = "Not Inserted";
					return $result;
				}
				
			}
		
	}
	
	/**
	 * Function displays the selected currency for updation   
	 * 
	 * 
	 * @return string
	 */	 			
	
	function showEditCurrency($Err)
	{
		$sqlCat="SELECT * FROM country_table ORDER BY cou_name";
		$queryCat = new Bin_Query();
		$queryCat->executeQuery($sqlCat);
		$sqlCat1="SELECT * FROM currency_codes_table ORDER BY currency_name";
		$queryCat1 = new Bin_Query();
		$queryCat1->executeQuery($sqlCat1);
		if(isset($_GET['cid']))
		{
			$currencyid=trim($_GET['cid']);
			$sql="select id as hidecurrencyid,currency_name,currency_code,country_code,conversion_rate,currency_tocken,status from currency_master_table where id=$currencyid";
			$qry = new Bin_Query();
			$qry->executeQuery($sql);
			
			return Display_DCurrencySettings::showEditCurrency($queryCat->records,$queryCat1->records,$qry->records,$Err);
		}
		else
			return "No more currency.";
	}
	
	/**
	 * Function updates the changes made in the selected currency 
	 * 
	 * 
	 * @return string
	 */	 		
	
	
	function updateCurrency()
	{
			$currid=trim($_POST['hidecurrencyid']);
			$currname = trim($_POST['currency_name']);
			$currcode = trim($_POST['currency_code']);
			$currtoken = trim($_POST['currency_tocken']);
			$convertrate = trim($_POST['conversion_rate']);
			$countrycode=$_POST['taxratecountry'];
			$status=$_POST['taxratestatus'];
		
			  if($currid==1 || $currid=='1')
			  {
				  $sql="Update currency_master_table set conversion_rate=$convertrate where id=$currid";  	
			  
			  	$qry1=new Bin_Query();
				  if($qry1->updateQuery($sql))
					{
						$result = "<div class='success_msgbox'>Updated Successfully</div>";
						return $result;		
					}
				  else
				  {
					  $result = "Not Updated";
					  return $result;
				  }	
			  }
			  else
			  {
				$obj1 = new Bin_Query();
			$sql="select count(*)as numcurrency from currency_master_table where (currency_code='$currcode' and country_code='$countrycode') and id<>$currid";
			//$sql="select count(*)as numcurrency from currency_master_table where (currency_code='$currcode' or country_code='$countrycode') and id<>$currid";
			$obj1->executeQuery($sql);
			
			if($obj1->records[0]['numcurrency']>0)
			{
				$result = "Country code/Currency code is already set";
				return $result;
			}  
				  
			  if($status=='')
				  {
					  $status=0;	
				  }
				  $sql="Update currency_master_table set currency_name='$currname',currency_code='$currcode',country_code='$countrycode',conversion_rate=$convertrate,currency_tocken='$currtoken',status=$status where id=$currid"; 
				  
			  
				$qry=new Bin_Query();
				  if($qry->updateQuery($sql))
					{
						$result = "Updated Successfully";
						return $result;		
					}
				  else
				  {
					  $result = "Not Updated";
					  return $result;
				  }	
			   }
			}
	
	
	/**
	 * Function deletes the selected currency from the database
	 * 
	 * 
	 * @return string
	 */	 	
	
	function removeCurrency()
	{
		if(isset($_GET['cid'])&&is_numeric($_GET['cid']))
			{
				
				$currid=trim($_GET['cid']);
				if($currid==1 || $currid=='1')
				{
					$result = "Default currency not Deleted";
					  return $result;
				}
				else
				{
				$sql="delete from currency_master_table where id=$currid and id<>1"; 
				$qry=new Bin_Query();
				  if($qry->updateQuery($sql))
				  {
					return "Deleted Successfully";	
					return $result;		
				  }
				  else
				  {
					  $result = "Not Deleted";
					  return $result;
				  }	
				}
			}
		else
			{
				return 'Not Deleted';	
			}
	}
	
}
?>