
    Example to file ajax data

    {{ DNS::ajax_fill_dropdown('country_id','state_id',URL::to('ajax/states')) }}
    {{ DNS::ajax_fill_dropdown('country_id','state_id',URL::to('ajax/states'),array('statea_id','stateb_id')) }}
    {{ DNS::imgBase64("data:image/png", DNS::code128BarCode(123456, 1,'PRODUCT')) }}


    
    class AjaxController extends BaseController {

        public function postStates($param = array()) {
            $list = array();

            if (Input::get("country_id")) {
                $list = State::where("country_id", "=", Input::get("country_id"))->lists("name", "id");
            } else if (Input::old("country_id")) {
                $list = State::where("country_id", "=", Input::old("country_id"))->lists("name", "id");
            } elseif (isset($param['country_id'])) {
                $list = State::where("country_id", "=", $param['country_id'])->lists("name", "id");
            }
            return $list;
        }
    }
    