<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laravel 7 & MySQL CRUD Tutorial</title>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    @yield('main')
    
    <h2> Form </h2>
    @if(session('success'))
        <h1>{{session('success')}}</h1>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
  
  <form method="post" action="/Pratical-Solution/laravel/people/store" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="titleid" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <select name="people" id="people">
                    @foreach ($data as $key => $node)
                        @foreach ($node['fullName'] as $code => $name)
                            <option value="{{ $node['identifier'] }}">{{ $name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <!-- Script -->
    <script type="text/javascript">
      $(document).ready(function(){
          // Initialize select2
          $("#people").select2();
      });
    </script>
  </div>
</body>
</html>