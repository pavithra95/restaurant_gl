<x-laravel-ui-adminlte::adminlte-layout>
    <style>
        img{
            display: none;
        }
        @media (min-width:768px){
        img{
            display: block;
        }
    }
    .registercontent{
        background-color: white;
    }
@media (max-width:767px){
    .registercontent{
        background-color: #42A7C3 !important;
    }
}
    </style>
    <body class="hold-transition register-page">
        <div class="d-flex flex-column justify-content-center align-items-center registercontent mt-5">
            <div class="d-flex flex-row m-5 imgbox">
                <img src="{{asset('assets/images/Frame 115.png')}}" height="500px">
             <div>
                <div class="card-body register-card-body"  style="border-radius: 20px">
                    <h1 class="login-box-msg maintext">Register</h1>
                <form method="post" action="{{ route('register')  }}">
                    @csrf
                    <div class="input-group">
                        <p class="txt">Full Name</p>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <p class="txt">Email address</p>
                    </div>
                    <div class="input-group mb-2">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"  placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
    <div class="input-group">
        <p class="txt">Password</p>
    </div>
    <div class="input-group mb-2">
        <input type="password" name="password"
            class="form-control @error('password') is-invalid @enderror" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-group">
        <p class="txt">Retype Password</p>
    </div>
    <div class="input-group">
        <input type="password" name="password_confirmation" class="form-control"
            placeholder="Retype password">
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
        </div>
    </div>
 <div class="icheck-primary">
                    {{-- <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms" style="font-size 16px;font-weight:100">
                        I agree to the <a href="#" style="color:#42A7C3">terms</a>
                    </label> --}}
              
           
                   <div class="text-center mt-1" style="font-size:12px">
                    <button type="submit" style="background-color:#42A7C3;border:0px;border-radius:5px;" class="text-white px-4 py-2 mt-2">Register</button>
                    </div>
                    <p>Already have an account?
                        <a href="{{ route('login') }}" style="color:#42A7C3">Login</a></p>
                </div>
                </form>
            </div>
            </div>
    
    
    
          
        
    
        </div>
           </div>
           
                          
          
       

                       
                     
                      
                      
              
</x-laravel-ui-adminlte::adminlte-layout>
