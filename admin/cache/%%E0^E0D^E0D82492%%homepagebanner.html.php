<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-03-02 15:28:35
compiled from homepagebanner.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<!--<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>-->
<tr><td valign="top" align="left" >
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" class="content_title">Home Page Slider </td>
</tr>
<!--<tr>
<td align="left">&nbsp;</td>
</tr>-->
<tr>
<td align="center" style="padding-top:5px; padding-bottom:5px;"><?php echo $this->_tpl_vars['bannermsg']; ?>
</td>
</tr>
<!--<tr>
<td align="left">&nbsp;</td>
</tr>-->
<tr>
<td align="left" class="content_form_bdr">
<form name="site" action="?do=banner&action=update" method="post" enctype="multipart/form-data" >
<?php echo $this->_tpl_vars['banner']; ?>
</td>
</tr> <tr><td align="left" colspan="4">
<a href="javascript:void(0);" onclick="addHomePageBanner();"><input type="button" name="button" id="button" value="Add" class="all_bttn"  /></a> </td>
</tr>
<tr><td align="center" colspan="4" class="content_form_line">
<input type="hidden" name="totalcount" id="totalcount">
<input type="submit" name="button" id="button" value="Set Slide" class="all_bttn"  /></td>
</tr>
</table>
<div>&nbsp;</div></td>  <td width="25%" align="left" valign="top" class="content_right_bdr" id="left_collap12_open"><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="215" align="left" class="content_title">Basic Options </td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<?php echo $this->_tpl_vars['slide_parameter']; ?>
<!--<tr>
<td><table width="215" cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">jQuery Library</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><select name="jquerylibrary" style="width:80%"><option value="jQuery 1.8.3"> jQuery 1.8.3</option><option value="jQuery1.9.1">jQuery1.9.1</option><option value="jQuery1.10.1">jQuery1.10.1</option></select></td>
</tr></table></td></tr>-->
<!--<tr>
<td><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
</tr>
<tr>
<td width="50" align="center" class="content_left_bg"><img src="images/ico_orders.jpg" alt="" width="30" height="34" /></td>
<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">Slide Show Setup</span></td>
</tr>
<tr>
<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">Slideshow Height</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><input type="text" name="slideshowheight" id="slideshowheight" style="width:80%" value="400"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Image Alignment</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="imagealignment"><option value="topLeft"> topLeft</option>
<option value="topCenter"> topCenter</option>
<option value="topRight"> topRight</option>
<option value="centerLeft"> centerLeft</option>
<option value="center"> center</option>
<option value='centerRight'>centerRight</option><option value='bottomLeft'>bottomLeft</option><option value='bottomCenter'>bottomCenter</option><option value='bottomRight'>bottomRight</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Auto Play</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="autoplay"><option value="true"> Enable</option><option value='false'>Disable</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Skin Color</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="skincolor"><option value="Blue"> Blue</option><option value='Block'>Block</option><option value='Red'>Red</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Transaction Effect</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="transactioneffect"><option value="Blue"> Random</option><option value='Loop'>Loop</option><option value='BackAndForth'>backAndForth</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Effect Apply</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="effectapply"><option value="Random"> Random</option><option value='Fade'>Fade</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Number of Columns</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="numberofcolumns" id="numberofcolumns" style="width:80%" value="6"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Number of Rows</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="numberofrows" id="numberofrows" style="width:80%" value="4"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Sliced Columns</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="slicedcolumns" id="slicedcolumns" style="width:80%" value="12"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Sliced Rows</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="slicedrows" id="time" style="width:80%" value="8"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Easing Effect</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="easingeffect"><option value="easeInOutExpo"> easeinOutExpo</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Sliding Time(ms)</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="slidingtime" id="slidingtime" style="width:80%" value="7000"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Sliding Effect Time</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="slidingeffecttime" id="slidingeffecttime" style="width:80%" value="1500"></td>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
</tr>
</table> </td>
</tr>--><!--<tr>
<td><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
</tr>
<tr>
<td width="50" align="center" class="content_left_bg"><img src="images/ico_orders.jpg" alt="" width="30" height="34" /></td>
<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">Navigation </span></td>
</tr>
<tr>
<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">Pagination</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><select style="width:80%" name="pagination"><option value="true">Bullets</option><option value="false">Disable Bullets</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Navigation Buttons</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="navigationbuttons"><option value="true"> Enable</option><option value="false">Disable</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Show Navigation</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="shownavigation"><option value="true"> Mouse Over</option><option value='false'> False</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Play/Pause Button</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="pausebutton"><option value="true"> Enalbe</option><option value="false">False</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Pause on Click</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="pauseonclick"><option value="true"> Yes</option><option value="false">No</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Pause on Hover</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="pasueonhover"><option value="true"> Yes</option><option value='false'>No</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Timer Type</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="timertype"><option value="pie"> Pie</option><option value='bar'>Bar</option><option value='none'>None</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Timer Color</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="timercolor" id="timercolor" value="#eeeeee" style="width:80%"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Timer BgColor</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="timerbgcolor" id="timerbgcolor" value="#222222" style="width:80%"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Pie Diameter</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="piediameter" id="piediameter" style="width:80%" value="38"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Pie Position</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="pieposition"><option value="Right Top"> Right Top</option><option value="Right Bottom"> Right Bottom</option><option value="Left Top"> Left Top</option><option value="Left Bottom"> Left Bottom</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Timer Bar Position</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="timerbarposition"><option value="top">Top</option><option value="bottom"> Bottom</option><option value="right"> Right</option><option value="left"> Left</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Timer Bar Direction</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="timerbardirections"><option value="leftToRight">Left to Right </option><option value="rightToLeft"> Right to Left Bottom</option><option value="topToBottom"> Top To Bottom</option><option value="bottomToTop">Bottomt to Top</option></select></td>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
</tr>
</table> </td>
</tr>--><!--<tr>
<td><table width="215" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2"><img src="images/left_stat_top.gif" alt="" width="215" height="4" /></td>
</tr>
<tr>
<td width="50" align="center" class="content_left_bg"><img src="images/ico_orders.jpg" alt="" width="30" height="34" /></td>
<td width="165" align="left" class="content_left_bg"><span class="site_statistics_txt1">Thumbs </span></td>
</tr>
<tr>
<td colspan="2" align="center" class="content_left_bdr"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="55%" align="left" class="site_stat_txt1">Thumbnails</td>
<td width="5%" align="left" class="site_stat_txt2">:</td>
<td width="40%" align="left" class="site_stat_txt3"><select style="width:80%" name="thumbnails"><option value="true">Enable</option><option value="false">Disable</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Thumb Width(pixels)</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="thumbwidth" id="thumbwidth" style="width:80%" value="100"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Thumb Height(pixels)</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><input type="text" name="thumbheight" id="thumbheight" style="width:80%" value="100"></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Thumb Quality</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="thumbquality"><option value="50%"> 50%</option><option value='Disable'>Disable</option><option value='100%'>100%</option></select></td>
</tr>
<tr>
<td align="left" class="site_stat_txt1">Thumb Alignment</td>
<td align="left" class="site_stat_txt2">:</td>
<td align="left" class="site_stat_txt3"><select style="width:80%" name="thumbalignment"><option value="Top"> Top</option><option value='Bottom'>Bottom</option><option value='Left'>Left</option><option value='Right'>Right</option></select></td>
</tr>
</table></td>
</tr>
<tr>
<td colspan="2"><img src="images/left_stat_bot.gif" alt="" width="215" height="4" /></td>
</tr>
</table> </form></td>
</tr>-->
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table></td>
</td>
</tr>
</table> </form> </td>
</tr>
<tr>
<td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="91%" align="left" class="footer_style">Powered by <a href="http://www.ajsquare.com/products/ecom/" style="text-decoration:none;" target="_blank">ZeusCart</a></td>
<td width="9%" align="left" class="footer_style">Version 2.3</td>
</tr>
</table></td>
</tr>
<tr><td colspan="5" height="35" valign="middle" align="right" class="newsletterTXT">Developed in <a href="http://ajdf.ajsquare.com/" style="text-decoration:none;" target="_blank"><img src="../images/AJDF.gif" alt="AJDF" border="0"/> </a>Framework &nbsp;</td></tr>
</table>
</body>
</html>
<script>
function addHomePageBanner()
{
ni=document.getElementById('homepageBannerDiv1');
var num = 100;
for(i=2;i<=num;i++)
{
if(!document.getElementById("homepageBannerDiv"+i))
{
num=i;
var newdiv = document.createElement('div');
newdiv.setAttribute("id","homepageBannerDiv"+i,"width","100%");
var tableIdName ="homepageBannerDiv"+i;
document.getElementById('totalcount').value=i;
if(i%2==0)
{
var tablecl="   class='alert_row2' onmouseover=\"mouse_event(this, 'listrow_bg');\" onmouseout=\"mouse_event(this, 'alert_row2');\" ";
}
else
{
var tablecl="   class='alert_row1' onmouseover=\"mouse_event(this, 'listrow_bg');\" onmouseout=\"mouse_event(this, 'alert_row1');\" ";
}
newdiv.innerHTML = "<table border='0' width='100%'><tr><td align='left' colspan='2' class='content_list_head'>Home Page Slider</td><td align='left' class='content_list_head' colspan='2'><a href=\"javascript:;\"  onclick=\"removeHomePageBanner(\'"+tableIdName+"\')\">Remove</a></td></tr><tr ><td width='35%' align='left' class='content_form'>Title:</td><td width='66%' class='content_form' valign='top' ><input  type='text' name='slide_title[]' id='slide_title"+i+"' style='width: 381px;'/></td></tr>  <tr><td width='40%' align='left' class='content_form' >Content: </td><td class='content_form'><input type='file' name='slide_content[]'  id='slide_content"+i+"' ></td></tr>  <tr><td width='40%' align='left' class='content_form'  >Caption: </td><td class='content_form'><textarea style='width: 381px; height: 94px;' id='slide_caption"+i+"' name='slide_caption[]'></textarea><input type='hidden' name='theValue[]' id='theValue"+i+"' value='"+i+"'></td></tr></table>";
ni.appendChild(newdiv);
}
}
}
function removeHomePageBanner(rdiv)
{
ni=document.getElementById('homepageBannerDiv1');
var olddiv = document.getElementById(rdiv)
ni.removeChild(olddiv);
}
function removeHomePageBannerInner(rdiv,uid)
{
ni=document.getElementById('homepageBannerDiv1');
var olddiv = document.getElementById(rdiv)
ni.removeChild(olddiv);
if(uid!='')
{
window.location="?do=banner&action=delete&id="+uid;
}
}
</script>
<?php 
   $op=explode("\n", ob_get_contents());
   ob_clean();
    foreach($op as $p)		
	{
		if(trim($p)!="")
			echo trim($p)."\n"; 
		ob_flush();
	}
?>