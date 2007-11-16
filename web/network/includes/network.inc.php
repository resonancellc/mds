<?

/**
 * Input with a check for host name validity in a DNS zone. No dot allowed !
 */
class HostnameInputTpl extends InputTpl {

    function HostnameInputTpl($name) {
        $this->name = $name;
        $this->regexp = '/^[a-z][a-z0-9-]*[a-z0-9]$/';
    }

}

/**
 * Input with a basic check for a colon separated list of host name and/or IP
 */
class HostIpListInputTpl extends InputTpl {
    
    function HostIpListInputTpl($name) {
        $this->name = $name;
        $this->regexp = '/^[0-9a-z,.-]*$/';
    }

}

/**
 * Input with a check for a valid net mask (range from 1 to 32)
 */
class NetmaskInputTpl extends InputTpl {

    function NetmaskInputTpl($name) {
        $this->name = $name;
        $this->regexp = '/^([1-9]|[1-2][0-9]|3[0-2])$/';
    }

}

/**
 * Input with a check for a valid simple net mask (8, 16, or 24)
 */
class SimpleNetmaskInputTpl extends InputTpl {

    function SimpleNetmaskInputTpl($name) {
        $this->name = $name;
        $this->regexp = '/^(8|16|24)$/';
    }

}


class GetFreeIPInputTpl extends IPInputTpl {

    function getFreeIPInputTpl() {
        parent::IPInputTpl("ipaddress");        
    }

    function display($arrParam) {
        parent::display($arrParam);
        $zone = $arrParam["zone"];
        $subnet = $arrParam["subnet"];
        $ajaxurl = $arrParam["ajaxurl"];
        print '

<script type="text/javascript">

function setZoneFreeAddress(t) {
    $("ipaddress").value = t.responseText;
    if (! ($("ipaddress").validate()) ) $("ipaddress").value = "";
    new Effect.Highlight("ipaddress",
    { duration: 1.0 });
}

</script>

<input type="button" class="btnPrimary" onclick="new Ajax.Request(\'main.php?module=network&submod=network&action=' . $ajaxurl . '\', {method: \'get\', parameters: \'zone=' . $zone . '&subnet=' . $subnet . '&current=\' + $F(\'ipaddress\'), onSuccess:setZoneFreeAddress});" value="' . _T("Get next free IP address") . '">
';

    }
}

/* Ip functions */

/**
 * Return True if an IP is in a network
 * 
 * If $acceptBoundaries is True, the base network address and the broadcast address are accepted
 */
function ipInNetwork($ip, $network, $mask, $acceptBoundaries = False) {
    $ip = ip2long($ip);
    $network = ip2long($network);
    $mask = intval($mask);
    if (!$acceptBoundaries) {
        if ($ip == $network) return False; /* Network address */
        $ipmask = ip2long("255.255.255.255") << (32 - $mask);
        if ($ip == ($network | (~$ipmask))) return False; /* Broadcast address */
    }
    $ret = True;
    for ($i = 0 ; $i < $mask ; $i++) {
        $n = pow(2, 31 - $i) ;
        if (($n & $ip) != ($n & $network)) {
            $ret = False;
            break;
        }
    }    
    return $ret;
}

/**
 * Return True if IP A is lower than IP B
 */
function ipLowerThan($ipa, $ipb) {
    return ip2long($ipa) < ip2long($ipb);
}

/**
 * Return True if IP is into a IP range
 */
function ipInRange($ip, $ipa, $ipb) {
    return (ip2long($ipa) <= ip2long($ip)) and (ip2long($ip) <= ip2long($ipb));
}

/* Some common used utility functions */

function getSubnetOptions($subnet) {
    $options = array();
    if (isset($subnet[0][1]["dhcpOption"])) {
        foreach($subnet[0][1]["dhcpOption"] as $option) {
            list($name, $value) = explode(" ", $option, 2);
            $options[$name] = trim($value, '"');
        }
    }
    if (isset($options["domain-name"])) {
        $tmp = explode(" ", $options["domain-name"]);
        $options["primarydomainname"] = $tmp[0];
    }    
    return $options;
}

function getSubnetStatements($subnet) {
    $statements = array();
    if (isset($subnet[0][1]["dhcpStatements"])) {
        foreach($subnet[0][1]["dhcpStatements"] as $statement) {
            list($name, $value) = explode(" ", $statement, 2);
            $statements[$name] = trim($value, '"');
        }
    }
    return $statements;
}

?>