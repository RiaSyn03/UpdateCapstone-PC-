<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PsychCare2.0</title>

    <!-- Scripts -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->

                     @impersonate()
                    <li class="nav-item">
                    <a href="{{ route('admin.impersonate.destroy') }}">Stop Impersonating</a>
                    </li>
                     @endimpersonate
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
        @include('partials.alerts')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-info mb-3" style="max-width: 10rem;">
                        <div class="card-header font-weight-bold text-center">Accounts</div>
                        <div class="card-body text-center">
                            <h3>{{$numusers}} </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Account Modal -->
            <form method="POST" id="adduser" action="{{ route('index')}}">
                                    @csrf
            <div class="modal fade" id="AddAccountModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="AddModalLabel">Add Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <div class="modal-body">
                                
                                    <div class="row">
                                        <div class="col-8 col-sm-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">First Name</span>
                                                <input type="text" id="fname" name="fname" placeholder="First Name" class="form-control">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Middle Name</span>
                                                <input type="text" id="fname" name="mname" placeholder="Middle Name" class="form-control">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Last Name</span>
                                                <input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">ID Number</span>
                                                <input type="text" id="idnum" name="idnum" placeholder="ID Number" class="form-control">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Email</span>
                                                <input type="text" id="email" name="email" placeholder="Email" class="form-control">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Password</span>
                                                <input type="text" id="password" name="password" placeholder="Passwword" class="form-control">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Confirm Password</span>
                                                <input type="text" id="password-confirm" name="password-confirm" placeholder="Confirm Password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 col-sm-6">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="course" >{{ __('Course') }}</label>
                                                <select class="form-select" id="course" name="course">
                                                    <option>Choose...</option>
                                                    <optgroup label="Bachelor of Science">
                                                            <option value="IT">Information Technology(IT)</option>
                                                            <option value="ICT">Information and Communication Technologies(ICT)</option>
                                                            <option value="CS">Computer Science(CS)</option>
                                                            <option value="IE">Industrial Engineering(IE)</option>
                                                            <option value="CE">Computer Engineering(CE)</option>
                                                    </optgroup>
                                                    <optgroup label="Engineerings">
                                                        <option value="comp">Computer</option>
                                                        <option value="gols">Gols</option>
                                                        <option value="ind">Industrial</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-6">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="year" >{{ __('Year') }}</label>
                                                <select class="form-select" id="year" name="year">
                                                    <option value="1">1st Year</option>
                                                    <option value="2">2nd Year</option>
                                                    <option value="3">3rd Year</option>
                                                    <option value="4">4th Year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="adduser">Submit Account</button>
                            
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header font-weight-bold ">
                            <div class="d-flex">
                                <div class="me-auto p-2"><h3>Manage Accounts</h3></div>
                                <div class="p-2"><input type="text" id="search"class="form-control" placeholder="search" style="width: 15rem"/></div>
                                <div class="p-2"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddAccountModal">Add Account</button></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <div class="panel-body">
                                    <tr>
                                    <th scope="col">ID Number</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Year Level</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Delete</th>
                                    </tr>
                                </div>
                                </thead>
                                <tbody id="dynamic-row">
                                    @foreach($users as $user)
                                        <tr>
                                        <td>{{ $user->idnum }}</td>
                                        <td>{{ $user->lname }}</td>
                                        <td>{{ $user->fname }}</td>
                                        <td>{{ $user->course }}</td>
                                        <td>{{ $user->year }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left">
                                                <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.impersonate', $user->id) }}" class="float-left">
                                                <button type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="float-left">
                                                {{ method_field('DELETE') }}
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-5">
                <a type="button" class="btn btn-info" href="{{ url('home') }}">Back to menu</a>
            </div>
        </div>


            <script type="text/javascript">
            $('body').on('keyup', '#search', function(){
                var searchQuest = $(this).val();

                $.ajax({
                        method:'POST',
                        url:"{{route ('admin.users.index.action') }}",
                        dataType:'json',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            searchQuest: searchQuest,
                        },
                        success:function(res){
                            var tableRow = '';
                            $('#dynamic-row').html('');

                            $.each(res, function(index, value){
                                tableRow = '<tr><td>'+value.idnum+'</td><td>'+value.lname+'</td><td>'+value.fname+'</td><td>'+value.course+'</td><td>'+value.year+'</td><td>'+value.email+'</td><td>'+value.roles+'</td>><td><a href="{{ route('admin.users.edit', $user->id) }}" class="float-left"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button></a></td><td><a href="{{ route('admin.impersonate', $user->id) }}" class="float-left"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button></a></td><td><form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="float-left">{{ method_field('DELETE') }}@csrf<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></form></td></tr>';
                                $('#dynamic-row').append(tableRow);
                            });
                        }
                    });
                });
            </script>
        </main>
    </div>
    <script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    </script>
</body>
</html>
