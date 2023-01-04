<?php

namespace App\Http\Controllers\Lists;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lists\StoreListRequest;
use App\Http\Requests\Lists\UpdateListRequest;
use App\Http\Resources\Lists\ListIndexResource;
use App\Models\UserList;
use App\Repositories\ListRepository;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class PrivateListController extends Controller
{
    public function __construct(
        public ListRepository $list,
    ) {
    }

    public function index(): InertiaResponse
    {
        return Inertia::render('Lists/Private/Index');
    }

    public function show(UserList $list): InertiaResponse
    {
        return Inertia::render('Lists/Private/Show', [
            'list' => new ListIndexResource($list),
        ]);
    }

    public function create(): InertiaResponse
    {
        return Inertia::render('Lists/Private/Create');
    }

    public function store(StoreListRequest $request)
    {
        $this->list->create($request->validated());

        return redirect()->route('profile.lists');
    }

    public function edit(UserList $list): InertiaResponse
    {
        return Inertia::render('Lists/Private/Edit', [
            'list' => new ListIndexResource($list),
        ]);
    }

    public function update(UpdateListRequest $request, UserList $list)
    {
        $this->list->update($list, $request->validated());

        return Redirect::route('lists.edit', $list);
    }
}
