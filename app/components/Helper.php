<?php
namespace App\components;

class Helper{
    
    const STATUS_ACTIVE = 1;
    const STATUS_UNACTIVE = 0;
    
    public static function generateRandomString($length = 10) {
    $characters = '120349283042948';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
        return $randomString;
    }
    public static function common_status(){
        $status = [
            1 => 'ACTIVE', 
            0=>'UNACTIVE',
            ];
        
        return $status;
        
    }
    public static function common_genders(){
        $status = [
            'MALE' => 'MALE', 
            'FEMALE'=>'FEMALE',
            'OTHER'=>'OTHER',
            ];
        
        return $status;
        
    }
    public static function common_page_type(){
        $status = [
            'services' => 'services', 
            'specialities'=>'specialities',
            'page'=>'page',
            ];
        
        return $status;
        
    }
    public static function common_verified(){
        $status = [
            1 => 'YES', 
            0=>'NO',
            ];
        
        return $status;
        
    }
 
    public static function common_volunteer_type(){
        $status = [
            \common\models\User::VOLUNTEER_INDIVIDUAL => \common\models\User::VOLUNTEER_INDIVIDUAL,  
            \common\models\User::VOLUNTEER_CORPORATE => \common\models\User::VOLUNTEER_CORPORATE,
            \common\models\User::VOLUNTEER_NGO => \common\models\User::VOLUNTEER_NGO
            ];
        
        return $status;
        
    }
    public static function common_option_search(){
        $status = [
            [
                'id' => 'section-about-us',
                'value' => 'Section About Us'
            ],

            [
                'id' => 'section-why-choose-us',
                'value' => 'Section Why Choose Us', 
            ],
            [
                'id' => 'section-help',
                'value' => 'Section Help', 
            ],
            [
                'id' => 'section-contact-info',
                'value' => 'Section Contact Info', 
            ],

            [
                'id' => 'section-about-us',
                'value' => 'Section About Us', 
            ],
            [
                'id' => 'section-header',
                'value' => 'Section Header', 
            ],
            [
                'id' => 'section-menu',
                'value' => 'Section Menu', 
            ],

            [
                'id' => 'page-certificate-verification',
                'value'=> 'Page Certificate Verification', 
            ],

            [
                'id' => 'page-all-events',
                'value'=> 'Page All Events', 
            ]
            ];
        
        return $status;
    }
     public static function position_listing(){
        $status = [
            1 => 1, 
            2   =>  2,
            3 => 3,
            4 => 4,
            ];
        
        return $status;
        
    }
    public static function Delivery_Availability(){
        $status = [
        \common\models\Colony::DELIVERY_AVAILABLE => 'DELIVERY AVAILABLE', 
        \common\models\Colony::DELIVERY_NOT_AVAILABLE =>'DELIVERY NOT AVAILABLE'
            ];
        
        return $status;
        
    }
    public static function common_status_for_search(){
        $status = [
            [
                'id'=>1,
             'status'=> 'ACTIVE'  
            ],
            [
                'id'=>0,
             'status'=> 'UNACTIVE', 
            ]
            ];
            
        
        return $status;
        
    }
    public static function common_volunteer_status_for_search(){
        $status = [
            [
                'id'=>\common\models\User::VOLUNTEER_INDIVIDUAL,
             'status'=> \common\models\User::VOLUNTEER_INDIVIDUAL  
            ],
            [
                'id'=>\common\models\User::VOLUNTEER_CORPORATE,
             'status'=> \common\models\User::VOLUNTEER_CORPORATE, 
            ],
            [
                'id'=>\common\models\User::VOLUNTEER_NGO,
             'status'=> \common\models\User::VOLUNTEER_NGO, 
            ]
            ];
        return $status;
        
    }

    public static function get_common_status($find){
        switch($find){
            case 0:
                return "UNACTIVE";
                break;
            case 1:
                return "ACTIVE";
                break;
             default:
                 return "No Found";
            }
            
    }
    public static function get_common_verified($find){
        switch($find){
            case 0:
                return "NO";
                break;
            case 1:
                return "YES";
                break;
             default:
                 return "No Found";
            }
            
    }
    public static function changeTitle($view, $title)
    {
        $view->title = $title;
    }
    public static function getStringParts($string, $i=1){
        if($i=='last'){
            $str = $string;
            $split = explode(" ", $str);
            return $split[count($split)-1];
        }else{
              $txt = $string;
              $str= preg_replace('/\W\w+\s*(\W*)$/', '$1', $txt);
              return $str;     
        }

    }
 
}