<?php

namespace App\Repositories;

use App\Post;

use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public $post;
    
    public function __construct(Post $post)
    {
        $this->post = $post;
        
    }
    
    public function all()
    {
        return $this->post::all();
    }
    
    public function paginate($perPage = 15, $columns = [ '*' ])
    {
        return $this->post::paginate($perPage, $columns);
    }
    
    public function findOrFail($id)
    {
        return $this->post::findOrFail($id);
    }
}
