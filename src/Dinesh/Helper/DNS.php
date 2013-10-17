<?php

namespace Dinesh\Helper;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DNS1D
 *
 * @author dinesh
 */
class DNS {

    public static function ajax_fill_dropdown($change_dropdown, $replace_dropdown, $url, $empty = array()) {
        $html = '<script type="text/javascript">';

        $html.='jQuery(document).ready(function($) {';
        $html.='jQuery("select[name=\'' . $change_dropdown . '\']").change(function(e){';
        $html.='jQuery.ajax({';
        $html.='type: "POST",';
        $html.='url: "' . $url . '",';
        $html.='dataType:"json",';
        $html.='data: jQuery(this).parents("form").find("input,select").not("[type=hidden][name^=_]").serialize(),';
        $html.='success:function(data){';
        $html.='    jQuery("select[name=\'' . $replace_dropdown . '\']").find("option:not(:first)").remove();';
        if (!empty($empty)) {
            foreach ($empty as $key => $emt) {
                $html.='    jQuery("select[name=\'' . $emt . '\']").find("option:not(:first)").remove();';
            }
        }
        $html.='    jQuery.each(data, function(key,value){';
        $html.='        jQuery("select[name=\'' . $replace_dropdown . '\']").append(\'<option value="\'+key+\'">\'+value+\'</option>\');';
        $html.='});';
        $html.='}';
        $html.='});';
        $html.='});';
        $html.='});';
        $html.='</script>';
        return $html;
    }

    public static function dataSorter($field) {
        $url = Request::url();
        $sort_html = '';
        $sort_html.=DNS::imgBase64("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkRBMTRDODAwNTNENDExRTFCRDRBQ0E5MjhGNjFCNEI1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkRBMTRDODAxNTNENDExRTFCRDRBQ0E5MjhGNjFCNEI1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6REExNEM3RkU1M0Q0MTFFMUJENEFDQTkyOEY2MUI0QjUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6REExNEM3RkY1M0Q0MTFFMUJENEFDQTkyOEY2MUI0QjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4jRrpTAAAA1klEQVR42mL4//8/AwifPn36A4wN5XMC8Qog5gHxWRiggJmZmY8BCTAyMk4BKggH0iA1ISwMWMCZM2digVQSiA1UHAzkp2FVqKSkJM3BwcFw48YNBg0NDYafP39KYlUoJCS0CUjtBlp7mouLyxSIv7MAjdUCCnIyMTGBrDQGsn+ZmJhcRtJ3FkQw8fDw+IGc9e/fP0YQDdQdhs0WJqAbnoqIiMCsZNDS0nqGTSE4zP78+TP/zp07/3///r0WOSzPnTv3D8aGCXIC8Wog5kdWCMTwSAAIMAAR9IYNRWecXQAAAABJRU5ErkJggg==", 'Sorting', array('usemap' => "#" . $field));
        $sort_html.='<map name="' . $field . '">';
        $sort_html.='<area shape="rect" coords="0,0,6,20" href="' . $url . '?' . http_build_query(array("sort_order[$field]" => "desc") + Input::except(array('page', 'sort_order'))) . '" title="DESC" >';
        $sort_html.='<area shape="rect" coords="8,0,13,20" href="' . $url . '?' . http_build_query(array("sort_order[$field]" => "asc") + Input::except(array('page', 'sort_order'))) . '" title="ASC">';
        $sort_html.='</map>';
        return $sort_html;
    }

    public static function imgBase64($base64, $alt = null, $attributes) {
        $attributes['alt'] = $alt;
        $attrib = '';
        foreach ($attributes as $key => $value) {
            $attrib.=' ' . $key . '="' . $value . '"';
        }
        return '<img src="' . $base64 . '"' . $attrib . '>';
    }

}