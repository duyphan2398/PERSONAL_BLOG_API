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
}
