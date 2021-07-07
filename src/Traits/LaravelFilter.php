<?php

namespace Bagusindrayana\LaravelFilter\Traits;

trait LaravelFilter
{   
    // public $filterFields = [];

    protected function scopeFiltersInput($query,$fields = null,$input = 'cari')
    {   
        $fields = $fields ?? $this->filterFields;
        $query = $query->filters(request()->$input,$fields);
        
        return $query;
    }

    protected function scopeFilters($query,$input,$fields = null)
    {   
        
        $fields = $fields ?? $this->filterFields;
        $query = $query->where(function($model)use($fields,$input){
            foreach($fields as $i => $field){
                if(is_array($field)){
                    
                    foreach($field as $k => $v){
                        $model = $model->orWhereHas($k,function($w)use($v,$input){
                            $w = $w->filters($input,$v);
                        });
                        
                    }
                } else {
                    if($i > 0){
                        $model = $model->orWhere($field,'LIKE','%'.$input.'%');
                    } else {
                        $model = $model->where($field,'LIKE','%'.$input.'%');
                    }
                }
            }
        });
        return $query;
    }
}