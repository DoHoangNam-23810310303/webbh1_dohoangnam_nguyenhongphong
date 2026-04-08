<?php

declare(strict_types=1);

namespace Webbh1\Product;

final class ProductManagementService
{
    public function create(array $data, callable $productCodeExists, callable $saveProduct): array
    {
        $validated = $this->validateProductData($data);
        if ($validated['status'] !== 'valid') {
            return $validated;
        }

        if ($productCodeExists($validated['data']['masp'])) {
            return ['status' => 'product_code_exists'];
        }

        $productId = $saveProduct($validated['data']);

        if (!$productId) {
            return ['status' => 'create_failed'];
        }

        return [
            'status' => 'success',
            'product_id' => (int) $productId,
            'data' => $validated['data'],
        ];
    }

    public function update(array $data, callable $productExists, callable $updateProduct): array
    {
        $productId = isset($data['id_sanpham']) ? (int) $data['id_sanpham'] : 0;
        if ($productId <= 0) {
            return ['status' => 'invalid_product_id'];
        }

        if (!$productExists($productId)) {
            return ['status' => 'product_not_found'];
        }

        $validated = $this->validateProductData($data, false);
        if ($validated['status'] !== 'valid') {
            return $validated;
        }

        $updated = $updateProduct($productId, $validated['data']);

        return $updated ? ['status' => 'success', 'product_id' => $productId] : ['status' => 'update_failed'];
    }

    public function delete(int $productId, callable $productExists, callable $deleteProduct): array
    {
        if ($productId <= 0) {
            return ['status' => 'invalid_product_id'];
        }

        if (!$productExists($productId)) {
            return ['status' => 'product_not_found'];
        }

        return $deleteProduct($productId)
            ? ['status' => 'success', 'product_id' => $productId]
            : ['status' => 'delete_failed'];
    }

    private function validateProductData(array $data, bool $requireImage = true): array
    {
        $product = [
            'tensanpham' => trim((string) ($data['tensanpham'] ?? '')),
            'masp' => trim((string) ($data['masp'] ?? '')),
            'giasp' => trim((string) ($data['giasp'] ?? '')),
            'soluong' => trim((string) ($data['soluong'] ?? '')),
            'hinhanh' => trim((string) ($data['hinhanh'] ?? '')),
            'tomtat' => trim((string) ($data['tomtat'] ?? '')),
            'noidung' => trim((string) ($data['noidung'] ?? '')),
            'tinhtrang' => trim((string) ($data['tinhtrang'] ?? '1')),
            'danhmuc' => trim((string) ($data['danhmuc'] ?? '')),
        ];

        if ($product['tensanpham'] === '') {
            return ['status' => 'empty_product_name'];
        }

        if ($product['masp'] === '') {
            return ['status' => 'empty_product_code'];
        }

        if ($product['giasp'] === '' || !is_numeric($product['giasp']) || (float) $product['giasp'] < 0) {
            return ['status' => 'invalid_price'];
        }

        if ($product['soluong'] === '' || !ctype_digit($product['soluong'])) {
            return ['status' => 'invalid_quantity'];
        }

        if ($requireImage && $product['hinhanh'] === '') {
            return ['status' => 'empty_image'];
        }

        if ($product['danhmuc'] === '' || !ctype_digit($product['danhmuc'])) {
            return ['status' => 'invalid_category'];
        }

        return ['status' => 'valid', 'data' => $product];
    }
}
