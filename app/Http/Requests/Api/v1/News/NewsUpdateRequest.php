<?php

namespace App\Http\Requests\Api\v1\News;

use App\Http\Requests\BaseRequest;

class NewsUpdateRequest extends BaseRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rule = [
            $this->systemLocale=>['required','array'],
            $this->systemLocale.'.title'=>['required','max:255'],
            $this->systemLocale.'.description'=>['required'],
        ];
        $rule['status']=['nullable','integer','in:0,1'];
        $this->translatableLocales=array_filter($this->translatableLocales,function($item) {
            return $item!==$this->systemLocale;
        });

        foreach ($this->translatableLocales as $key => $value) {
            $rule[$value]=['nullable','array'];
            $rule[$value.'.title']=['nullable','required_with:'.$value,'max:255'];
            $rule[$value.'.description']=['nullable','required_with:'.$value];
        }
        
        return $rule;
    }
}
