<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateContactRequest;
use App\Mail\MailNotify;
use App\Models\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $category = Category::query()->firstWhere('name', 'contact');
        return view('contacts')->with([
            'category' => (new CategoryTransformer)->transform($category)
        ]);
    }

    /**
     * @param \App\Http\Requests\CreateContactRequest $createContactRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMail(CreateContactRequest $createContactRequest){
        $data = $createContactRequest->validated();
        Mail::to($data['email'])->send(new MailNotify($data));
        return response()->json([
            'message' => 'Success ! Please Check Mail'
        ],200);
    }
}
