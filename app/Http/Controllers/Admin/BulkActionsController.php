<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BulkAction\DestroyBulkAction;
use App\Http\Requests\Admin\BulkAction\IndexBulkAction;
use App\Http\Requests\Admin\BulkAction\StoreBulkAction;
use App\Http\Requests\Admin\BulkAction\UpdateBulkAction;
use App\Models\BulkAction;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BulkActionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexBulkAction $request
     * @return Response|array
     */
    public function index(IndexBulkAction $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(BulkAction::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'published_at', 'enabled'],

            // set columns to searchIn
            ['id', 'title', 'perex']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.bulk-action.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.bulk-action.create');

        return view('admin.bulk-action.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBulkAction $request
     * @return Response|array
     */
    public function store(StoreBulkAction $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the BulkAction
        $bulkAction = BulkAction::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/bulk-actions'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/bulk-actions');
    }

    /**
     * Display the specified resource.
     *
     * @param BulkAction $bulkAction
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return void
     */
    public function show(BulkAction $bulkAction)
    {
        $this->authorize('admin.bulk-action.show', $bulkAction);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param BulkAction $bulkAction
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function edit(BulkAction $bulkAction)
    {
        $this->authorize('admin.bulk-action.edit', $bulkAction);


        return view('admin.bulk-action.edit', [
            'bulkAction' => $bulkAction,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBulkAction $request
     * @param BulkAction $bulkAction
     * @return Response|array
     */
    public function update(UpdateBulkAction $request, BulkAction $bulkAction)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values BulkAction
        $bulkAction->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/bulk-actions'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                'object' => $bulkAction
            ];
        }

        return redirect('admin/bulk-actions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyBulkAction $request
     * @param BulkAction $bulkAction
     * @throws \Exception
     * @return Response|bool
     */
    public function destroy(DestroyBulkAction $request, BulkAction $bulkAction)
    {
        $bulkAction->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyBulkAction $request
     * @throws \Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyBulkAction $request) : Response
    {
        DB::transaction(function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(function ($bulkChunk) {
                    BulkAction::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
