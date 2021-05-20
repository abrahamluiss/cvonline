<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResume;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        //$resume = json_encode(Resume::factory()->make());
        //return view('resumes.create', compact('resume'));
        return view('resumes.create');
    }
    private function savaPicture($blob){
        $img = Image::make($blob);
        $fileName = Str::uuid() . '.' . explode('/', $img->mime())[1];
        $filePatch = "storage/pictures/$fileName";
        $img->save(public_path($filePatch));
        return $filePatch;
    }
    public function store(StoreResume $request)
    {
        $data = $request->validated();
        //return response()->json($data);
        $picture = $data['content']['basics']['picture'];
        //return response($picture);
        if($picture !== '/storage/pictures/default.png'){
            //$patch = $picture->store('pictures','public');
            $uri =  $this->savaPicture($picture);
            $data['content']['basics']['picture'] = $uri;
        }
        $resume = auth()->user()->resumes()->create($data);
        return response($resume, Response::HTTP_CREATED);
    }
    public function edit(Resume $resume)
    {
        $this->authorize('update', $resume);
        return view('resumes.edit', ['resume'=> json_encode($resume)]);
    }
    public function update(StoreResume $request,Resume $resume)
    {
        $this->authorize('update', $resume);
        $data = $request->validated();
        //return response()->json($data);
        $picture = $data['content']['basics']['picture'];
        //return response($picture);
        if($picture !== $resume->content['basics']['picture']){
            //$patch = $picture->store('pictures','public');
            $uri =  $this->savaPicture($picture);
            $data['content']['basics']['picture'] = $uri;
        }

        $resume->update($data);

        return response(status: Response::HTTP_OK);
    }
}
