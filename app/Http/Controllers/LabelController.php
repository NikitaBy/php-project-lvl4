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
            flash('Не удалось удалить label')->error();

            return redirect()->route('label.index');
        }

        $label->delete();

        return redirect()->route('label.index');
    }

    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function index()
    {
        $labels = Label::paginate();

        return view('label.index', compact('labels'));
    }

    public function store(LabelRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $label = new Label();
        $label->fill($data);
        $label->save();

        return redirect()->route('label.index');
    }

    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
        $data = $request->validated();

        $label->fill($data);
        $label->save();

        return redirect()->route('label.index');
    }
}
