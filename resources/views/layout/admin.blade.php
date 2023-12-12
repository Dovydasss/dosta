<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dosta Admin Panel</title>

    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <script src="https://cdn.tiny.cloud/1/ytkislgzs1fcmifohxtpf4wcll8qbhzfbn2r4akfypxeeog1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
        tinymce.init({
            selector: '#footer_text',
            plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>

    <style>
  
        body {
            background-color: #f8f9fa;

        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex: 1;
        }
        .custom-hr {
        border: none;
        border-top: 1px solid #ccc;
        margin: 10px 0;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-light d-flex flex-column">


    <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <!-- Navbar Right Side -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @auth
                    <span class="h4"> {{ Auth::user()->name }} </span>
                    @else
                    <span class="h4"> Anonymous </span>
                    @endauth
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="max-height: 200px; overflow-y: auto;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>



<hr class="custom-hr">

    <div class="container-fluid flex-grow-1">
        <div class="row">
            <!-- Sidebar Menu -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ url('/admin') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt text-dark align-left"></i>
                    <span class="h5 text-dark">Dashboard</span>
                </a>
            </li>

            <!-- Pages -->
            <li class="nav-item">
                <a href="{{ url('/admin/pages') }}" class="nav-link">
                    <i class="fas fa-file-alt text-dark align-left"></i>
                    <span class="h5 text-dark">Pages</span>
                </a>
            </li>

            <!-- Blogs -->
                        <li class="nav-item">
                <a href="{{ url('/admin/blogposts') }}" class="nav-link">
                    <i class="fas fa-newspaper text-dark align-left"></i>
                    <span class="h5 text-dark">Blogs</span>
                </a>
            </li>

            <!-- Menus -->
            <li class="nav-item">
                <a href="{{ url('/admin/menus') }}" class="nav-link">
                    <i class="fas fa-bars text-dark align-left"></i>
                    <span class="h5 text-dark">Menus</span>
                </a>
            </li>

            <!-- Header -->
            <li class="nav-item">
                <a href="{{ url('/admin/header') }}" class="nav-link">
                    <i class="fas fa-heading text-dark align-left"></i>
                    <span class="h5 text-dark">Header</span>
                </a>
            </li>

            <!-- Footer -->
            <li class="nav-item">
                <a href="{{ url('/admin/footer') }}" class="nav-link">
                    <i class="fas fa-shoe-prints text-dark align-left"></i>
                    <span class="h5 text-dark">Footer</span>
                </a>
            </li>

            <!-- Users -->
            <li class="nav-item">
                <a href="{{ url('/admin/users') }}" class="nav-link">
                    <i class="fas fa-users text-dark align-left"></i>
                    <span class="h5 text-dark">Users</span>
                </a>
            </li>

            <!-- Roles -->
            <li class="nav-item">
                <a href="{{ url('/admin/roles') }}" class="nav-link">
                    <i class="fas fa-user-tag text-dark align-left"></i>
                    <span class="h5 text-dark">Roles</span>
                </a>
            </li>

            <!-- Messages -->
            <li class="nav-item">
                <a href="{{ url('/admin/messages') }}" class="nav-link">
                    <i class="fas fa-envelope text-dark align-left"></i>
                    <span class="h5 text-dark">Messages</span>
                </a>
            </li>

            <!-- Contacts -->
            <li class="nav-item">
                <a href="{{ url('/admin/contacts') }}" class="nav-link">
                    <i class="fas fa-address-book text-dark align-left"></i>
                    <span class="h5 text-dark">Contacts</span>
                </a>
            </li>

            <!-- Settings -->
            <li class="nav-item">
                <a href="{{ url('/admin/settings') }}" class="nav-link">
                    <i class="fas fa-cog text-dark align-left"></i>
                    <span class="h5 text-dark">Settings</span>
                </a>
            </li>

        </ul>
    </div>
</nav>






            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 bg-light">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>@yield('title')</h1>
                            </div>
                        </div>
                    </div>
                </div>


                <section class="content">
                    <div class="container-fluid">

                        @yield('content')
                    </div>
                </section>
            </main>
        </div>
    </div>

    <hr class="custom-hr">


    <footer class="footer py-3 bg-light mt-auto">
        <div class="container text-center">
            <span class="text-muted">Copyright © 2023 Dosta - Version 3.1.0</span>
        </div>
    </footer>


</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>