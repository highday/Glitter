<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Highday\Glitter\Application\Services\Admin\ProductsService;
use Highday\Glitter\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    /** @var ProductsService */
    protected $productService;

    public function __construct(ProductsService $productService)
    {
        $this->productService = $productService;
    }

    public function products(Request $request)
    {
        $query = $request->input('q');
        return view('glitter.admin::products.products', [
            'keyword' => $query,
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
            $name = $request->input('name');
            $description = $request->input('description');
            $this->productService->update($key, $name, $description);
            return redirect()->back()
                ->withFlashMessage(['OK!']);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($e->validator->getMessages());
        } catch (ModelNotFoundException $e) {
            return view('glitter.admin::errors.404');
        }
    }
}
