<? if ($_SESSION['__notify'])  { ?>
<script>
    window.location= 'main.php'
</script>
<?

exit(6);

}
?>
<div style="width:99%">
<?

$extra = array();
$date = array();
$op = array();

foreach (xmlCall("network.getDhcpLog",array($_SESSION['ajax']['filter'])) as $line) {
    if (is_array($line)) {
        $extra[] = $line["extra"];
	$op[] = '<a href="#" onClick="$(\'param\').value=\''.$line["op"].'\'; pushSearch(); return false">'.$line["op"].'</a>';
        $dateparsed = strftime('%b %d %H:%M:%S',$line["time"]);
        $date[] = str_replace(" ", "&nbsp;", $dateparsed);
    } else {
        $date[] = "";
        $extra[] = $line;
    }
}

$n = new ListInfos($date, _("Date"),"1px");
$n->addExtraInfo($op, _("Operations"));
$n->addExtraInfo($extra, _("Informations"));
$n->end = 200;
$n->setTableHeaderPadding(1);
$n->display(0,0);

?>
</div>