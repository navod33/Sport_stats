<?php

namespace Database\Seeders;

use App\Entities\Files\File;
use EMedia\TestKit\Traits\Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use function MongoDB\BSON\toJSON;

class FilesSeeder extends Seeder
{

    use Faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ([1,2,3] as $index) {
            $key = 'file_key_' . ((string) Str::uuid());
            $file = new File([
                'name' => $key,
                'key' => $key,
                'allow_public_access' => empty($request->allow_public_access)? false: true,
                // 'original_filename' => $result->getOriginalFilename(),
                // 'file_path' => $result->filePath(),
                // 'file_disk' => $result->diskName(),
                'file_url'  => $this->getFaker()->imageUrl,
                'uploaded_by_user_id' => 1,
            ]);
            $file->category = 'user_uploads';
            $file->save();
        }

    }
}
