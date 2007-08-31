<?
require("../../../includes/config.inc.php");
require("../../../includes/i18n.inc.php");
require("../../../includes/acl.inc.php");
require("../../../includes/session.inc.php");
require("../../../modules/network/includes/network-xmlrpc.inc.php");
require ("../../../includes/PageGenerator.php");

$filter = $_GET["filter"];
$zone = $_GET["zone"];
$addresses = array();

$rrs = getZoneObjects($zone, "");

/* Build a $hostname => IP array using A record only */
$records = array();
foreach($rrs as $dn => $entry) {
    $hostname = $entry[1]["relativeDomainName"][0];
    if (isset($entry[1]["aRecord"])) {
        $address = ip2long($entry[1]["aRecord"][0]);
        $records[$hostname] = $address;
    }
}
/* Complete the array using CNAME entries */
$cnames = array();
foreach($rrs as $dn => $entry) {
    $alias = $entry[1]["relativeDomainName"][0];
    if (isset($entry[1]["cNAMERecord"])) {
        $cname = $entry[1]["cNAMERecord"][0];
        $records[$alias] = $records[$cname];
        $cnames[$alias] = $cname;
    }
}
asort($records);

$params = array();
$hosts = array();
$ips = array();
$actionsDel = array();
$actionsMod = array();
$delHostAction = new ActionPopupItem(_T("Delete host (A record)", "network"),"deletehost","supprimer","", "network", "network");
$delAliasAction = new ActionPopupItem(_T("Delete alias (CNAME record)", "network"),"deletehost","supprimer","", "network", "network");
$emptyAction = new EmptyActionItem();
$editAction = new ActionItem(_T("edit record", "network"),"edithost","edit","", "network", "network");
foreach($records as $host => $ip) {
    $ipstr = long2ip($ip);
    $display = True;
    if ($filter) {
        /* Don't display a host if filtered */
        if (
            (strpos($host, $filter) === False)
            && (strpos($ipstr, $filter) === False)
            ) {
            $display = False;
        }
    }
    if ($display) {
        $ips[] = $ipstr;
        $params[] = array("host" => $host, "zone" => $zone);
        if (in_array($host, array_keys($cnames))) {
            $host = "$host (CNAME " . $cnames[$host] . ")";
            $actionsMod[] = $emptyAction;            
            $actionsDel[] = $delAliasAction;
        } else {
            $actionsMod[] = $editAction;
            $actionsDel[] = $delHostAction;
        }
        $hosts[] = $host;        
    }
}

$n = new ListInfos($ips, _T("IP address", "network"));
$n->setTableHeaderPadding(1);
$n->setNavBar(new AjaxNavBar(count($ips), $filter));
$n->addExtraInfo($hosts, _T("Host name", "network"));
$n->setName(_T("Host", "network"));
$n->setParamInfo($params);
$n->disableFirstColumnActionLink();
$n->addActionItemArray($actionsMod);
$n->addActionItemArray($actionsDel);
$n->display();

?>