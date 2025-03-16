<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Services\PagoService;
use App\Services\EnvioService;
use OpenApi\Annotations as OA;

use Exception;

/**
 * @OA\Tag(
 *     name="Api",
 *     description="Endpoints para gestionar los API"
 * )
 */
class ApiController extends Controller
{
    protected $pagoService;
    protected $envioService;

    public function __construct(PagoService $pagoService, EnvioService $envioService)
    {
        $this->pagoService = $pagoService;
        $this->envioService = $envioService;
    }

    /**
     * @OA\Put(
     *     path="/api/productos/{id}/stock",
     *     summary="Modificar stock de manera segura",
     *     tags={"Api"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"cantidad"},
     *             @OA\Property(property="cantidad", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Stock actualizado")
     * )
     */
    public function modificarStock(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->actualizarStock($request->input('cantidad'));
        return response()->json($producto);
    }

    /**
     * @OA\Post(
     *     path="/api/pagos",
     *     summary="Procesar pagos con distintos métodos",
     *     tags={"Api"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"metodo", "monto"},
     *             @OA\Property(property="metodo", type="string"),
     *             @OA\Property(property="monto", type="number")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Pago procesado")
     * )
     */
    /**
     * @OA\Post(
     *     path="/api/pagos",
     *     summary="Procesar un pago",
     *     tags={"Api"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"metodo", "monto"},
     *             @OA\Property(property="metodo", type="string", example="tarjeta"),
     *             @OA\Property(property="monto", type="number", example=100)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Pago procesado correctamente"),
     *     @OA\Response(response=400, description="Método de pago no válido")
     * )
     */
    public function procesarPago(Request $request)
    {
        try {
            $resultado = $this->pagoService->procesar(
                $request->input('metodo'),
                $request->input('monto')
            );
            return response()->json(['mensaje' => $resultado]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/envios",
     *     summary="Procesar un envío",
     *     tags={"Api"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"metodo", "producto_id"},
     *             @OA\Property(property="metodo", type="string", example="aereo"),
     *             @OA\Property(property="producto_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Envío procesado correctamente"),
     *     @OA\Response(response=400, description="Método de envío no válido")
     * )
     */
    public function procesarEnvio(Request $request)
    {
        try {
            $resultado = $this->envioService->procesarEnvio(
                $request->input('metodo'),
                $request->input('producto_id')
            );
            return response()->json(['mensaje' => $resultado]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
