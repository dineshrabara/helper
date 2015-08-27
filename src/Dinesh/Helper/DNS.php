<?php

namespace Dinesh\Helper;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Description of DNS1D
 *
 * @author dinesh
 */
class DNS {
    /**
     * 
     * @param type $change_dropdown
     * @param type $replace_dropdown
     * @param type $url
     * @param type $empty
     * @return string
     */
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
    /**
     * 
     * @param type $field
     * @return string
     */
    public static function dataSorter($field,$except = array()) {
        if (empty($except)) {
            $except = Input::except(array('page', 'sort_order'));
        }
        $url = Request::url();
        $sort_html = '';
        $sort_html.=DNS::imgBase64("data:image/png", "iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkRBMTRDODAwNTNENDExRTFCRDRBQ0E5MjhGNjFCNEI1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkRBMTRDODAxNTNENDExRTFCRDRBQ0E5MjhGNjFCNEI1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6REExNEM3RkU1M0Q0MTFFMUJENEFDQTkyOEY2MUI0QjUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6REExNEM3RkY1M0Q0MTFFMUJENEFDQTkyOEY2MUI0QjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4jRrpTAAAA1klEQVR42mL4//8/AwifPn36A4wN5XMC8Qog5gHxWRiggJmZmY8BCTAyMk4BKggH0iA1ISwMWMCZM2digVQSiA1UHAzkp2FVqKSkJM3BwcFw48YNBg0NDYafP39KYlUoJCS0CUjtBlp7mouLyxSIv7MAjdUCCnIyMTGBrDQGsn+ZmJhcRtJ3FkQw8fDw+IGc9e/fP0YQDdQdhs0WJqAbnoqIiMCsZNDS0nqGTSE4zP78+TP/zp07/3///r0WOSzPnTv3D8aGCXIC8Wog5kdWCMTwSAAIMAAR9IYNRWecXQAAAABJRU5ErkJggg==", 'Sorting', array('usemap' => "#" . $field));
        $sort_html.='<map name="' . $field . '">';
        $sort_html.='<area shape="rect" coords="0,0,6,20" href="' . $url . '?' . http_build_query($except + array("sort_order[$field]" => "desc")) . '" title="DESC" >';
        $sort_html.='<area shape="rect" coords="8,0,13,20" href="' . $url . '?' . http_build_query($except + array("sort_order[$field]" => "asc")) . '" title="ASC">';
        $sort_html.='</map>';
        return $sort_html;
    }
    /**
     * 
     * @param type $field
     * @return string
     */
    public static function dataSorterSingle($field, $default = null, $except = array()) {
        if (empty($except)) {
            $except = Input::except(array('page', 'sort_order'));
        }
        $url = Request::url();
        if (Input::get("sort_order.$field") == 'asc') {
            $sort_html = HTML::link($url . '?' . http_build_query($except + array("sort_order[$field]" => "desc")), '<span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span>', array('title' => 'DESC', 'class' => 'dns_sort_desc dns_sort'));
        } elseif (Input::get("sort_order.$field") == 'desc') {
            $sort_html = HTML::link($url . '?' . http_build_query($except + array("sort_order[$field]" => "asc")), '<span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>', array('title' => 'ASC', 'class' => 'dns_sort_asc dns_sort'));
        } elseif ($default == 'asc') {
            $sort_html = HTML::link($url . '?' . http_build_query($except + array("sort_order[$field]" => "desc")), '<span class="glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true"></span>', array('title' => 'DESC', 'class' => 'dns_sort_desc dns_sort'));
        } elseif ($default == 'desc') {
            $sort_html = HTML::link($url . '?' . http_build_query($except + array("sort_order[$field]" => "asc")), '<span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>', array('title' => 'ASC', 'class' => 'dns_sort_asc dns_sort'));
        } else {
            $sort_html = HTML::link($url . '?' . http_build_query($except + array("sort_order[$field]" => "asc")), '<span class="glyphicon glyphicon-sort" aria-hidden="true"></span>', array('title' => 'ASC', 'class' => 'dns_sort_none dns_sort'));
        }
        return HTML::decode($sort_html);
    }
    /**
     * dataSorterMultiple
     * @param type $field
     * @return string
     */
    public static function dataSorterMultiple($field,$except = array()) {
        if (empty($except)) {
            $except = Input::except(array('page', 'sort_order.' . $field));
        }
        $url = Request::url();
        $sort_html = '';
        $sort_html.=DNS::imgBase64("data:image/png", "iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkRBMTRDODAwNTNENDExRTFCRDRBQ0E5MjhGNjFCNEI1IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkRBMTRDODAxNTNENDExRTFCRDRBQ0E5MjhGNjFCNEI1Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6REExNEM3RkU1M0Q0MTFFMUJENEFDQTkyOEY2MUI0QjUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6REExNEM3RkY1M0Q0MTFFMUJENEFDQTkyOEY2MUI0QjUiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4jRrpTAAAA1klEQVR42mL4//8/AwifPn36A4wN5XMC8Qog5gHxWRiggJmZmY8BCTAyMk4BKggH0iA1ISwMWMCZM2digVQSiA1UHAzkp2FVqKSkJM3BwcFw48YNBg0NDYafP39KYlUoJCS0CUjtBlp7mouLyxSIv7MAjdUCCnIyMTGBrDQGsn+ZmJhcRtJ3FkQw8fDw+IGc9e/fP0YQDdQdhs0WJqAbnoqIiMCsZNDS0nqGTSE4zP78+TP/zp07/3///r0WOSzPnTv3D8aGCXIC8Wog5kdWCMTwSAAIMAAR9IYNRWecXQAAAABJRU5ErkJggg==", 'Sorting', array('usemap' => "#" . $field));
        $sort_html.='<map name="' . $field . '">';
        $sort_html.='<area shape="rect" coords="0,0,6,20" href="' . $url . '?' . http_build_query($except + array("sort_order[$field]" => "desc")) . '" title="DESC" >';
        $sort_html.='<area shape="rect" coords="8,0,13,20" href="' . $url . '?' . http_build_query($except + array("sort_order[$field]" => "asc")) . '" title="ASC">';
        $sort_html.='</map>';
        return $sort_html;
    }
    /**
     * 
     * @param type $type
     * @param type $base64
     * @param type $alt
     * @param array $attributes
     * @return type
     */
    public static function imgBase64($type, $base64, $alt = null, $attributes = array()) {
        $attributes['alt'] = $alt;
        $attrib = '';
        if (!empty($attributes))
            foreach ($attributes as $key => $value) {
                $attrib.=' ' . $key . '="' . $value . '"';
            }
        return '<img src="' . $type . ';base64,' . $base64 . '"' . $attrib . '>';
    }
    /**
     * 
     * @param type $code
     * @param type $density
     * @param type $top_txt
     * @param type $is_bottom_code
     * @return type
     */
    public static function code128BarCode($code, $density = 1, $top_txt = "PRODUCT", $is_bottom_code = TRUE) {
        $CODE128A_START_BASE = 103;
        $CODE128B_START_BASE = 104;
        $CODE128C_START_BASE = 105;
        $STOP = 106;

        //Creates an array for alphanumeric codes
        //Formatted as numerical representations of "B S B S B S", where B is the number of lines and S is the number of spaces

        $code128_bar_codes = array(
            212222, 222122, 222221, 121223, 121322, 131222, 122213, 122312, 132212, 221213, 221312, 231212, 112232, 122132, 122231, 113222, 123122, 123221, 223211, 221132, 221231,
            213212, 223112, 312131, 311222, 321122, 321221, 312212, 322112, 322211, 212123, 212321, 232121, 111323, 131123, 131321, 112313, 132113, 132311, 211313, 231113, 231311,
            112133, 112331, 132131, 113123, 113321, 133121, 313121, 211331, 231131, 213113, 213311, 213131, 311123, 311321, 331121, 312113, 312311, 332111, 314111, 221411, 431111,
            111224, 111422, 121124, 121421, 141122, 141221, 112214, 112412, 122114, 122411, 142112, 142211, 241211, 221114, 413111, 241112, 134111, 111242, 121142, 121241, 114212,
            124112, 124211, 411212, 421112, 421211, 212141, 214121, 412121, 111143, 111341, 131141, 114113, 114311, 411113, 411311, 113141, 114131, 311141, 411131, 211412, 211214,
            211232, 23311120
        );

        //Get the width and height of the barcode
        //Determine the height of the barcode, which is >= .5 inches

        $width = (((11 * strlen($code)) + 35) * ($density / 72)); // density/72 determines bar width at image DPI of 72
        $height = ($width * .15 > .7) ? $width * .15 : .7;

        $px_width = round($width * 72);
        //$px_height = ($height * 72);
        $px_height = ($height * 64);
        $font_height = 0;
        $top_font_height = 0;
        if ($is_bottom_code) {
            // Font Size
            $font = 3;
            $font_width = imagefontwidth($font);
            $font_height = imagefontheight($font);
        }
        if (!empty($top_txt)) {
            $top_font = 2;
            $top_font_width = imagefontwidth($top_font);
            $top_font_height = imagefontheight($top_font);
        }
        //Create a true color image at the specified height and width
        //Allocate white and black colors

        $img = imagecreatetruecolor($px_width, $px_height + $font_height);
        $white = imagecolorallocate($img, 255, 255, 255);
        $black = imagecolorallocate($img, 0, 0, 0);

        //Fill the image white
        //Set the line thickness (based on $density)

        imagefill($img, 0, 0, $white);
        imagesetthickness($img, $density);

        //Create the checksum integer and the encoding array
        //Both will be assembled in the loop

        $checksum = $CODE128B_START_BASE;
        $encoding = array($code128_bar_codes[$CODE128B_START_BASE]);

        //Add Code 128 values from ASCII values found in $code

        for ($i = 0; $i < strlen($code); $i++) {

            //Add checksum value of character

            $checksum += (ord(substr($code, $i, 1)) - 32) * ($i + 1);

            //Add Code 128 values from ASCII values found in $code
            //Position is array is ASCII - 32

            array_push($encoding, $code128_bar_codes[(ord(substr($code, $i, 1))) - 32]);
        }

        //Insert the checksum character (remainder of $checksum/103) and $STOP value

        array_push($encoding, $code128_bar_codes[$checksum % 103]);
        array_push($encoding, $code128_bar_codes[$STOP]);

        //Implode the array as string

        $enc_str = implode($encoding);

        //Assemble the barcode

        for ($i = 0, $x = 0, $inc = round(($density / 72) * 100); $i < strlen($enc_str); $i++) {

            //Get the integer value of the string element

            $val = intval(substr($enc_str, $i, 1));

            //Create lines/spaces
            //Bars are generated on even sequences, spaces on odd

            for ($n = 0; $n < $val; $n++, $x+=$inc) {
                if ($i % 2 == 0)
                    imageline($img, $x, 0 + $top_font_height, $x, $px_height, $black);
            }
        }
        //top text
        if (!empty($top_txt)) {
            $top_text_width = $top_font_width * strlen($top_txt);

// Position to align in center
            $top_position_center = ceil(($px_width - $top_text_width) / 2);
            imagestring($img, $top_font, $top_position_center, 0, $top_txt, $black);
        }
        //bottom text
        if ($is_bottom_code) {
            /*
              -----------
              Text Width
              -----------
             */

            $text_width = $font_width * strlen($code);

// Position to align in center
            $position_center = ceil(($px_width - $text_width) / 2);

            /*
              -----------
              Text Height
              -----------
             */

            $text_height = $font_height;

            /*
              -----------------
              Write the string
              -----------------
             */

            imagestring($img, $font, $position_center, $px_height, $code, $black);
        }
        //imagestring($img, 5, 10, $px_height, $code, $black);
        //Return the image
        ob_start();
        imagepng($img);
        //Get the image from the output buffer
        $img_src = ob_get_clean();
        return base64_encode($img_src);
    }

    /**
     * 
     * @param type $query
     * @param type $params
     * @return type
     */
    public static function interpolateQuery($query, $params) {
        $keys = array();

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            if (is_string($key)) {
                $keys[] = '/:' . $key . '/';
            } else {
                $keys[] = '/:' . $key . '/';
            }
        }

        $query = preg_replace($keys, $params, $query, 1, $count);

        #trigger_error('replaced '.$count.' keys');

        return $query;
    }

    /**
     * 
     * @return type
     */
    public static function getQueryLog() {
        $return = array();
        foreach (DB::getQueryLog() as $key => $query) {
            $return[] = static::interpolateQuery($query['query'], $query['bindings']);
        }
        return $return;
    }

    /**
     * 
     * @param type $captcha_name
     * @return type
     */
    public static function create_mathas_captcha($captcha_name = 'math_captcha') {

        $math_captcha = array("first_digit" => rand(1, 9), "second_digit" => rand(1, 9));
        $operand = array("+");
        $math_captcha['operand'] = $operand[rand(0, count($operand) - 1)];
        switch ($math_captcha['operand']) {
            case '-':
                $math_captcha['answer'] = $math_captcha['first_digit'] - $math_captcha['second_digit'];
                break;
            case '+':
                $math_captcha['answer'] = $math_captcha['first_digit'] + $math_captcha['second_digit'];
                break;
            case 'X':
                $math_captcha['answer'] = $math_captcha['first_digit'] * $math_captcha['second_digit'];
                break;
        }
        Session::forget($captcha_name);
        Session::put($captcha_name, $math_captcha);

        return $math_captcha;
    }

    /**
     * 
     * @param type $value
     * @param type $captcha_name
     * @return boolean
     */
    public static function check_captcha($value, $captcha_name = "math_captcha") {
        if (Session::has($captcha_name)) {
            if (Session::get($captcha_name, false)['answer'] == $value) {
                return TRUE;
            }
        }
        return FALSE;
    }
    
    public static function dateFormate($date, $format = 'd-m-Y') {
        return \Carbon\Carbon::createFromFormat($format, $date);
    }
    public static function getUniqueFilename($fileInput, $destination) {
        $filename = $fileInput->getClientOriginalName();
        $i = 0;
        $path_parts = pathinfo($filename);
        $path_parts['filename'] = \Str::slug($path_parts['filename'], '-');
        $filename = $path_parts['filename'];
        while (\File::exists($destination . '/' . $filename . '.' . $path_parts['extension'])) {
            $filename = $path_parts['filename'] . '-' . $i;
            $i++;
        }
        return $filename . '.' . $path_parts['extension'];
    }
}
