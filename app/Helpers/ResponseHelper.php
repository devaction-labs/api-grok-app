<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    /**
     * Resposta para sucesso na criação de recurso.
     *
     * @param array<string, mixed>|null $data
     * @return JsonResponse
     */
    public static function created(array $data = null): JsonResponse
    {
        return response()->json($data, Response::HTTP_CREATED);
    }

    /**
     * Resposta para sucesso na atualização de recurso.
     *
     * @return JsonResponse
     */
    public static function updated(): JsonResponse
    {
        return response()->json(['message' => 'Recurso atualizado com sucesso.'], Response::HTTP_OK);
    }

    /**
     * Resposta para exclusão de recurso.
     *
     * @return Response
     */
    public static function deleted(): Response
    {
        return response()->noContent();
    }

    /**
     * Resposta para quando nenhum conteúdo é necessário.
     *
     * @return Response
     */
    public static function noContent(): Response
    {
        return response()->noContent();
    }
}
