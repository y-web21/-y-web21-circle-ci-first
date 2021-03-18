<?php

namespace App\Library;

class Helper
{
    const id = 1;
    public int $variable;

    public function __construct(int $variable = 1)
    {
        $this->variable = $variable;
    }

    public static function strlimit($value, $limit = 100, $end = '...')
    {
        if (mb_strlen($value, 'UTF-8') <= $limit) {
            return $value;
        }
        return rtrim(mb_substr($value, 0, $limit, 'UTF-8')) . $end;
    }

    public static function acho()
    {
        return 'あちょ～';
    }

    public static function getTableColumnName($model){
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
        return $columns;
    }

    public static function arrayAppendOrOverwrite ($ary, $key, $val){
        if (array_key_exists($key, $ary)){
            $ary[$key] = $val;
        } else {
            $ary += array($key => $val);
        }
        return $ary;
    }
    public static function forgetSessionArticleEdit(){
        request()->session()->forget('editing_title');
        request()->session()->forget('editing_content');
        request()->session()->forget('editing_status');
        request()->session()->forget('transition_source');
    }
}
