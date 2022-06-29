<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Files\File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

trait GetFiles
{

    /**
     * @param Request $request
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    protected function getImageFromRequest(Request $request, $fieldName = 'image_uuid')
    {
        $image = null;

        if ($request->filled($fieldName)) {
            $image = $this->getUserFileByUuid($request->get($fieldName), $request->user());
            if (!$image) {
                throw new FileNotFoundException();
            }
        }

        return $image;
    }

    protected function getUserFileByUuid($uuid, $user)
    {
        return File::where('uuid', $uuid)
                    ->where('uploaded_by_user_id', $user->id)
                    ->first();
    }

}
