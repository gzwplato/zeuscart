<?php 
 ob_start(); ?><?php /* Smarty version 2.6.19, created on 2013-02-23 13:14:46
compiled from bulkupload.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
<form name="fm" method="post" action="?do=bulkupload&action=upload" enctype="multipart/form-data">
<table width="97%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left"><?php echo $this->_tpl_vars['createpagemsg']; ?>
<?php echo $this->_tpl_vars['deletepage']; ?>
</td>
</tr>
<tr>
<td align="left" class="content_title">Products Bulk Upload</td>
</tr>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr>
<td align="left"><?php echo $this->_tpl_vars['messages']; ?>
&nbsp;</td>
</tr>
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
<tr>
<td  align="left" class="content_list_head" valign="top">Products Bulk Upload</td>
</tr>
<tr>
<td align="left" class=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="20%" align="left" class="content_form">Product TSV File</td>
<td width="66%" class="content_form"><input type="file" name="product_file" id="product_file" value=""/>
&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dbulkup1', 'Upload TSV', 'Upload product information with Tab Separated Values(TSV) format.')" onmouseout="HideHelp('dbulkup1');">
<div id="dbulkup1" style=" position:fixed"></div> <span class="errmsg"><strong></strong></span></td>
</tr>
<tr>
<td align="left" class="content_form" valign="top">Sample Product TSV File</td>
<td width="66%" class="content_form"><a href="?do=bulkupload&action=download"><img src="images/ico_bulk_doc.png" name="getdoc" id="getdoc" alt="Click Here" border="0"/></a>&nbsp;<img src="images/help.gif" onmouseover="ShowHelp('dbulkup2', 'Download Sample TSV', 'Click the image to download sample Tab Separated Values(TSV) file for product.')" onmouseout="HideHelp('dbulkup2');">
<div id="dbulkup2" style="left: 50px; top: 50px;"></div></td>
</tr>
<tr>
<td align="center" class="content_form" colspan="2"><input type="submit" name="button" id="button" value="Upload" class="all_bttn"  /></td>
</tr>
</table></td></tr></table>
<tr>
<td align="left">&nbsp;</td>
</tr>
<tr><td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="content_list_bdr">
<tr>
<td  align="left" class="content_list_head" valign="top">Note : To Upload The Product TSV File</td>
</tr>
<tr>
<td align="left" class="content_form" colspan="2">
<ol>
<li>Click on the Sample images TSV file to download the zip</li>
<li>Extract the zip file.</li>
<li>There are two tsv files in the zip archive.</li>
<li>Open the Categoryids.tsv in a spreadsheet application (Ex: Excel) to get the Category reference. ie to which Category I need to upload the Products.</li>
<li>Open the Product.tsv in a spreadsheet application </li>
<li>Don't Modify Or Delete The First Line Of Product TSV File</li>
<li>Modify The Dummy Product Details From The Second Line Of Product TSV File</li>
<li>First enter the <b>Sub Category ID In the First Column</b> . Refer the  Categoryids TSV File</li>
<li>Then Append the Product Details In the Separate Columns</li></li>
<li>Finally upload the Product.tsv file with data</li>
<!--<li>Enter the Category Ids Correctly Given in the Category TSV File</li>-->
</ol>
</td>
</tr>
</table></td></tr>
</td>
</tr>
</table>
</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
?>
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