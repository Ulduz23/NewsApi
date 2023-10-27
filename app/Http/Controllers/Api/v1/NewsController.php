<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\News\NewsStoreRequest;
use App\Http\Requests\Api\v1\News\NewsUpdateRequest;
use App\Http\Resources\Api\v1\News\NewsDetailResource;
use App\Http\Resources\Api\v1\News\NewsResource;
use App\Models\News;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::paginate($this->limit);
        $newsCount = $news->total();
        $newsResource  = NewsResource::collection($news);
        return $this->sendResponse($newsResource, $newsCount);
    }

    // public function store(NewsStoreRequest $request)
    // {
    //     $request = $request->validated();
    //     try {
    //         DB::beginTransaction();
           
    //         News::create($request);
           
    //         DB::commit();
    //         return $this->sendResponseOperation();
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         throw $th;
    //     }
    // }
    public function store(NewsStoreRequest $request)
    {   
        return (new NewsResource(News::create($request->all())))->additional([
            'message' => __('lang.created.success')
        ]);
    }


    public function show(News $news)
    {
        $news->increment('view_count');
        $newsDetail = new NewsDetailResource($news);
        return $this->sendResponse($newsDetail);
    }

    public function update(NewsUpdateRequest $request, News $news)
    {
        $request = $request->validated();
        try {
            DB::beginTransaction();
            
            $news->update($request);
            
            DB::commit();
            return $this->sendResponseOperation();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy(News $news)
    {
        try {
            DB::beginTransaction();

            $news->delete();
            
            DB::commit();
            return $this->sendResponseOperation();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
