<?php

namespace Ajiwai\Application\Controllers;

use Ajiwai\Application\Requests\Ajiwai\AjiwaiRequest;
use AjiwaiService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class AjiwaiController extends Controller
{
    /** @var AjiwaiService */
    private $ajiwaiService;

    public function __construct(AjiwaiService $ajiwaiService)
    {
        $this->ajiwaiService = $ajiwaiService;
    }

    public function create($userId, AjiwaiRequest $ajiwaiRequest)
    {
        $this->ajiwaiService->save_ajiwai($userId, $ajiwaiRequest->toEntity());

        // TODO 返すもの
        return [
            'message' => 'Hello world!'
        ];
    }
}
