<?php

namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\Response;
use App\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

// https://github.com/oktadeveloper/okta-php-laravel-vue-crud-example

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Post::paginate(self::PAGE_PER_ITEM);
        
        return [
            'data' => $records,
            'message' => 'All Record With Paginator',
            'status_code' => Response::HTTP_ACCEPTED
        ];
    }
    
    public function create()
    {
        //
    }
    
    
    public function store(Request $request)
    {
        try {
            dd(auth());
            $data = $request->post();
            $data['user_id'] = auth()->user();
            $data['category_id'] = 1;
            dd($data);
            $new_record = Post::create($data);
            $message = 'New Record insertion is Done!';
            $status_code = Response::HTTP_ACCEPTED;
        } catch ( HttpException $exception ) {
            $message = 'Something Went Wrong!';
            $status_code = Response::HTTP_NOT_FOUND;
        }
        
        
        return [
            'data' => $new_record,
            'message' => $message,
            'status_code' => $status_code,
        ];
    }
    
    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $record = Post::findOrFail($id);
        
        return [
            'data' => $record,
            'message' => 'One Record with the id of' . $id,
            'status_code' => Response::HTTP_ACCEPTED,
        ];
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
    }
    
    public function update(Request $request, $id)
    {
        $selected = Post::findOrFail($id);
        if ( $selected ) {
            Post::find($id)->update($request->post());
            
            return [
                'data' => $request->post(),
                'message' => 'The Record Below Was Updated With The Data Above',
                'original_data' => $selected,
                'status_code' => Response::HTTP_ACCEPTED
            ];
        }
    }
    
    
    public function destroy($id)
    {
        $selected = Post::findOrFail($id);
        if ( $selected ) {
            $record = $selected;
            $selected->delete();
            
            return [
                'data' => $record,
                'message' => 'The Record Above Was Deleted!',
                'status_code' => Response::HTTP_ACCEPTED
            ];
            
        }
    }
}
