<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateAdminAction;
use App\Actions\UpdateAdminAction;
use App\Filters\AdminFilter;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Sorts\AdminSort;
use App\Transformers\AdminTransformer;
use Illuminate\Http\Request;

class AdminController extends ApiController
{
    /**
     * AdminController constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->authorizeResource(Admin::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Filters\AdminFilter $filter
     * @param \App\Sorts\AdminSort $sort
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function index(AdminFilter $filter, AdminSort $sort)
    {
        return $this->httpOK(
            Admin::query()
                 ->filter($filter)
                 ->sortBy($sort)
                 ->paginate($this->per_page),
            AdminTransformer::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateAdminRequest $request
     * @param \App\Actions\CreateAdminAction $action
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function store(CreateAdminRequest $request, CreateAdminAction $action)
    {
        return $this->httpCreated(
            $action->execute($request->validated()),
            AdminTransformer::class);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Admin $admin
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function show(Admin $admin)
    {
        return $this->httpOK($admin, AdminTransformer::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAdminRequest $request
     * @param \App\Models\Admin $admin
     * @param \App\Actions\UpdateAdminAction $action
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateAdminRequest $request, Admin $admin, UpdateAdminAction $action)
    {
        $action->execute($request->validated());

        return $this->httpNoContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Admin $admin
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        /*Can not self delete */
        if (auth()->user()->id == $admin->id) {
            return $this->httpBadRequest(['code' => 400, 'message' => trans('messages.can_not_be_deleted')]);
        }
        $admin->update([
            'is_active' => 0,
        ]);
        $admin->delete();

        return $this->httpNoContent();
    }
}
