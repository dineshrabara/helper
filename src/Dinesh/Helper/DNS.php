<?php

namespace Dinesh\Helper;

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

}