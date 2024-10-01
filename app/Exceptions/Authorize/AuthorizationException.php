<?php

namespace App\Exceptions\Authorize;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationException extends Exception
{
    /**
     * Construtor da exceção.
     *
     * @param string $message
     */
    public function __construct(string $message = 'Você não tem permissão para acessar este recurso.')
    {
        parent::__construct($message);
    }

    /**
     * Renderiza a exceção em uma resposta HTTP.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'message'           => $this->getMessage(),
            'developer_message' => 'Acesso negado devido à falta de permissões adequadas.',
        ], Response::HTTP_FORBIDDEN);
    }
}
