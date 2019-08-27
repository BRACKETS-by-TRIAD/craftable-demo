<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticlesWithRelationship\DestroyArticlesWithRelationship;
use App\Http\Requests\Admin\ArticlesWithRelationship\IndexArticlesWithRelationship;
use App\Http\Requests\Admin\ArticlesWithRelationship\StoreArticlesWithRelationship;
use App\Http\Requests\Admin\ArticlesWithRelationship\UpdateArticlesWithRelationship;
use App\Models\ArticlesWithRelationship;
use App\Models\Author;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticlesWithRelationshipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexArticlesWithRelationship $request
     * @return Response|array
     */
    public function index(IndexArticlesWithRelationship $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(ArticlesWithRelationship::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'published_at', 'enabled', 'author_id'],

            // set columns to searchIn
            ['id', 'title', 'perex'],
            function ($query) use ($request) {
                $query->with(['author']);


                if ($request->has('authors')) {
                    $query->whereIn('author_id', $request->get('authors'));
                }
            }
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.articles-with-relationship.index', [
            'data' => $data,
            'authors' => Author::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.articles-with-relationship.create');

        return view('admin.articles-with-relationship.create', [
            'authors' => Author::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticlesWithRelationship $request
     * @return Response|array
     */
    public function store(StoreArticlesWithRelationship $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        $sanitized['author_id'] = $request->getAuthorId();

        // Store the ArticlesWithRelationship
        $articlesWithRelationship = ArticlesWithRelationship::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/articles-with-relationships'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/articles-with-relationships');
    }

    /**
     * Display the specified resource.
     *
     * @param ArticlesWithRelationship $articlesWithRelationship
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return void
     */
    public function show(ArticlesWithRelationship $articlesWithRelationship)
    {
        $this->authorize('admin.articles-with-relationship.show', $articlesWithRelationship);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ArticlesWithRelationship $articlesWithRelationship
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function edit(ArticlesWithRelationship $articlesWithRelationship)
    {
        $this->authorize('admin.articles-with-relationship.edit', $articlesWithRelationship);

        return view('admin.articles-with-relationship.edit', [
            'articlesWithRelationship' => $articlesWithRelationship,
            'authors' => Author::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticlesWithRelationship $request
     * @param ArticlesWithRelationship $articlesWithRelationship
     * @return Response|array
     */
    public function update(UpdateArticlesWithRelationship $request, ArticlesWithRelationship $articlesWithRelationship)
    {
        // Sanitize input
        $sanitized = $request->validated();

        $sanitized['author_id'] = $request->getAuthorId();

        // Update changed values ArticlesWithRelationship
        $articlesWithRelationship->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/articles-with-relationships'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/articles-with-relationships');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyArticlesWithRelationship $request
     * @param ArticlesWithRelationship $articlesWithRelationship
     * @throws \Exception
     * @return Response|bool
     */
    public function destroy(DestroyArticlesWithRelationship $request, ArticlesWithRelationship $articlesWithRelationship)
    {
        $articlesWithRelationship->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
