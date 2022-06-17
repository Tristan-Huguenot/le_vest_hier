<?php

namespace Vesthier\model;

    class Model
    {
        protected $_bdd;

        function __construct()
        {
            $this->_bdd = $this->dbConnect();
        }

        private function dbConnect()
        {
            try
            {
                $local = 'mysql:host=' . BDD['host'] . ';dbname=' . BDD['name'] . ';charset=utf8';
                $bdd = new \PDO($local, BDD['user'], BDD['password']);
            }
            catch(\Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }

            return $bdd;
        }

        static public function slugify($string, $delimiter = '-') {
            $oldLocale = setlocale(LC_ALL, '0');
            setlocale(LC_ALL, 'en_US.UTF-8');
            $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
            $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
            $clean = strtolower($clean);
            $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
            $clean = trim($clean, $delimiter);
            setlocale(LC_ALL, $oldLocale);
            return $clean;
        }  
        
        static public function xWords(string $string, int $word_limit)
        {
            $string=strip_tags($string);
            $words = explode(' ', $string, ($word_limit + 1));
            if(count($words) > $word_limit){
                array_pop($words);$fin=' [...]';
            }else
                $fin='';
            return implode(' ', $words).$fin;
        }

        static public function str_contains(string $haystack, string $needle)
        {
            return empty($needle) || strpos($haystack, $needle) !== false;
        }

        static public function deleteFrom(string $string, string $select)
        {
            $lastOccurence = strrpos($string, $select);
            $lenght = strlen($string) - 1;

            while($lenght >= $lastOccurence){ 
                $string = substr($string, 0, -1);
                $lenght--;
            }

            return $string;
        }
    }