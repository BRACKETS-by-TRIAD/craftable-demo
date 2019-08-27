<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TranslatableArticle\DestroyTranslatableArticle;
use App\Http\Requests\Admin\TranslatableArticle\IndexTranslatableArticle;
use App\Http\Requests\Admin\TranslatableArticle\StoreTranslatableArticle;
use App\Http\Requests\Admin\TranslatableArticle\UpdateTranslatableArticle;
use App\Models\TranslatableArticle;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TranslatableArticlesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTranslatableArticle $request
     * @return Response|array
     */
    public function index(IndexTranslatableArticle $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TranslatableArticle::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'perex', 'published_at', 'enabled'],

            // set columns to searchIn
            ['id', 'title', 'perex']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.translatable-article.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.translatable-article.create');

        return view('admin.translatable-article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTranslatableArticle $request
     * @return Response|array
     */
    public function store(StoreTranslatableArticle $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the TranslatableArticle
        $translatableArticle = TranslatableArticle::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/translatable-articles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/translatable-articles');
    }

    /**
     * Display the specified resource.
     *
     * @param TranslatableArticle $translatableArticle
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return void
     */
    public function show(TranslatableArticle $translatableArticle)
    {
        $this->authorize('admin.translatable-article.show', $translatableArticle);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TranslatableArticle $translatableArticle
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function edit(TranslatableArticle $translatableArticle)
    {
        $this->authorize('admin.translatable-article.edit', $translatableArticle);

        return view('admin.translatable-article.edit', [
            'translatableArticle' => $translatableArticle,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTranslatableArticle $request
     * @param TranslatableArticle $translatableArticle
     * @return Response|array
     */
    public function update(UpdateTranslatableArticle $request, TranslatableArticle $translatableArticle)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values TranslatableArticle
        $translatableArticle->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/translatable-articles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/translatable-articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTranslatableArticle $request
     * @param TranslatableArticle $translatableArticle
     * @throws \Exception
     * @return Response|bool
     */
    public function destroy(DestroyTranslatableArticle $request, TranslatableArticle $translatableArticle)
    {
        $translatableArticle->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
