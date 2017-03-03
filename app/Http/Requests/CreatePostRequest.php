<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePostRequest extends Request
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
        if($this->post_type == 'text'){
            return [
                'title' => 'required|max:255',
                'body' => 'required',
                'date' => 'required',
                'subreddit' => 'required'
            ];
        }else{
            return [
                'title' => 'required|max:255',
                'url' => 'required',
                'image' => 'required',
                'date' => 'required',
                'subreddit' => 'required'
            ];
        }

    }
}
