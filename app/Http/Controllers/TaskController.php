<?php

namespace App\Http\Controllers;

use App\Common\Utilities\ResponseCode;
use Illuminate\Http\Request;
use App\Task;

class TaskController extends ApiController
{

    public function __construct(Task $task)
    {
        $this->middleware('auth');
        parent::__construct($task);
    }

    public function index(Request $request)
    {
        if ($request->has('q') && !empty($request->q)) {
            $keyword = $request->q;
            $search = $this->_model->all()->where('content', 'LIKE', "%{$keyword}%");
            return $this->respondData($search, $search->count() . ' task');
        }
        if ($this->_model->all()->count() > 0) return $this->respondData($this->_model->all(), $this->_model->all()->count() . ' task');
        return $this->respondWithError(ResponseCode::DATA_NOT_FOUND, $this->_getMessageError(ResponseCode::DATA_NOT_FOUND));
    }

    public function store(Request $request)
    {
        if ($request->user()->can('create-tasks')) {
            $task = new Task($request->all());
            $task->save();
            return $this->respondData($task, "Create task have content is : " . $task->content);
        }

        return $this->respondWithError(ResponseCode::DONT_HAVE_PERMISSION, $this->_getMessageError(ResponseCode::DATA_NOT_FOUND));
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('delete-tasks')) {
            $task = $this->_model->find($id);
            $task->delete();
            return $this->respondData($task, "You are deleted task id : {$id}");
        }

        return $this->respondWithError(ResponseCode::DONT_HAVE_PERMISSION, $this->_getMessageError(ResponseCode::DATA_NOT_FOUND));
    }
}
