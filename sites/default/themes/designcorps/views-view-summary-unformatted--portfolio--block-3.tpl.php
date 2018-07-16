<?php
// $Id: views-view-summary-unformatted.tpl.php,v 1.2.4.1 2010/03/16 23:12:31 merlinofchaos Exp $
/**
 * @file views-view-summary-unformatted.tpl.php
 * Default simple view template to display a group of summary lines
 *
 * This wraps items in a span if set to inline, or a div if not.
 *
 * @ingroup views_templates
 */
?>
<script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<select name="select" onChange="MM_jumpMenu('parent',this,1)">
	<option value="" selected>Client Type</option>
<?php foreach ($rows as $id => $row): ?>
	<option value="/portfolio/client-type/<?php print $row->term_data_name; ?>"><?php print $row->link; ?></option>
<?php endforeach; ?>
</select>