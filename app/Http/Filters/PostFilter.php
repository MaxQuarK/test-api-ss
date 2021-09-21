<?php

namespace App\Http\Filters;


class PostFilter extends QueryFilter
{
    public function category($category = null)
    {
        return $this->builder->where('category_id', '=', $category);
    }

    public function author($user_id = null)
    {
        return $this->builder->where('user_id', '=', $user_id);
    }
}
