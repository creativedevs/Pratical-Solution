<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel 7 & MySQL CRUD Tutorial</title>
</head>
<body>
  <div class="container">
    @yield('main')
  </div>
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form method="post" action="/Pratical-Solution/laravel/people/store" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group row">
            <label for="titleid" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
                <select name="people">
                    @foreach ($data as $key => $node)
                        @foreach ($node['fullName'] as $code => $name)
                            <option value="{{ $node['identifier'] }}">{{ $name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</body>
</html>