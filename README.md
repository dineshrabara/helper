    
    Example to file ajax data
    
    {{ DNS::ajax_fill_dropdown('country_id','state_id',URL::to('ajax/states')) }}
    {{ DNS::ajax_fill_dropdown('country_id','state_id',URL::to('ajax/states'),array('statea_id','stateb_id')) }}
