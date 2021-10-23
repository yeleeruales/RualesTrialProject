<?php
    class Model{

        public function __construct(){
  
        }

        public static function getDetails(){
            $result = mysql::select('details', '*');
            return $result;
        }

        public static function getDetailsById($id){
            $result = mysql::select('details', '*', "id = '$id'");
            return $result;
        }

        public static function getDetailsSum(){
            $result = mysql::select('details', 'SUM(sold_items) as sold_items');
            return $result;
        }

        public static function countDetailsSum(){    
            $result  = self::getDetailsSum();     
            return $result[0]['sold_items'];
        }

        public static function getDetailsSumUpToC(){
            $result = mysql::select('details', 'SUM(sold_items) as sold_items', "product != 'Product D'");
            return $result;
        }

        public static function countDetailsSumUpToC(){    
            $result  = self::getDetailsSumUpToC();     
            return $result[0]['sold_items'];
        }

        public static function getDetailsUpToC(){
            $result = mysql::select('details', '*', "product != 'Product D'");
            return $result;
        }

        public static function update($post){
            $id    = $post['id'];
            $exist = mysql::select('details', '*', "id = '$id'");   

            if(is_array($exist)){   
                $fields = mysql::buildFields($post, ", ");
                mysql::update('details', $fields, "id = '$id'");
            } 
        }
    }
?>