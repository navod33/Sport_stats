<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\APIBaseController;
use App\Entities\Blogs\Blog;
use EMedia\Api\Docs\APICall;
use Illuminate\Http\Request;

class BlogsAPIController extends APIBaseController
{


	protected function index(Request $request)
	{
		document(function () {
                	return (new APICall())
					->setGroup('Blog')
					->setName('List Blog Posts')
                	    ->setParams([
                	        'page|Page number',
                        ])
						->setSuccessExample('{
							"payload": [
								{
									"id": 2,
									"title": "test blog 2",
									"description": "vbpiriv",
									"created_at": "2022-11-03T12:24:32.000000Z",
									"updated_at": "2022-11-03T12:24:32.000000Z",
									"image": {
										"key": "file_key_33e77bde-9000-4422-b4a7-794bfc30f740",
										"uuid": "93c27aa1-3bba-4e32-8529-e84eedaf3ab9",
										"original_filename": "NishshankaB-1664791432-1051212549.pdf",
										"file_url": "http://127.0.0.1:8000/pdf/player_performance/NishshankaB-1664791432-1051212549.pdf",
										"permalink": "http://127.0.0.1:8000/files/93c27aa1-3bba-4e32-8529-e84eedaf3ab9/NishshankaB-1664791432-1051212549.pdf"
									}
								},
								{
									"id": 1,
									"title": "test blog 1",
									"description": "vbhsvvg",
									"created_at": "2022-11-03T12:24:32.000000Z",
									"updated_at": "2022-11-03T12:24:32.000000Z",
									"image": {
										"key": "file_key_7e20470c-dc2b-4ecc-835b-3887041bd03f",
										"uuid": "5b777df6-40c5-41b4-bc08-1178057765d8",
										"original_filename": "NishshankaB-1664791347-1546107887.pdf",
										"file_url": "http://127.0.0.1:8000/pdf/player_performance/NishshankaB-1664791347-1546107887.pdf",
										"permalink": "http://127.0.0.1:8000/files/5b777df6-40c5-41b4-bc08-1178057765d8/NishshankaB-1664791347-1546107887.pdf"
									}
								}
							],
							"paginator": {
								"current_page": 1,
								"first_page_url": "http://127.0.0.1:8000/api/v1/blog?page=1",
								"from": 1,
								"last_page": 1,
								"last_page_url": "http://127.0.0.1:8000/api/v1/blog?page=1",
								"links": [
									{
										"url": null,
										"label": "&laquo; Previous",
										"active": false
									},
									{
										"url": "http://127.0.0.1:8000/api/v1/blog?page=1",
										"label": "1",
										"active": true
									},
									{
										"url": null,
										"label": "Next &raquo;",
										"active": false
									}
								],
								"next_page_url": null,
								"path": "http://127.0.0.1:8000/api/v1/blog",
								"per_page": 15,
								"prev_page_url": null,
								"to": 2,
								"total": 2
							},
							"message": "",
							"result": true
						}')
                        ->setSuccessPaginatedObject(Blog::class);
                });

		$items = Blog::with('image')->orderBy('id','desc');

		return response()->apiSuccessPaginated($items->paginate());
	}

}
