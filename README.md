
    Example to file ajax data

    {{ DNS::ajax_fill_dropdown('country_id','state_id',URL::to('ajax/states')) }}
    {{ DNS::ajax_fill_dropdown('country_id','state_id',URL::to('ajax/states'),array('statea_id','stateb_id')) }}
    {{ DNS::imgBase64("data:image/png", DNS::code128BarCode(123456, 1,'PRODUCT')) }}
