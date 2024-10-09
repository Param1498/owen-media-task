    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registration Form</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="{{ asset('css/owenMediaCustom.css') }}" rel="stylesheet">

    </head>
    <body>
    <div class="container">
        <div class="form-container">
            <h2><i class="fas fa-user-plus mr-2"></i>Registration Form</h2>

            <!-- Form starts -->
            <form id="registrationForm" action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Name Field -->
                <div class="form-group input-icon">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                    <div class="invalid-feedback" id="nameError"></div>
                    <i class="fas fa-user"></i>
                </div>

                <!-- Email Field -->
                <div class="form-group input-icon">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
                    <div class="invalid-feedback" id="emailError"></div>
                    <i class="fas fa-envelope"></i>
                </div>

                <!-- Gender Radio Buttons -->
                <div class="form-group">
                    <label>Gender:</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                            <label class="form-check-label" for="male"><i class="fas fa-mars gender-icon"></i>Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                            <label class="form-check-label" for="female"><i class="fas fa-venus gender-icon"></i>Female</label>
                        </div>
                        <div class="invalid-feedback" id="genderError"></div>
                    </div>
                </div>

                <!-- PDF File Upload -->
                <div class="form-group">
                    <label for="pdf_file"><i class="fas fa-file-pdf mr-2"></i>Upload PDF (Max 1MB):</label>
                    <input type="file" class="form-control-file" id="pdf_file" name="pdf_file" accept="application/pdf">
                    <div class="invalid-feedback" id="pdfError"></div>
                </div>

                <!-- Password Field -->
                <div class="form-group input-icon">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    <div class="invalid-feedback" id="passwordError"></div>
                    <i class="fas fa-lock"></i>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane mr-2"></i>Submit</button>
            </form>
            <!-- Form ends -->

        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/owenMediaFormValidation.js') }}"></script>
</body>
    </html>
