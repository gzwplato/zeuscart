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
class Display_DSiteSettings
{
	function siteMoto($arr)
	{
		//print_r($arr);
		$output = '<tr>
          <td align="left" class="content_form">
	       Site Moto:</td>
		<td  class="content_form" >
        <input type="text" name="moto"  value="'.$arr[0]['set_value'].'" class="txt_box250" /> </td></tr>
        
        ';
			
		return $output;
	}
}
?>