
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
    
    use DNS::getQueryLog()  to get query with parameter 


    Add Captcha

```php    

->with('math_captcha', DNS::create_mathas_captcha());


<div class="control-group {{ $errors->has('captcha') ? 'error' : ''}}">
    <h3 style="padding-left: 25px;">
        <span>
            {{$math_captcha['first_digit']}}
            {{$math_captcha['operand']}}
            {{$math_captcha['second_digit']}}
            = 
        </span>
        {{ Form::text('captcha', null,array('class'=>'span1','style'=>'display: inline-block;margin-top: 11px;'))}}
        (?)
    </h3>
    {{ $errors->first('captcha', '<span class="help-inline">:message</span>') }}
    <!--<p style="padding: 0;margin: 0;color: red;font-size: 13px;font-weight: bolder;">ઉપર ના સરવાળા કે બાદબાકી નું પરિણામ અહિં લખો</p>-->
</div>


Validator::extend('check_captcha', function($attribute, $value, $parameters)
{
    return DNS::check_captcha($value);
});
