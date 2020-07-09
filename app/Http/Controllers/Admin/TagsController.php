<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\DestroyTag;
use App\Http\Requests\Admin\Tag\IndexTag;
use App\Http\Requests\Admin\Tag\StoreTag;
use App\Http\Requests\Admin\Tag\UpdateTag;
use App\Models\Tag;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTag $request
     * @return Response|array
     */
    public function index(IndexTag $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Tag::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.tag.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.tag.create');

        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTag $request
     * @return Response|array
     */
    public function store(StoreTag $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Tag
        $tag = Tag::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/tags'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/tags');
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return void
     */
    public function show(Tag $tag)
    {
        $this->authorize('admin.tag.show', $tag);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function edit(Tag $tag)
    {
        $this->authorize('admin.tag.edit', $tag);


        return view('admin.tag.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTag $request
     * @param Tag $tag
     * @return Response|array
     */
    public function update(UpdateTag $request, Tag $tag)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Tag
        $tag->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/tags'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTag $request
     * @param Tag $tag
     * @throws \Exception
     * @return Response|bool
     */
    public function destroy(DestroyTag $request, Tag $tag)
    {
        $tag->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param  DestroyTag $request
     * @throws  \Exception
     * @return  Response|bool
     */
    public function bulkDestroy(DestroyTag $request) : Response
    {
        DB::transaction(function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function ($bulkChunk) {
                    Tag::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
