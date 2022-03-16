<?php
namespace App\components;


class CheckOptions {
    //2 means no option found;
    // public static function getOptions($option_name){
    //         $option_model = \common\models\Options::find()->where(['option_name' =>$option_name])->one();
    //         if($option_model){
    //             if($option_model->option_value == "enabled"){
    //                 return TRUE;
    //             }else{
    //                 return FALSE;
    //             }
    //         }else{
    //             return 2;
    //         }
    //  }

   public static function generateRandomString($length = 10) {
        $characters = 'niciedu9999';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function getOptionValue($option_name){
            // $option_model = \common\models\Options::find()->where(['option_name' =>$option_name])->one();
            // if($option_model){
            //     if($option_model->option_type == "image"){
            //         return $option_model->option_img_value;
            //     }else if($option_model->option_type == "text"){
            //         return $option_model->option_value;
            //     }else{
            //         return $option_model->option_value;
            //     }
            // }else{
            //     return 2;
            // }
     }
       
     public static function getAlloptions(){
      $option_model =  \App\Options::all();

        $options = [];
            if(count($option_model) > 0){
                foreach ($option_model as $key => $value) {
                    if($value->option_type == "image"){
                        $options[$value['option_name']] = $value->option_img_value;
                    }else if($value->option_type == "text"){
                        $options[$value['option_name']] = $value->option_value;
                    }
                }
            }
        return $options;
     }
}

