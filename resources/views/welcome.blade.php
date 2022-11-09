@extends('partials.base')

@section('title', 'Principal')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="card m-3">
    <div class="card-title text-center my-4">
        <h3>Item's</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('save')}}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Item name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
                <div id="nameHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Item description</label>
                <textarea id="description" name="description" class="form-control" aria-describedby="descriptionHelp"
                    aria-label="With textarea" maxlength="50"></textarea>
                <div id="descriptionHelp" class="form-text">Fill the description.</div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Item category</label>
                {{-- <select id="category" name="category[]" class="mb-3 form-control" aria-describedby="categoryHelp"
                    aria-label="Default select example" multiple="multiple">
                    <option selected>Open this select menu</option>
                </select> --}}
                <input type="text" class="form-control" id="category" name="category" aria-describedby="categoryHelp">
                <div id="categoryHelp" class="form-text">Select categories for assign.</div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    results: $.map(data, function(item) {
                        return {
                            text: item.name,
                            id: item.id
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