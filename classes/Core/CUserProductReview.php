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
class Core_CUserProductReview
{
	/**
	 * This function is used to get  the  user product review
	 *
	 * .
	 * 
	 * @return HTML data
	 */
	function showProductReview()
	{
		include('classes/Display/DUserAccount.php');
		
		$userid=$_SESSION['user_id'];
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
		
		$sqlselect="SELECT date_format(review_date,'%e/%c/%Y') as rdate,b.title,review_caption FROM product_reviews_table a,products_table b where a.product_id=b.product_id and a.user_id=".$userid;
		
		$query = new Bin_Query();
		$query->executeQuery($sqlselect);
		
		$total = ceil($query->totrows/ $pagesize);
		include('classes/Lib/Paging.php');
		$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
		$this->data['paging'] = $tmp->output;
		$this->data['prev'] =$tmp->prev;
		$this->data['next'] = $tmp->next;	
		
		$sqlselect="SELECT a.product_id,date_format(review_date,'%e/%c/%Y') as rdate,b.title,review_caption,rating,case when review_status=1 then 'Active' else 'In Active' end as rstatus FROM product_reviews_table a,products_table b where a.product_id=b.product_id and a.user_id=".$userid." LIMIT $start,$end";
		
		$obj = new Bin_Query();
		$obj->executeQuery($sqlselect);
		return Display_DUserAccount::showProductReview($obj->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
	}
}
?>
