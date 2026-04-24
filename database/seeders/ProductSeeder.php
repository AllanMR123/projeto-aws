<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tenta encontrar os arquivos em dois caminhos possíveis
        $caminhoPadrao = storage_path('app/*.json');
        $caminhoSubpasta = storage_path('app/data/*.json');

        $files = array_merge(glob($caminhoPadrao), glob($caminhoSubpasta));

        if (count($files) === 0) {
            $this->command->error("ERRO: Nenhum arquivo JSON foi encontrado em storage/app ou storage/app/data!");
            $this->command->info("Verifique se os arquivos .json estão na pasta correta.");
            return;
        }

        $this->command->info("Encontrados " . count($files) . " arquivos. Iniciando importação...");

        foreach ($files as $file) {
            $fileName = strtolower(basename($file));

            // Filtro para banir as categorias inúteis
            if (str_contains($fileName, 'package') || str_contains($fileName, 'composer')) {
                $this->command->warn("Pulando arquivo banido: {$fileName}");
                continue;
            }

            $json = file_get_contents($file);
            $data = json_decode($json, true);

            if (!is_array($data)) {
                $this->command->error("Erro ao ler o arquivo: {$fileName}");
                continue;
            }

            $categoryName = strtoupper(basename($file, '.json'));
            $this->command->info("Importando: {$categoryName} (" . count($data) . " itens)");

            foreach ($data as $item) {
                // Aqui usamos o create para inserir no banco
                Product::create([
                    'name'           => $item['name'] ?? 'Sem nome',
                    'brand'          => $item['brand'] ?? 'Genérico',
                    'category'       => $categoryName,
                    'price'          => rand(500, 8000), // Preço aleatório para o TCC
                    'specifications' => $item,
                ]);
            }
        }

        $this->command->info("✅ Importação finalizada com sucesso!");
    }
}
