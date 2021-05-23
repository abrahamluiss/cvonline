@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="border rounded">
            <div class="container my-3">
                        @if (isset($publish))
                <form method="POST" action="{{ route('publishes.update', $publish->id) }}">
                @method('PUT')

                        @else
                <form method="POST" action="{{ route('publishes.store') }}">

                        @endif
                        @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>RESUME</label>
                            <select id="resume" name="resume_id" class="form-control">
                            @foreach ($resumes as$resume )
                                @if (isset($publish) && $publish->resume->id === $resume->id)
                                <option selected value="{{ $resume->id}}">{{ $resume->title }}</option>
                                @else
                                <option value="{{ $resume->id}}">{{ $resume->title }}</option>

                                @endif
                            @endforeach

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>THME</label>
                            <select id="theme" name="theme_id" class="form-control">

                                @foreach ($themes as $theme )
                                @if (isset($publish) && $publish->theme->id === $theme->id)
                                <option selected value="{{ $theme->id}}">{{ $theme->theme }}</option>
                                @else
                                <option value="{{ $theme->id}}">{{ $theme->theme }}</option>

                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>visibility</label>
                            <select name="visibility" class="form-control">

                                @foreach (['public', 'private', 'hidden'] as $visibility)
                                @if (isset($publish) && $publish->visibility === $visibility)
                                <option selected value="{{ $visibility }}">{{ $visibility }}</option>
                                @else
                                <option value="{{ $visibility }}">{{ $visibility }}</option>

                                @endif
                            @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="mx-auto" style="width: 80px">
                        <button class="btn btn-primary" style="width: 80px" type="submit">
                            submit
                        </button>
                    </div>
                </form>
            </div>


        </div>
        <div class="mt-2">
            <iframe id="iframe" class="border rounded w-100" style="height: 640px"></iframe>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const iframe = document.getElementById('iframe');
        async function loadPreview(resume, theme) {
            iframe.srcdoc = '<h1>Loading Preview...</h1>'
            try{
                const res = await axios.post(route('publishes.preview'), {
                    resume_id: resume,
                    theme_id: theme,
                })
                iframe.srcdoc = res.data;
            }catch(e){
                console.log(e);
            }

        }
        const resume = document.getElementById('resume');
        const theme = document.getElementById('theme');

        await loadPreview(resume.value, theme.value);

        resume.onchange = async (e) => await loadPreview(e.target.value, theme.value);
        theme.onchange = async (e) => await loadPreview(resume.value, e.target.value);
    });
</script>
