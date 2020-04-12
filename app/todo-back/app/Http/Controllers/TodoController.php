<?php

namespace App\Http\Controllers;


use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * get list of all todo items
     * @return Response
     */
    public function all()
    {
        $todo = Todo::orderBy('created_at', 'DESC')->get();

        return response($todo);
    }

    /**
     * create new todo item
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        # request params should validate

        $todo = new Todo();
        $todo->title = $request->get('title');
        $todo->body = $request->get('body');
        $todo->save();

        return response([
            'id' => $todo->id
        ]);
    }

    /**
     * delete todo item by id
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        # Request params should validate

        Todo::where('id', $request->get('id'))->delete();

        return response([
            'deleted' => true
        ]);
    }
}
