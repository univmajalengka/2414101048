<?php

function getLaundryServices(): array
{
  return [
    'kiloan_reguler' => [
      'name' => 'Cuci Kering Setrika Reguler',
      'category' => 'Kiloan',
      'price' => 7000,
      'unit' => 'kg',
    ],
    'kiloan_express' => [
      'name' => 'Cuci Kering Setrika Express',
      'category' => 'Kiloan',
      'price' => 10000,
      'unit' => 'kg',
    ],
    'kiloan_super' => [
      'name' => 'Cuci Kering Setrika Super',
      'category' => 'Kiloan',
      'price' => 13000,
      'unit' => 'kg',
    ],
    'pakaian_dress' => [
      'name' => 'Dress/Baju/Gamis',
      'category' => 'Satuan - Pakaian',
      'price' => 17500,
      'unit' => 'pcs',
    ],
    'pakaian_kemeja' => [
      'name' => 'Kemeja/Batik',
      'category' => 'Satuan - Pakaian',
      'price' => 15000,
      'unit' => 'pcs',
    ],
    'pakaian_jas' => [
      'name' => 'Jas',
      'category' => 'Satuan - Pakaian',
      'price' => 20000,
      'unit' => 'pcs',
    ],
    'rumah_bantal' => [
      'name' => 'Bantal',
      'category' => 'Satuan - Rumah Tangga',
      'price' => 15000,
      'unit' => 'pcs',
    ],
    'rumah_guling' => [
      'name' => 'Guling',
      'category' => 'Satuan - Rumah Tangga',
      'price' => 15000,
      'unit' => 'pcs',
    ],
    'rumah_gorden' => [
      'name' => 'Gorden',
      'category' => 'Satuan - Rumah Tangga',
      'price' => 25000,
      'unit' => 'm',
    ],
  ];
}

