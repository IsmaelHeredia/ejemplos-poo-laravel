<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\ProductoDigital;
use App\Models\ProductoFisico;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API de Productos",
 *     version="1.0",
 *     description="API que gestiona productos con ejemplos de POO",
 *     @OA\Contact(
 *         email="soporte@localhost.com"
 *     )
 * )
 *
 * @OA\Tag(
 *     name="Productos",
 *     description="Endpoints para gestionar los productos"
 * )
 */
class ProductoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/productos",
     *     summary="Obtener todos los productos",
     *     tags={"Productos"},
     *     @OA\Response(response=200, description="Lista de productos")
     * )
     */
    public function index()
    {
        return response()->json(Producto::all());
    }

    /**
     * @OA\Post(
     *     path="/api/productos",
     *     summary="Crear un nuevo producto",
     *     tags={"Productos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "descripcion", "precio", "stock", "proveedor_id", "tipo"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="precio", type="number", format="float"),
     *             @OA\Property(property="stock", type="number"),
     *             @OA\Property(property="proveedor_id", type="number"),
     *             @OA\Property(property="tipo", type="string", enum={"fisico", "digital"}),
     *             @OA\Property(property="peso", type="number", format="float"),
     *             @OA\Property(property="dimensiones", type="string"),
     *             @OA\Property(property="url_descarga", type="string"),
     *             @OA\Property(property="licencia", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Producto creado exitosamente")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'tipo' => 'required|string|in:fisico,digital',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);
    
        if ($request->tipo === 'fisico') {
            $producto = ProductoFisico::create($request->all());
        } else {
            $request->validate([
                'url_descarga' => 'required|string',
                'licencia' => 'required|string',
            ]);
            $producto = ProductoDigital::create($request->all());
        }
    
        return response()->json($producto->load('proveedor'), 201);
    }

    /**
     * @OA\Get(
     *     path="/api/productos/{id}",
     *     summary="Obtener un producto por ID",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Producto encontrado"),
     *     @OA\Response(response=404, description="Producto no encontrado")
     * )
     */
    public function show($id)
    {
        $producto = Producto::with('proveedor')->findOrFail($id);
        return response()->json($producto);
    }

    /**
     * @OA\Put(
     *     path="/api/productos/{id}",
     *     summary="Actualizar un producto",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "descripcion", "precio", "stock", "proveedor_id", "tipo"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="precio", type="number", format="float"),
     *             @OA\Property(property="stock", type="number"),
     *             @OA\Property(property="proveedor_id", type="number"),
     *             @OA\Property(property="tipo", type="string", enum={"fisico", "digital"}),
     *             @OA\Property(property="peso", type="number", format="float"),
     *             @OA\Property(property="dimensiones", type="string"),
     *             @OA\Property(property="url_descarga", type="string"),
     *             @OA\Property(property="licencia", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Producto actualizado correctamente"),
     *     @OA\Response(response=404, description="Producto no encontrado")
     * )
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
    
        $request->validate([
            'nombre' => 'sometimes|required|string',
            'descripcion' => 'sometimes|required|string',
            'precio' => 'sometimes|required|numeric',
            'stock' => 'sometimes|required|integer',
            'proveedor_id' => 'sometimes|required|exists:proveedores,id',
        ]);
    
        if ($producto instanceof ProductoFisico) {
            $request->validate([
                'peso' => 'sometimes|required|numeric',
                'dimensiones' => 'sometimes|required|string',
            ]);
        } elseif ($producto instanceof ProductoDigital) {
            $request->validate([
                'url_descarga' => 'sometimes|required|string',
                'licencia' => 'sometimes|required|string',
            ]);
        }
    
        $producto->update($request->all());
    
        return response()->json($producto->load('proveedor'), 200);
    }
    
    /**
     * @OA\Delete(
     *     path="/api/productos/{id}",
     *     summary="Eliminar un producto",
     *     tags={"Productos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Producto eliminado correctamente"),
     *     @OA\Response(response=404, description="Producto no encontrado")
     * )
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        return response()->json(null, 204);
    }
}
