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
class Display_DCategory
{	
 	/**
	* This function is used to Display the Sub Category
	* @name loadSubCategories
	* @param mixed $result
	* @return string
 	*/
	function loadSubCategories($result)
	{

		$output="<select class='subcategory' name='subcategory'>";
			if(count($result)>0)
			{
				foreach($result  as $row)
				{
					$output.='<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
				}				
			}
			$output.='</select>';
		return $output;
	}
}
?>