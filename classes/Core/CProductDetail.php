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
class Core_CProductDetail
{
var $output = array();	
	/**
	 * This function is used to get   the product 
	 * 
	 * 
	 * @return HTML data
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
	
	function pageInfo()
	{
		$sql= "SELECT product_id,title,meta_desc,meta_keywords FROM products_table where product_id= ".(int)$_GET['prodid']." and status=1";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			return  Display_DProductDetail::pageInfo($query->records);
		}
		else
		{
			return "No Products Found";
		}
		
	}
	/**
	 * This function is used to get   the product  details
	 * 
	 * 
	 * @return HTML data
	 */	
	function productDetail()
	{
		if(isset($_POST['reviewbutton']))
		{
			$_SESSION['postvaluesreview']=$_POST;
		}
		if(isset($_POST['review']) && $_POST['review']!='')
		{
			if(!isset($_SESSION['user_id']))
			{
				$prodid = $_GET['prodid'];
				$_SESSION['RequestUrl'] = '?do=prodetail&action=showprod&prodid='.$prodid;
				header("Location:?do=login");
				exit;
			}		
			
			$code = $_SESSION['security_code'];
			if(!empty($_POST['txtcaptcha']) && !(strtolower(trim($_POST['txtcaptcha']))==strtolower($code)))
			{
				$_SESSION['reviewResult']='<div class="bs-docs-example">
				<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Captcha Mismatch</div></div>';
				$prodid = $_GET['prodid'];				
				header("Location:?do=prodetail&action=showprod&prodid=".$prodid);
				exit;
			}
			
			
			$id=(int)$_GET['prodid'];
			$caption=htmlentities($_POST['caption']);
			$review= htmlentities($_POST['review']);
			$userid=$_SESSION['user_id'];
			$rating=(int)$_POST['hidRate'];
			$status=0;
			
			$sql='select * from product_reviews_table where product_id="'.$id.'" and user_id="'.$userid.'"';
			$check= new Bin_Query();
			$check->executeQuery($sql);
			if($check->totrows==0)
			{
				$sqlComment='insert into product_reviews_table (product_id,user_id,review_caption,review_txt,review_date,rating,review_status) values('.$id.','.$userid.',"'.$caption.'","'.$review.'","'.date("Y-m-d").'",'.$rating.','.$status.')';
				$commentqry = new Bin_Query();
				$commentqry->executeQuery($sqlComment);
				$_SESSION['reviewResult']='<div class="bs-docs-example">
				<div class="alert alert-success">
				<button data-dismiss="alert" class="close" type="button">×</button>Your Review is Posted for Moderation!</div></div>';
			}
			else
				$_SESSION['reviewResult']='<div class="bs-docs-example">
				<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Review already Posted!</div></div>';
		}	
		else if(isset($_POST['reviewbutton']))
		$_SESSION['reviewResult']='<div class="bs-docs-example">
				<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>Reviews cannot be empty!</div></div>';
			
		
		$this->lastViewedProducts($_GET['prodid']);
		
		$sqlReview="SELECT a.*,b.user_display_name FROM `product_reviews_table` a,users_table b where a.user_id=b.user_id and a.review_status=1 and a.product_id=".(int)$_GET['prodid'];
		$reviewqry = new Bin_Query();
		$reviewqry->executeQuery($sqlReview);
		
		//Get Images for different view
		$sqlImages="select * from product_images_table where type='sub' and product_id=".(int)$_GET['prodid'].' limit 0,4';
		$imgqry = new Bin_Query();
		$imgqry->executeQuery($sqlImages);
		
		//Get Tier Price
		$sql="SELECT distinct quantity,msrp FROM msrp_by_quantity_table WHERE product_id =".(int)$_GET['prodid']; 
		$pquery = new Bin_Query();
		if($pquery->executeQuery($sql))
		{		
			$flag = $pquery->totrows;
		}
		
		//Get Related Products from Order_products_table table
		$sqlRelated="SELECT c.*,a.product_id,count(a.product_id) as cnt FROM `order_products_table` a,`order_products_table` b,products_table c where a.order_id=b.order_id and a.product_id<>b.product_id and a.product_id=c.product_id and b.product_id=".(int)$_GET['prodid']." and c.status=1 group by a.product_id order by cnt desc limit 0,4";
		$relatedqry = new Bin_Query();
		$relatedqry->executeQuery($sqlRelated);
		
		
		if($flag==0)
		{
			
			$sql= "SELECT * , count( c.product_id ) AS reviewcount
			FROM product_inventory_table a INNER JOIN products_table b ON a.product_id = b.product_id
			INNER JOIN product_reviews_table c ON c.product_id = b.product_id WHERE b.product_id =".(int)$_GET['prodid']."
			and c.review_status=1 GROUP BY c.product_id";
		
			$query = new Bin_Query();
			$rating=$this->reviewRating();
			//$reviewcount=$this->reviewCount();
			$breadCrumb=$this->breadCrumb();
			
			if($query->executeQuery($sql))
			{		
				$count=$query->records[0]['reviewcount'];
				return  Display_DProductDetail::productDetail($query->records,$r=0,$features=0,$rating,$breadCrumb,$count,$reviewqry->records,$imgqry->records,$pquery->records,$relatedqry->records);
			}
			else
			{
				$sql="SELECT * FROM product_inventory_table a INNER JOIN products_table b ON a.product_id = b.product_id WHERE b.product_id =".(int)$_GET['prodid']." AND b.status=1 ";
				if($query->executeQuery($sql))
				{
					$count='0';
					return  Display_DProductDetail::productDetail($query->records,$r=0,$features=0,$rating,$breadCrumb,$count,$reviewqry->records,$imgqry->records,$pquery->records,$relatedqry->records);
				}
			}
		}
		else
		{
			$sql="SELECT b.product_id,b.title,b.cse_enabled,b.price as oprice,b.msrp,c.msrp as
			price,c.quantity,b.description,b.tag,b.shipping_cost,b.sku,b.brand,b.weight,b.dimension,b.image,b.model,a.soh,b.meta_desc,b.meta_keywords  
			FROM product_inventory_table a
			INNER JOIN products_table b ON a.product_id = b.product_id 
			INNER JOIN msrp_by_quantity_table c ON b.product_id=c.product_id WHERE c.product_id =".(int)$_GET['prodid']." AND b.status=1"; 
			
			$sqlfeature="SELECT b.product_id,b.title,b.cse_enabled,b.price as oprice,b.msrp,c.msrp as
			price,c.quantity,b.description,b.tag,b.sku,b.brand,b.weight,b.dimension,b.image,b.model,a.soh,b.meta_desc,b.meta_keywords  
			FROM product_inventory_table a
			INNER JOIN products_table b ON a.product_id = b.product_id 
			INNER JOIN msrp_by_quantity_table c ON b.product_id=c.product_id WHERE c.product_id =".(int)$_GET['prodid']." and ";
			$sqlcount ="select count(product_id) as reviewcount from product_reviews_table where product_id=".(int)$_GET['prodid']." and review_status=1 and b.status=1";
			$obj=new Bin_Query();
			$obj->executeQuery($sqlcount);
			$query = new Bin_Query();
			$rating=$this->reviewRating();
			//$reviewcount=$this->reviewCount();
			$reviewcount = $obj->records[0]['reviewcount'];
			//print_r($reviewcount);exit;
			$features=new Bin_Query();
			$features->executeQuery($sqlfeature);
			$breadCrumb=$this->breadCrumb();
			if($query->executeQuery($sql))
			{		
			    $j=0;
				foreach($query->records as $row)
				{
					$r[$j]=$row;
					$prid=$row['product_id'];
					$obj1=new Core_CProductDetail();
					$minval=$obj1->disRates($prid);
					if($minval > 0  or $minval!='')
					{
						$r[$j]['msrp']= '<!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2).' - <!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($minval*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
					}
					else
						$r[$j]['msrp']= '<!--$-->'.$_SESSION['currencysetting']['selected_currency_settings']['currency_tocken'].number_format($row['msrp']*$_SESSION['currencysetting']['selected_currency_settings']['conversion_rate'],2);
						
				}				
				//print_r($r);
				return  Display_DProductDetail::productDetail($query->records,$r,$features->records,$rating,$breadCrumb,$reviewcount,$reviewqry->records,$imgqry->records,$pquery->records,$relatedqry->records);
			}
			else
			{
				return "Not  Found";
			}
		}

		
	}
	/**
	 * This function is used to get   the breadcrumb
	 * 
	 * 
	 * @return HTML data
	 */	
	function breadCrumb()
	{
		$sql='SELECT a.category_name AS Category,a.category_id as maincatid, b.category_name AS SubCategory, b.category_id,pt.title
		FROM category_table a INNER JOIN category_table b ON a.category_id = b.category_parent_id 
		inner join products_table pt on b.category_id=pt.category_id WHERE pt.product_id ='.(int)$_GET['prodid']." AND pt.status=1";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return  Display_DProductDetail::breadCrumb($query->records);
	}
	/**
	 * This function is used to get   the review rating
	 * 
	 * 
	 * @return HTML data
	 */	
	function reviewRating()
	{
		
		$sql= "SELECT a.product_id,sum(c.rating)/count(c.user_id) as
			rating FROM products_table as a left join product_reviews_table c on a.product_id=c.product_id where a.product_id=".(int)$_GET['prodid']."AND a.status=1 group by a.product_id";

		$query = new Bin_Query();
		if($query->executeQuery($sql))
			return  Display_DProductDetail::reviewRating($query->records[0]['rating']);
	}
	/**
	 * This function is used to get   the review rating count
	 * 
	 * 
	 * @return HTML data
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
	 * This function is used to get   the last viewed product
	 * 
	 * 
	 * @return HTML data
	 */
	
	function lastViewedProducts($id)
	{
		if(!isset($_SESSION['LastViewed']))
			$_SESSION['LastViewed'] = array();
		$cnt=count($_SESSION['LastViewed']);
		$_SESSION['LastViewed'][$cnt] =$id;
		//$_SESSION['LastViewed'] = array_unique($_SESSION['LastViewed']);
	}
	/**
	 * This function is used to get   the attribute list
	 * 
	 * 
	 * @return HTML data
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
		    return  Display_DProductDetail::attributeList($flag=0);	//return "Not fggfg Found";
		}
	}
	/**
	 * This function is used to get   the related product  list
	 * 
	 * 
	 * @return HTML data
	 */
	function relatedProducts()
	{
		
		$j=0;
		$sql= "SELECT * from cross_products_table where product_id=".(int)$_GET['prodid'];
		$query = new Bin_Query();
	
		
		if($query->executeQuery($sql))
		{	
			$flag='1';
			$resultproduct=$query->records;
			$arr=explode(',',$resultproduct[0]['cross_product_ids']);
			$arr='"'.implode('","',$arr).'"';	
			
			if(count($arr)>0)
			{
				for ($i=0;$i<count($arr);$i++)
				{
					$sql= "SELECT * from products_table where product_id in(".$arr.")";
					$query = new Bin_Query();
					if($query->executeQuery($sql))
					{
						$cnt =count($query->records);
						if($cnt>0)
						{
							for ($i=0;$i<$cnt;$i++)
							{	
								foreach($query->records as $row)
								{
									$r[$j]=$row;
									$prid=$row['product_id'];
									
									$obj1=new Core_CProductDetail();
									$minval=$obj1->disRates($prid);
									if($minval > 0  or $minval!='')
										$r[$j]['msrp']= '$'.number_format($row['msrp'],2).' - $'.number_format($minval,2);
									else
										$r[$j]['msrp']= '$'.number_format($row['msrp'],2);
									$j++;
								}
							}
							$output.= Display_DProductDetail::relatedProducts($query->records,$flag,$r);
						}
						
					}
				}
			}
			return $output1.$output;
		}
		else
		{
			//return '<div class="exc_msgbox">Related Products Not Found</div>';
			$output1='<div id="middle_details"><div id=""> <table width="" border="0" cellpadding="0" cellspacing="0"><tr>';
			return $output1;
		}	
	}
	function disRates($productid)
	{
		$sql='select min(msrp) as msrp from msrp_by_quantity_table where product_id ='.$productid;
		$obj=new Bin_Query();
		$obj->executeQuery($sql);
		$val=$obj->records;
		return $val[0]['msrp'];
	}
	
	
		
	function dispRelatedProduct()
	{
		$sql= "SELECT cross_product_ids FROM cross_products_table where product_id= ".(int)$_GET['prodid'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			$val= $query->records[0]['cross_product_ids'];
		}
		$sql= "Select product_id,title FROM products_table WHERE product_id IN (".$val.")";
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{		
			$output= Display_DProductDetail::dispRelatedProduct($query->records);
		}
		return $output;
	}
	
	function showLargeview()
	{
		$pagesize=1;
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
		$sql= "select a.*,b.title from product_images_table a,products_table b where a.product_id=b.product_id and type='sub' and b.status=1 and a.product_id=".(int)$_GET['id'];
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
	
			$sql= "select a.*,b.title from product_images_table a,products_table b where a.product_id=b.product_id and a.type='sub' and b.status=1 and a.product_id=".(int)$_GET['id']." limit $start,$end";
			$obj = new Bin_Query();
	
			if($obj->executeQuery($sql))
			{
				 return Display_DProductDetail::showLargeview($obj->records[0],$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
			}	
		}
	}
	/**
	 * This function is used to get the category list in tree format .
	 *
	 * 
	 * 
	 * @return array result
	 */

	function showCategoryTree()
	{
		$obj=new Bin_Query();
		$sql = "SELECT * FROM `category_table` WHERE category_parent_id =0 AND category_status =1 ";
		if($obj->executeQuery($sql))
		{
			$output = Display_DProductDetail::showCategoryTree($obj->records);
		}
		else
			$output='No Category Found';

		return $output;


	}
	
}