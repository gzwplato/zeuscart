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
 * CAdminActivity
 *
 * This class contains functions to gets and update the admin activity report.
 *
 * @package		Core_CAdminActivity
 * @category	Core
 * @author		ZeusCart Team
 * @link		http://www.zeuscart.com
 * @version 	2.3
 */

// ------------------------------------------------------------------------





class Core_CAdminActivity 
{
	
	/**
	 * Stores the output
	 *
	 * @var array $output
	 */		
	var $output = array();	
			
	//var $arr = array();	

	
	/**
	 * Function gets the admin activity from the table for displaying the report 
	 * 
	 * 
	 * @return string
	 */
	

	function showReport()
	{
		$pagesize=20;
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

		$sql="SELECT case a.isAdmin when 1 then 'admin' else (select subadmin_name from subadmin_table where subadmin_id=a.user_id ) end as user,a.* FROM `admin_activity_table` a order by visited_on desc";		
		$query = new Bin_Query();
		if($query->executeQuery($sql))
		{	
			$total = ceil($query->totrows/ $pagesize);
			include('classes/Lib/Paging.php');
			$tmp = new Lib_Paging('classic',array('totalpages'=>$total, 'length'=>10),'pagination');
			$this->data['paging'] = $tmp->output;
			$this->data['prev'] =$tmp->prev;
			$this->data['next'] = $tmp->next;	
		}
		$sql="SELECT case a.isAdmin when 1 then 'Admin' else (select subadmin_name from subadmin_table where subadmin_id=a.user_id ) end as user,a.* FROM `admin_activity_table`a order by visited_on desc LIMIT $start,$end";
		$query = new Bin_Query();
		$query->executeQuery($sql);
		{		
			return  Display_DAdminActivity::listActivity($query->records,$this->data['paging'],$this->data['prev'],$this->data['next'],$start);
		}		
	}
	
	/**
	 * Function updates the admin activity to the database for displaying the report 
	 * 
	 * 
	 * @param string $user
	 * @param string $id
	 * @param string $flag	 
	 * @return bool
	 */
	
	
	function setReport($user,$id,$flag)
	{
		$url=$_SERVER['REQUEST_URI'];
		$subadminid=$_SESSION['subadminId'];
		$adminid=$_SESSION['adminId'];

		$sql="select a.* from admin_activity_table a where a.isAdmin='".$flag."' and a.user_id='".$id."' and a.url='".$url."' and date_format(a.visited_on,'%d %m %Y %H %i')='".date("d m Y H i")."'";
		
		$query = new Bin_Query();
		$query->executeQuery($sql);
		if(empty($query->records))
		{
			$sql="insert into admin_activity_table (isAdmin,user_id,url,visited_on) values('".$flag."','".$id."','".$url."','".date("y.m.d H.i.s")."')";
			$query = new Bin_Query();
			$query->executeQuery($sql);
		}	
	}
	
	/**
	 * Function truncates the admin_activity_table 
	 * 
	 * @return string
	 */
	
	function deleteActivity()
	{
		$sql="TRUNCATE TABLE admin_activity_table ";
		$query = new Bin_Query();
		if($query->updateQuery($sql))
			return '<div class=success_msgbox width="100%">Admin Activity records deleted successfully</div>';		
		else
			return '<div class=error_msgbox width="100%">Unable to delete Admin Activity records</div>';		
	}
}
?>