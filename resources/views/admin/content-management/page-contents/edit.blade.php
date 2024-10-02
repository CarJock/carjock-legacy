@extends('admin.layouts.app')
@section('content')
    {{-- Message --}}




    <div class="container">
        <div class="row">
            <div class="col-6 m-auto mt-5 pt-5">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        {{ $message }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="pb-2">{{ $contents->pages->title }}</h4>
                        <form method="POST" action="{{ route('admin.contents.update', $contents->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                             @if($contents->short_heading != "")
                            <div class="mb-3">
                                <label class="form-label">Short Heading</label>
                                <input type="Text" required class="form-control" value="{{ $contents->short_heading }}"
                                    name="short_heading">
                            </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label">Heading</label>
                                <input type="Text" required class="form-control" value="{{ $contents->heading }}"
                                    name="heading">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Content</label>
                                <textarea required class="form-control"
                                    name="content" rows="6">{{ $contents->content }}</textarea>
                            </div>
                            @if($contents->slot != "")
                            <div class="mb-3">
                                <label class="form-label">Slot</label>
                                <input type="Text" readonly class="form-control" value="{{ $contents->slot }}"
                                    name="slot">
                            </div>
                            @endif
                    </div>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
