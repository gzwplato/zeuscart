<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 12:58:44
compiled from countrywisetaxsettingsajax.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zeuscart Admin Control Panel<?php echo $this->_tpl_vars['pagetitle']; ?>
</title>
<link href="css/admin_style.css" rel="stylesheet" type="text/css" />
<link href="css/calendar_styles.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() {
var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() {
var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_findObj(n, d) {
var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() {
var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" language="javascript" src="js/list_color.js"></script>
<script type="text/javascript" language="javascript" src="js/show_hide.js"></script>
</head>
<body onload="MM_preloadImages('images/ch_width_bttn_hov.gif');">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="main_table">
<tr>
<td align="center" valign="top" class=""><table width="96%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" align="right" class="chg_width"><a id="left_collap12_ctl" title="Click to expand/collapse" onclick="return toggle ('left_collap12_open', 'left_collap12_Hidden')" onmouseover="MM_swapImage('Image5','','images/ch_width_bttn_hov.gif',1); window.status = 'Click to expand/collapse'; return true" onmouseout="MM_swapImgRestore(); window.status = ''; return true" href="#menu" ><!--<img src="images/ch_width_bttn.gif" name="Image5" width="107" height="20" border="0" id="Image5" />--></a>
<input name="left_collap12_Hidden" id="left_collap12_Hidden" value="False" type="hidden"></td>
</tr>
<!--  <tr>
<td width="25%" align="left" valign="top" class="content_right_bdr" id="left_collap12_open">-->
<tr>
<td>
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center">
<!-------------------tax----------------------->
<form  name="sam" action="?do=taxsettings&action=updatetaxsettings" method="post">
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<!--<<tr>
<td align="left">&nbsp;</td>
</tr>
tr>
<td align="left"></td>
</tr>-->
<tr>
<td align="left"><?php echo $this->_tpl_vars['insmsg']; ?>
<table cellspacing="0" border="0" width="100%" style=" padding-bottom:10px; padding-top:5px;">
<tr><td style="padding-left:320px;"><a class="add_link"   href="?do=taxsettings&action=addregionwisetax">Add Tax Rate </a></td></tr>
</table>
</td>
</tr>
<tr>
<td align="center" class="content_form_bdr">
<?php echo $this->_tpl_vars['taxsettings']; ?>
</td>
</tr>
</table>
</form><!-------------------tax----------------------->
</td>
</tr>
</table>
</td>
</tr>
</table></td>
</tr>
</table>
</body>
</html>
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