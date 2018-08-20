<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = array('name', 'title', 'email','content');

    public function createContact($th)
    {
        $th->validate(request(), [
            'name' => 'between:1,2',
            'email' => 'email',
            'title' => 'between:1,30',
            'content' => 'between:1,300'
        ], [
            'name.between' => 'Tên không dài quá 30 kí tự!',
            'title.between' => 'Tiêu đề không dài quá 30 kí tự!',
            'content.between' => 'Nội dung không dài quá 200 kí tự!'
        ]);
        Contact::create([
            'name' => request('name'),
            'email' => request('email'),
            'title' => request('title'),
            'content' => request('content')
        ]);
    }
}
