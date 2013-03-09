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
 * CProductDetail
 *
 * This class contains functions to display product and review details.
 *
 * @package		Core_CProductDetail
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------

class Core_CProductDetail
{
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
	var $output = array();	
	
	/**
	 * Function displays the product details from the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function showProducts()
	{
		$sql= "SELECT product_id,title,thumb_image FROM products_table ORDER BY title ASC";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return  Display_DProductDetail::showProducts($query->records);
		}
		else
		{
			return "No Products Found";
		}
		
	}
	
	/**
	 * Function gets the inventory details from the database
	 * 
	 * 
	 * @return string
	 */
	
	function productDetail()
	{
		$this->lastViewedProducts($_GET['prodid']);
		$_SESSION['prodid']=$_GET['prodid'];
		$sql="SELECT quantity,msrp FROM msrp_by_quantity_table WHERE product_id =".(int)$_GET['prodid'];
		$pquery = new Bin_Query();
		if($pquery->executeQuery($sql))
		{		
			$flag = $pquery->totrows;
			//echo $flag;
		}
		if($flag==0)
		{
			//echo 'sflaog';
			$sql= "SELECT * FROM product_inventory_table a 
			INNER JOIN products_table b ON a.product_id = b.product_id
			WHERE b.product_id =".(int)$_GET['prodid'];
		
			$query = new Bin_Query();
			$rating=$this->reviewRating();
			$reviewcount=$this->reviewCount();
			$count=$reviewcount[0]['review'];
			//print_r($reviewcount[0]['review']);
			//exit;
			if($query->executeQuery($sql))
			{		
				return  Display_DProductDetail::productDetail($query->records,$rating,$count);
			}
			else
			{
				return "Products Not  Available in Stock";
			}
		}
		else
		{
			//echo 's';
			$sql="SELECT b.product_id,b.title,b.cse_enabled,b.price as oprice,b.msrp,c.msrp as
			price,c.quantity,b.description,b.sku,b.tag,b.brand,b.weight,b.dimension,b.image,b.model,a.soh,b.meta_desc,b.meta_keywords  
			FROM product_inventory_table a
			INNER JOIN products_table b ON a.product_id = b.product_id 
			INNER JOIN msrp_by_quantity_table c ON b.product_id=c.product_id WHERE c.product_id =".(int)$_GET['prodid'];
			$query = new Bin_Query();
			$rating=$this->reviewRating();
			$reviewcount=$this->reviewCount();
			//print_r($reviewcount);
			//exit;
			if($query->executeQuery($sql))
			{		
				return  Display_DProductDetail::productDetail($query->records,$rating,$reviewCount);
			}
			else
			{
				return "Not  Found";
			}
		}

		
	}
	
	/**
	 * Function gets the review details from the database
	 * 
	 * 
	 * @return string
	 */
	
	
	
	function reviewRating()
	{
		$sql= "SELECT product_id,rating FROM `product_reviews_table` WHERE product_id=".(int)$_GET['prodid'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return  Display_DProductDetail::reviewRating($query->records);
	}
	
	/**
	 * Function gets the count of the reviews from the database
	 * 
	 * 
	 * @return string
	 */
	
	
	function reviewCount()
	{

		$sql= "SELECT count(*) AS review, rating
		 FROM `product_reviews_table`
		 WHERE product_id =".(int)$_GET['prodid']." GROUP BY product_id";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return $query->records;			
			
	}
	
	/**
	 * Function gets the last viewed products 
	 * 
	 * 
	 * @return array
	 */
	
	
	function lastViewedProducts($id)
	{
		if(!isset($_SESSION['LastViewed']))
		{
			$_SESSION['LastViewed'] = array();
		}
		$cnt=count($_SESSION['LastViewed']);
		$_SESSION['LastViewed'][$cnt] =$id;
		$_SESSION['LastViewed'] = array_unique($_SESSION['LastViewed']);		
		
	}
	
	
	/**
	 * Function gets the attribute list for the selected product
	 * 
	 * 
	 * @return string
	 */
	
	
	function attributeList()
	{
		$sql= "SELECT attrib_name, attrib_value 
		FROM `attribute_value_table` av, attribute_table at
		WHERE av.attrib_id = at.attrib_id AND av.attrib_value_id IN (SELECT attrib_value_id 
		FROM product_attrib_values_table
		WHERE product_id =".(int)$_GET['prodid'].')';
		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return  Display_DProductDetail::attributeList($query->records);
		}
		else
		{
			//return "Not  Found";
		}
	}
	
	
	/**
	 * Function gets the releated products from the cross products table 
	 * 
	 * 
	 * @return string
	 */
	
	
	function relatedProducts()
	{
	
		$sql= "SELECT * from cross_products_table where product_id=".(int)$_GET['prodid'];
		$query = new Bin_Query();
	
		
		if($query->executeQuery($sql))
		{	
	
			$resultproduct=$query->records;
			//print_r($resultproduct);
			$arr=explode(',',$resultproduct[0]['cross_product_ids']);
			//print_r($arr);
			$output1='
			<table width="20%" border="0" cellpadding="0" cellspacing="0"><tr>';
			if(count($arr)>0)
			{
			
				for ($i=0;$i<count($arr);$i++)
				{
					$sql= "SELECT * from products_table where product_id=".$arr[$i];
					$query = new Bin_Query();
					$query->executeQuery($sql);
					if($query->totrows>0)
					foreach($query->records as $row)
					{
					//echo 's';
						$r[$j]=$row;
						$prid=$row['product_id'];
						$obj1=new Core_CProductDetail();
						$minval=$obj1->disRates($prid);
						if($minval > 0  or $minval!='')
						{
							$r[$j]['msrp']= $_SESSION['currency']['currency_tocken'].$row['msrp'].' - '.$_SESSION['currency']['currency_tocken'].$minval;
						}
						else
							$r[$j]['msrp']= $_SESSION['currency']['currency_tocken'].$row['msrp'];
						//$j++;
						//print_r($r);
						$output.= Display_DProductDetail::relatedProducts($r);
					}

				}
			}
		
			return $output1.$output;
		}
		else
		{
			//return '<div class="exc_msgbox">Related Products Not Found</div>';
			$output1='<div id="middle_details"><div id=""> <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>';
			return $output1;
		}	
	}
	
	/**
	 * Function gets the rate from the table for the selected product
	 * 
	 * @param integer $productid
	 * @return string
	 */
	
	
	function disRates($productid)
	{
		$sql='select min(msrp) as msrp from msrp_by_quantity_table where product_id ='.$productid;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$val=$obj->records;
		return $val[0]['msrp'];
	}
}