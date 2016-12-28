<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Exception;
use Highday\Glitter\Services\Admin\ProductsService;
use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /** @var ProductsService */
    protected $db;

    /** @var ProductsService */
    protected $productService;

    public function __construct(DatabaseManager $db, ProductsService $productService)
    {
        $this->db = $db;

        $this->productService = $productService;
    }

    public function products(Request $request)
    {
        $query = $request->input('q', '');

        return view('glitter.admin::products.products', [
            'keyword'  => $query,
            'products' => $this->productService->search($query),
        ]);
    }

    public function inventory(Request $request)
    {
        $query = $request->input('q', '');

        return view('glitter.admin::products.inventory', [
            'keyword'  => $query,
            'products' => $this->productService->search($query),
        ]);
    }

    public function edit($key)
    {
        try {
            return view('glitter.admin::products.edit', [
                'product' => $this->productService->find($key),
            ]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.admin::errors.404');
        }
    }

    public function update(Request $request, $key)
    {
        try {
            $this->db->transaction(function () use ($request, $key) {
                $this->productService->update($key,
                    $request->input('name', ''),
                    $request->input('description', '')
                );
            });

            return redirect()->back()->withFlashMessage([trans('glitter::admin.save.success')]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.admin::errors.404');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}
