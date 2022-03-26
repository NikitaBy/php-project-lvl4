<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use App\Service\FlashRenderer;
use Illuminate\Http\RedirectResponse;

class LabelController extends Controller
{
    /**
     * @var FlashRenderer
     */
    private $flashRenderer;

    public function __construct(FlashRenderer $flashRenderer)
    {
        $this->authorizeResource(Label::class, 'label');

        $this->flashRenderer = $flashRenderer;
    }

    public function create()
    {
        $label = new Label();

        return view('label.create', compact('label'));
    }

    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->count()) {
            $this->flashRenderer->renderErrorFlash('app.flash.label.delete.error');

            return redirect()->route('label.index');
        }

        $label->delete();

        $this->flashRenderer->renderSuccessFlash('app.flash.label.delete.success');

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
        $this->setLabelData($label, $data);

        $this->flashRenderer->renderSuccessFlash('app.flash.label.create');

        return redirect()->route('label.index');
    }

    public function update(LabelRequest $request, Label $label): RedirectResponse
    {
        $data = $request->validated();

        $this->setLabelData($label, $data);

        $this->flashRenderer->renderSuccessFlash('app.flash.label.update');

        return redirect()->route('label.index');
    }

    private function setLabelData(Label $label, array $data): void
    {
        $label->fill($data);
        $label->save();
    }
}
