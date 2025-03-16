<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Proveedores",
 *     description="Endpoints para gestionar los proveedores"
 * )
 */
class ProveedorController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/proveedores",
     *     summary="Obtener todos los proveedores",
     *     tags={"Proveedores"},
     *     @OA\Response(response=200, description="Lista de proveedores")
     * )
     */
    public function index()
    {
        return response()->json(Proveedor::all());
    }

    /**
     * @OA\Post(
     *     path="/api/proveedores",
     *     summary="Crear un nuevo proveedor",
     *     tags={"Proveedores"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "contacto", "telefono"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="contacto", type="string"),
     *             @OA\Property(property="telefono", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Proveedor creado exitosamente")
     * )
     */
    public function store(Request $request)
    {
        $proveedor = Proveedor::create($request->all());
        return response()->json($proveedor, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/proveedores/{id}",
     *     summary="Obtener un proveedor por ID",
     *     tags={"Proveedores"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Proveedor encontrado"),
     *     @OA\Response(response=404, description="Proveedor no encontrado")
     * )
     */
    public function show($id)
    {
        return response()->json(Proveedor::findOrFail($id));
    }

    /**
     * @OA\Put(
     *     path="/api/proveedores/{id}",
     *     summary="Actualizar un proveedor",
     *     tags={"Proveedores"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "contacto", "telefono"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="contacto", type="string"),
     *             @OA\Property(property="telefono", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Proveedor actualizado correctamente"),
     *     @OA\Response(response=404, description="Proveedor no encontrado")
     * )
     */
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());
        return response()->json($proveedor);
    }

    /**
     * @OA\Delete(
     *     path="/api/proveedores/{id}",
     *     summary="Eliminar un proveedor",
     *     tags={"Proveedores"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Proveedor eliminado correctamente"),
     *     @OA\Response(response=404, description="Proveedor no encontrado")
     * )
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);
        return response()->json(null, 204);
    }
}
