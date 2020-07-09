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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ['id', 'title', 'published_at', 'enabled', 'updated_by_admin_user_id', 'updated_at'],

            // set columns to searchIn
            ['id', 'title', 'perex'],
            function ($query) use ($request) {
                $query->with(['updatedByAdminUser']);
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
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
        $sanitized['updated_by_admin_user_id'] = Auth::getUser()->id;
    
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

        $article->load('updatedByAdminUser');
    
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
        $sanitized = $request->getSanitized();
        $sanitized['updated_by_admin_user_id'] = Auth::getUser()->id;

        // Update changed values Article
        $article->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/articles'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                'object' => $article
            ];
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

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyArticle $request
     * @throws \Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyArticle $request) : Response
    {
        DB::transaction(function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function ($bulkChunk) {
                    Article::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
