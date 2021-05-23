<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResume;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $resumes = auth()->user()->resumes;
        return view('resumes.index', compact('resumes'));
    }
    public function create()
    {
        $resume = json_encode(Resume::factory()->make());
        return view('resumes.create', compact('resume'));
        //return view('resumes.create');
    }
    private function savaPicture($blob)
    {
        $img = Image::make($blob);
        $fileName = Str::uuid() . '.' . explode('/', $img->mime())[1];
        $filePatch = "/storage/pictures/$fileName";
        $img->save(public_path($filePatch));
        return $filePatch;
    }
    public function store(StoreResume $request)
    {
        $data = $request->validated();
        //return response()->json($data);
        $picture = $data['content']['basics']['picture'];
        //return response($picture);
        if ($picture !== '/storage/pictures/default.jpg') {
            //$patch = $picture->store('pictures','public');
            $uri =  $this->savaPicture($picture);
            $data['content']['basics']['picture'] = $uri;
        }
        $resume = auth()->user()->resumes()->create($data);
        Session::flash('alert', [
            'type' => 'primary',
            'messages' => ["Resume $resume->title created successfully"],
        ]);
        return response($resume, Response::HTTP_CREATED);
    }
    public function edit(Resume $resume)
    {
        $this->authorize('update', $resume);
        return view('resumes.edit', ['resume' => json_encode($resume)]);
    }
    public function update(StoreResume $request, Resume $resume)
    {
        $this->authorize('update', $resume);
        $data = $request->validated();
        //return response()->json($data);
        $picture = $data['content']['basics']['picture'];
        //return response($picture);
        if ($picture !== $resume->content['basics']['picture']) {
            //$patch = $picture->store('pictures','public');
            $uri =  $this->savaPicture($picture);
            $data['content']['basics']['picture'] = $uri;
        }

        $resume->update($data);
        Session::flash('alert', [
            'type' => 'info',
            'messages' => ["Resume $resume->title updated successfully"],
        ]);

        return response(status: Response::HTTP_OK);
    }
    public function destroy(Resume $resume)
    {
        $this->authorize('delete',$resume);
        $resume->delete();

        return redirect()->route('resumes.index')->with('alert', [
            'type' => 'danger',
            'messages' => ["Resume $resume->title deleted successfully"],
        ]);
    }
}
