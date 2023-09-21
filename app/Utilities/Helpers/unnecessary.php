<?php

use App\Models\News;

if (!function_exists('_generateRandomWords')) {
    function _generateRandomWords($length)
    {
        $result = '';
        substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"),0,8);
        for ($i=0; $i < $length; $i++) {
            $randomWord = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"),0,rand(1,15)); 
            $result.= ' '.ucfirst($randomWord);
        }
        return $result;
    }
}

if (!function_exists('_seed')) {
    function _seed(int $length)
    {
        $translatableLocales =config('translatable.locales');
        for ($i = 0; $i < $length; $i++) {
            $data = [];
            foreach ( $translatableLocales as $lang) {
                $data[$lang] = [
                    'title' => strtoupper($lang ). ' -- ' . _generateRandomWords(rand(1, 10)).strtoupper($lang ),
                    'description' => strtoupper($lang ) . ' -- ' . _generateRandomWords(rand(500, 5000)).strtoupper($lang )
                ];
            }
            News::create($data);
        }
    }
}
