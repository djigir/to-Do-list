<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home() {
        return view('vueApp');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('id', 'DESC')->paginate(4);

        return response()->json($tasks);
    }


    /**
     * @param StoreTaskRequest $storeTaskRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTaskRequest $storeTaskRequest)
    {
        $task = Task::create([
            'title' => $storeTaskRequest->get('title'),
            'description' => $storeTaskRequest->get('description')
        ]);

        return response()->json(['status' => 'success', 'msg' => 'Задача создана успешно']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task);
    }


    /**
     * @param UpdateTaskRequest $updateTaskRequest
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateTaskRequest $updateTaskRequest, $id)
    {
        $task = Task::findOrFail($id);
        if ($task) {
            $task->update([
                'title' => $updateTaskRequest->get('title'),
                'description' => $updateTaskRequest->get('description')
            ]);

            return response()->json(['status' => 'success', 'msg' => 'Задача успешно обновлена']);
        }else {
            return response()->json(['status' => 'error', 'msg' => 'Ошибка обновления']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if ($task) {
            $task->delete();

            return response()->json(['status' => 'success', 'msg' => 'Задача успешно удалена']);
        }else {
            return response()->json(['status' => 'error', 'msg' => 'Ошибка удаления']);
        }

    }
}
