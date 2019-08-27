<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\DestroyArticle;
use App\Http\Requests\Admin\Article\IndexArticle;
use App\Http\Requests\Admin\Article\StoreArticle;
use App\Http\Requests\Admin\Article\UpdateArticle;
use App\Models\Article;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticlesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexArticle $request
     * @return Response|array
     */
    public function index(IndexArticle $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Article::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'published_at', 'enabled'],

            // set columns to searchIn
            ['id', 'title', 'perex']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.article.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.article.create');

        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticle $request
     * @return Response|array
     */
    public function store(StoreArticle $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Article
        $article = Article::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/articles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return void
     */
    public function show(Article $article)
    {
        $this->authorize('admin.article.show', $article);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function edit(Article $article)
    {
        $this->authorize('admin.article.edit', $article);

        return view('admin.article.edit', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticle $request
     * @param Article $article
     * @return Response|array
     */
    public function update(UpdateArticle $request, Article $article)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values Article
        $article->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/articles'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyArticle $request
     * @param Article $article
     * @throws \Exception
     * @return Response|bool
     */
    public function destroy(DestroyArticle $request, Article $article)
    {
        $article->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
