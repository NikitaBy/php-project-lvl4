<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Http\RedirectResponse;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    public function create()
    {
        $label = new Label();

        return view('label.create', compact('label'));
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->count()) {
            flash(__('app.flash.label.delete.error'))->error();

            return redirect()->route('label.index');
        }

        $label->delete();

        flash(__('app.flash.label.delete.success'))->success();

        return redirect()->route('label.index');
    }

    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function index()
    {
        $labels = Label::paginate(5);

        return view('label.index', compact('labels'));
    }

    public function store(LabelRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash(__('app.flash.label.create'))->success();

        return redirect()->route('label.index');
    }

    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
        $data = $request->validated();

        $label->fill($data);
        $label->save();

        flash(__('app.flash.label.update'))->success();

        return redirect()->route('label.index');
    }
}
