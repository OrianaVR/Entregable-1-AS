<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

return [
    'between' => [
        'array' => 'El campo :attribute debe tener entre :min y :max elementos.',
        'file' => 'El campo :attribute debe pesar entre :min y :max kilobytes.',
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
    ],
    'date' => 'El campo :attribute debe ser una fecha válida.',
    'email' => 'El campo :attribute debe ser un correo electrónico válido.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'gt' => [
        'array' => 'El campo :attribute debe tener más de :value elementos.',
        'file' => 'El campo :attribute debe pesar más de :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',
    ],
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado no es válido.',
    'int' => 'El campo :attribute debe ser un número entero.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'max' => [
        'array' => 'El campo :attribute no debe tener más de :max elementos.',
        'file' => 'El campo :attribute no debe pesar más de :max kilobytes.',
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'string' => 'El campo :attribute no debe tener más de :max caracteres.',
    ],
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'El campo :attribute debe tener al menos :min elementos.',
        'file' => 'El campo :attribute debe pesar al menos :min kilobytes.',
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'numeric' => 'El campo :attribute debe ser un número.',
    'required' => 'El campo :attribute es obligatorio.',
    'size' => [
        'array' => 'El campo :attribute debe contener :size elementos.',
        'file' => 'El campo :attribute debe pesar :size kilobytes.',
        'numeric' => 'El campo :attribute debe ser :size.',
        'string' => 'El campo :attribute debe tener :size caracteres.',
    ],
    'string' => 'El campo :attribute debe ser un texto.',
    'unique' => 'El :attribute ya está en uso.',

    'attributes' => [
        'address' => 'dirección',
        'brand' => 'marca',
        'category_id' => 'categoría',
        'comment' => 'comentario',
        'currency' => 'moneda',
        'date' => 'fecha',
        'description' => 'descripción',
        'email' => 'correo electrónico',
        'image' => 'imagen',
        'locale' => 'idioma',
        'method' => 'método',
        'name' => 'nombre',
        'order_id' => 'pedido',
        'password' => 'contraseña',
        'payment_method' => 'método de pago',
        'phone' => 'teléfono',
        'price' => 'precio',
        'product_id' => 'producto',
        'quantity' => 'cantidad',
        'rating' => 'calificación',
        'role' => 'rol',
        'status' => 'estado',
        'stock' => 'stock',
        'transaction_code' => 'código de transacción',
    ],
];
