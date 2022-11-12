@extends('partials.base')

@section('title', 'Principal')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        {{-- show message from response --}}
        <div class="col-8">
            <div class="card m-2">
                <div class="card-title text-center my-4">
                    <h3>Article's</h1>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('article.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Article name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required>
                            <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Article description</label>
                            <textarea id="description" name="description" class="form-control"
                                aria-describedby="descriptionHelp" aria-label="With textarea" maxlength="50" required></textarea>
                            <div id="descriptionHelp" class="form-text">Fill the description.</div>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Article category</label>
                            <input type="text" class="form-control" id="category" name="category"
                                aria-describedby="categoryHelp">
                            <div id="categoryHelp" class="form-text">Put categories for assign separate by comma.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#caegory').select2({
        tags: true,
        tokenSeparators: [','],
        ajax: {
            url: "{{route('category.search')}}",
            dataType: 'json',
            type: 'POST',
            delay: 250,
            data: function(params) {
                return {
                    search:params
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(article) {
                        return {
                            text: article.name,
                            id: article.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    // search categories in ajax in route category.search and return json
</script>
@endsection