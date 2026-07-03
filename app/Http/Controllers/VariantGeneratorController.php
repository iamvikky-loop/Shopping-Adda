<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariantAttribute;

class VariantGeneratorController extends Controller
{
    /**
     * Generate Shopify-style product variants.
     */
    public function generate(Request $request, Product $product)
    {
        $request->validate([
            'attributes' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Delete old variants
            |--------------------------------------------------------------------------
            */

            $product->variants()->delete();

            /*
            |--------------------------------------------------------------------------
            | Prepare selected attributes
            |--------------------------------------------------------------------------
            */

            $attributeSets = [];

            foreach ($request->input('attributes') as $attributeId => $valueIds) {

                if (empty($valueIds)) {
                    continue;
                }

                $attribute = ProductAttribute::find($attributeId);

                if (!$attribute) {
                    continue;
                }

                $values = ProductAttributeValue::whereIn('id', $valueIds)->get();

                if ($values->isEmpty()) {
                    continue;
                }

                $attributeSets[] = [
                    'attribute' => $attribute,
                    'values' => $values,
                ];
            }

            if (empty($attributeSets)) {

                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => 'No attribute values selected.'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Generate combinations
            |--------------------------------------------------------------------------
            */

            $combinations = $this->buildCombinations($attributeSets);

            foreach ($combinations as $combination) {

                $variant = ProductVariant::create([

                    'product_id' => $product->id,

                    'sku' => $this->generateSku($product),

                    'price' => $product->price,

                    'sale_price' => $product->sale_price,

                    'stock' => $product->stock,

                    'status' => true,

                    'color' => $this->findColor($combination),

                    'size' => $this->findSize($combination),
                ]);

                foreach ($combination as $item) {

                    ProductVariantAttribute::create([

                        'product_variant_id' => $variant->id,

                        'product_attribute_id' => $item['attribute']->id,

                        'product_attribute_value_id' => $item['value']->id,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Variants generated successfully.',
                'total_variants' => count($combinations),
                'variants' => $product->variants()
                    ->with([
                        'variantAttributes.attribute',
                        'variantAttributes.attributeValue'
                    ])
                    ->get(),
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Build all possible combinations.
     */
    private function buildCombinations(array $attributeSets)
    {
        $results = [];

        $this->combineRecursive(
            $attributeSets,
            0,
            [],
            $results
        );

        return $results;
    }
        /**
     * Recursive function to generate all combinations (Cartesian product).
     */
    private function combineRecursive(
        array $attributeSets,
        int $index,
        array $current,
        array &$results
    ) {
        if ($index >= count($attributeSets)) {
            $results[] = $current;
            return;
        }

        $attribute = $attributeSets[$index];

        foreach ($attribute['values'] as $value) {

            $newCurrent = $current;

            $newCurrent[] = [
                'attribute' => $attribute['attribute'],
                'value' => $value,
            ];

            $this->combineRecursive(
                $attributeSets,
                $index + 1,
                $newCurrent,
                $results
            );
        }
    }

    /**
     * Generate unique SKU for each variant.
     */
    private function generateSku(Product $product)
    {
        do {

            $sku = strtoupper(
                Str::slug(substr($product->name, 0, 3), '') .
                '-' .
                Str::upper(Str::random(6))
            );

        } while (
            ProductVariant::where('sku', $sku)->exists()
        );

        return $sku;
    }

    /**
     * Extract color from combination (if exists).
     */
    private function findColor(array $combination)
    {
        foreach ($combination as $item) {

            if (strtolower($item['attribute']->name) === 'color') {
                return $item['value']->value;
            }
        }

        return null;
    }

    /**
     * Extract size from combination (if exists).
     */
    private function findSize(array $combination)
    {
        foreach ($combination as $item) {

            if (strtolower($item['attribute']->name) === 'size') {
                return $item['value']->value;
            }
        }

        return null;
    }
    }