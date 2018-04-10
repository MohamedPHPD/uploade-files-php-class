<?php
class upload
{
    public function __construct($directory , $fileName  , $nameType = 'd' , $pref = 'd' , $length_name = 10  , &$allow = 'd')
    {
        // extentions detected
        $path_info   = pathinfo($fileName['name'])                          ;
        $extention   = $path_info['extension']                              ;
        // extentions default allow
        if ($allow   == 'd' || $allow == '') 
        {
            $allow = array('jpg','jpeg','png','gif')                        ;
        } 
        else {
            $allow = $allow                                                 ;
        }
        // new default name
        if ($nameType    == 'd' || $nameType == '')
        { 
            $new_name  = $this->rename_mix($length_name)                    ;
        }
        // name type = number
        elseif($nameType == 'num')
        {
            $new_name   = rand(111111111,999999999)                         ;
        }
        // name type = string
        elseif($nameType == 'str')
        {
            $new_name   = $this->rename_str($length_name)                   ;
        }
        // name type == prefix
        elseif($nameType == 'pref')
        {
            if($pref    != 'd'  || $pref == '')
            {
                /*if detect prefix*/
                $new_name = $pref.'_'.$this->rename_mix($length_name)       ;
            }
            else 
            {
                /* if choose name pref and not detect pref*/
                $new_name = $this->rename_mix($length_name)                 ;
            }
        }
        // original file name
        elseif($nameType == 'org') 
        {
            $new_name = $fileName['name']                                   ;
        }
        if (in_array($extention , $allow))
        {
            $dectins = $directory.'/'.$new_name.'.'.$extention              ;
            
            $muf = move_uploaded_file($fileName['tmp_name'],$dectins)       ;
            if ($muf)
            {
                return $dectins                                             ;
            }
            else
            {
                return ("فشلت عملية رفع الصورة")                          ;
            }
        }
        else
        {
            return ("صيغة الصورة غير مدعومة")                             ;
        }
    }
    private function rename_mix($length = 32)
    {
        $random_string=""                                                   ;
        while(strlen($random_string)<$length && $length > 0) {
            $randnum = mt_rand(9,61)                                        ;
            $random_string .= ($randnum < 10) ? chr($randnum+48) : ($randnum < 36 ?  chr($randnum+55) : $randnum+61);
        }
        return $random_string                                               ;
    }
    private function rename_str($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters)                             ;
        $randomString = ''                                                  ;
        for ($i = 0; $i < $length; $i++) 
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)]    ;
        }
        return $randomString                                                ;
    }
}
