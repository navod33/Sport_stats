<?php

namespace App\Http\Controllers\API\V1;

use App\Entities\Files\File;
use App\Entities\Files\FilesRepository;
use App\Http\Controllers\API\V1\APIBaseController;
use EMedia\Api\Docs\APICall;
use EMedia\Api\Docs\Param;
use EMedia\MediaManager\Uploader\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FilesAPIController extends APIBaseController
{

	protected $repo;

    protected $uploadDisk = 'user_uploads';

	public function __construct(FilesRepository $repo)
	{
		$this->repo = $repo;
	}

	protected function index(Request $request)
	{
		document(function () {
                	return (new APICall())
                	    ->setParams([
                	        'q|Search query',
                	        'page|Page number',
                        ])
                        ->setSuccessPaginatedObject(File::class);
                });

		$items = $this->repo->search();

		return response()->apiSuccess($items);
	}

    /**
     *
     * Save a file
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        document(function () {
        	return (new APICall)
        	    ->setName('Upload files')
        	    ->setDescription('Use this endpoint to upload all files, including player images. You must use the `uuid` that gets returned, and use it to attach the file to other objects.')
        	    ->setParams([
                    (new Param('file'))->setDescription('Image file to upload. Upload as a form field.')->dataType('File'),
                    (new Param('allow_public_access'))->setDescription('post true if public access allowed, else false.')->dataType('boolean'),
                ])
                ->setSuccessObject(File::class);
        });

        $this->validate($request, [
            'file' => 'required|file',
            'allow_public_access' => 'required|boolean',
            // 'key' => 'required|unique:files,key',
            // 'key' => 'required',
        ]);

        $fh = new FileUploader($request);
        $fh->toDisk($this->uploadDisk)
            ->saveToDir('files')
            ->resizeImageToMaxHeight(600)
            ->resizeImageToMaxWidth(600)
            ->intoSubDirectoryDateFormat('Ym');

        $result = $fh->upload();

        if ($result->isSuccessful()) {
            $key = 'file_key_' . ((string) Str::uuid());
            $file = new File([
                'name' => $key,
                'key' => $key,
                'allow_public_access' => empty($request->allow_public_access)? false: true,
                'original_filename' => $result->getOriginalFilename(),
                'file_path' => $result->filePath(),
                'file_disk' => $result->diskName(),
                'file_url'  => $result->publicUrl(),
                'file_size_bytes' => $result->getFileSize(),
                'uploaded_by_user_id' => $request->user()->id,
            ]);
            $file->category = 'user_uploads';
            $file->save();

            return response()->apiSuccess($file);
        }

        return response()->apiError('File upload failed');
    }

}
