<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $parentId = (int) $this->category->parent_id;
        // $id = (int) $this->category->id;

        if ((int) $this->get('parent_id') != "") {
            $parentId = (int) $this->get('parent_id');
        } else {
            $parentId = (int) 0;
        }

        if ($this->method() == 'PUT') {
            $id = (int) $this->category->id;
            if ($parentId > 0) {
                $name = 'required|unique:categories,name,' . $id . ',id,parent_id,' . $parentId;
            } else {
                $name = 'required|unique:categories,name,' . $id;
            }

            $slug = 'unique:categories,slug,' . $id;
        } else {
            $name = 'required|unique:categories,name,NULL,id,parent_id,' . $parentId;
            $slug = 'unique:categories,slug';
        }

        return [
            'name'      => $name,
            'slug'      => $slug,
            'parent_id' => ''
        ];
    }
}
