<?php

declare(strict_types=1);

namespace Ulp\Core\Crud\Controller;

use Illuminate\Http\JsonResponse;

class BaseApiController extends \Illuminate\Routing\Controller {

  /**
   * The fully qualified class name of the model associated with the controller.
   * This must be set overridden the child controller.
   * 
   * @var string
   */
  protected const MODEL_CLASS = null;

  protected function success($data = null, string $message = 'OK', int $code = 200): JsonResponse {
    return response()->json([
      'success' => true,
      'message' => $message,
      'data' => $data,
    ], $code);
  }

  protected function error(string $message = 'Error', int $code = 400, $errors = null): JsonResponse {
    return response()->json([
      'success' => false,
      'message' => $message,
      'errors' => $errors,
    ], $code);
  }

}
