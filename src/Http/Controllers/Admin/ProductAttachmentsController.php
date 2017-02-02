<?php

namespace Highday\Glitter\Http\Controllers\Admin;

use Exception;
use Highday\Glitter\Http\Controllers\Controller;
use Highday\Glitter\Services\Admin\ProductsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductAttachmentsController extends Controller
{
    /** @var ProductsService */
    protected $productService;

    public function __construct(ProductsService $productService)
    {
        $this->productService = $productService;
    }

    public function add(Request $request, $key)
    {
        try {
            $this->transaction(function () use ($request, $key) {
                $this->productService->addAttachment($key, [
                    'url' => $request->input('attachment_url'),
                    'file' => $request->file('attachment_file'),
                ]);
            });

            return redirect()->back()->withFlashMessage([trans('glitter::admin.save.success')]);
        } catch (ModelNotFoundException $e) {
            return view('glitter.admin::errors.404');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
