<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Limpa a tabela para não duplicar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Definição das Categorias (MESMOS NOMES DO SEU CONTROLLER)
        $setup = [
            'Processadores' => [
                'brand' => ['Intel', 'AMD'],
                'items' => ['Core i9-14900K', 'Core i7-14700K', 'Ryzen 9 7950X', 'Ryzen 7 7800X3D'],
                'min' => 1200, 'max' => 4500
            ],
            'Placas de Vídeo' => [
                'brand' => ['ASUS', 'MSI', 'Gigabyte', 'Galax'],
                'items' => ['RTX 4090 24GB', 'RTX 4070 Ti', 'RX 7900 XTX', 'Intel Arc B580 12GB'],
                'min' => 1800, 'max' => 14000
            ],
            'Placas-Mãe' => [
                'brand' => ['ASUS', 'Gigabyte', 'MSI', 'ASRock'],
                'items' => ['ROG Maximus Z790', 'B650M Aorus Elite', 'X670E Hero', 'B760 Tomahawk'],
                'min' => 600, 'max' => 4200
            ],
            'Memória RAM' => [
                'brand' => ['Kingston', 'Corsair', 'XPG', 'G.Skill'],
                'items' => ['16GB DDR5 6000MHz', '32GB DDR5 5200MHz', '16GB DDR4 3200MHz'],
                'min' => 250, 'max' => 1800
            ],
            'Armazenamento' => [
                'brand' => ['Samsung', 'Kingston', 'WD Black', 'Crucial'],
                'items' => ['SSD 1TB NVMe Gen4', 'SSD 2TB NVMe Gen5', 'HD 4TB Surveillance'],
                'min' => 280, 'max' => 1600
            ],
            'Fontes' => [
                'brand' => ['Corsair', 'XPG', 'MSI', 'Seasonic'],
                'items' => ['750W 80 Plus Gold', '850W Platinum', '1000W Gold Modular'],
                'min' => 380, 'max' => 2200
            ],
            'Gabinetes' => [
                'brand' => ['NZXT', 'Lian Li', 'Corsair', 'Pichau'],
                'items' => ['H9 Flow', 'O11 Dynamic EVO', '4000D Airflow', 'Goblin RGB'],
                'min' => 220, 'max' => 1800
            ]
        ];

        // 3. Gerando os 3.000 itens
        for ($i = 0; $i < 3000; $i++) {
            $catNome = array_rand($setup);
            $info = $setup[$catNome];

            $marca = $info['brand'][array_rand($info['brand'])];
            $modelo = $info['items'][array_rand($info['items'])];

            Product::create([
                'name'           => "{$marca} {$modelo} " . Str::upper(Str::random(3)),
                'brand'          => $marca,
                'category'       => $catNome, // Aqui vai "Processadores", "Placas de Vídeo", etc.
                'price'          => rand($info['min'], $info['max']) + (rand(0, 99) / 100),
                'image'          => null, // As imagens o Blade já resolve pela categoria
                'specifications' => [
                    'origem'   => 'Importado',
                    'garantia' => '12 meses',
                    'estoque'  => rand(1, 50)
                ]
            ]);
        }

        $this->command->info('3.000 produtos inseridos com sucesso!');
    }
}
