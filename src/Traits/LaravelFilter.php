<?php

namespace Bagusindrayana\LaravelFilter\Traits;

trait LaravelFilter
{   
    // public $filterFields = [];

    //base loop where
    protected function scopeFilter($query,$input,$fields)
    {
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
    }

    //filter with input
    protected function scopeFiltersInput($query,$fields = null,$input = 'cari')
    {   
        $fields = $fields ?? $this->filterFields;
        
        $query = $query->where(function($q)use($fields,$input){
            if(is_array($input)){
                foreach ($input as $key => $value) {
                    $q = $q->orFilters(request()->$value,$fields);
                }
            } else {
                $q = $q->filters(request()->$input,$fields);
            }
        });
        
        return $query;
    }

    //filter with value
    protected function scopeFilters($query,$input,$fields = null)
    {   
        
        $fields = $fields ?? $this->filterFields;
        $query = $query->where(function($q)use($fields,$input){
            if(is_array($input)){
                foreach ($input as $key => $value) {
                    $q = $q->orFilters($value,$fields);
                }
            } else {
                $q = $q->filter($input,$fields);
            }
        });
        return $query;
    }


    //or filter with input
    protected function scopeOrFiltersInput($query,$fields = null,$input = 'cari')
    {   
        $fields = $fields ?? $this->filterFields;
        
        $query = $query->orWhere(function($q)use($fields,$input){
            if(is_array($input)){
                foreach ($input as $key => $value) {
                    $q = $q->orFilters(request()->$value,$fields);
                }
            } else {
                $q = $q->orFilters(request()->$input,$fields);
            }
        });
        
        return $query;
    }

    //or filter with value
    protected function scopeOrFilters($query,$input,$fields = null)
    {   
        
        $fields = $fields ?? $this->filterFields;
        $query = $query->orWhere(function($q)use($fields,$input){
            if(is_array($input)){
                foreach ($input as $key => $value) {
                    $q = $q->orFilters($value,$fields);
                }
            } else {
                $q = $q->filter($input,$fields);
            }
        });
        return $query;
    }
}