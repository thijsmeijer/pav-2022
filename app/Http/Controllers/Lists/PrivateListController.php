<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lists\StoreListRequest;
use App\Http\Requests\Lists\UpdateListRequest;
use App\Http\Resources\Lists\ListResource;
use App\Http\Resources\Lists\PrivateListResource;
use App\Models\UserList;
use App\Services\ListService;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PrivateListController extends Controller
{
    public function __construct(
        public ListService $list,
    ) {
    }

    public function index(): InertiaResponse
    {
        return Inertia::render('Lists/Private/Index');
    }

    public function show(UserList $list): InertiaResponse
    {
        return Inertia::render('Lists/Private/Show', [
            'list' => new PrivateListResource($list),
        ]);
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Lists/Private/Create');
    }

    public function store(StoreListRequest $request)
    {
        $this->list->create($request->validated());

        return Redirect::route('profile.lists');
    }

    public function edit(UserList $list): InertiaResponse
    {
        return Inertia::render('Lists/Private/Edit', [
            'list' => new PrivateListResource($list),
        ]);
    }

    public function update(UpdateListRequest $request, UserList $list)
    {
        $this->list->update($list, $request->validated());

        return Redirect::route('profile.lists.edit', $list);
    }
}
