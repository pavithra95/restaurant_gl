<x-laravel-ui-adminlte::adminlte-layout>
   <style>
    .registerbox{
        background-color: white;
    }
    img{
        display: none
    }
    @media (min-width:768px){
        img{
            display: block;
        }
    }
    @media (max-width:767px) {
        .registerbox{
            background-color: #42A7C3;
        }
    }
    </style>
    <body class="hold-transition login-page " style="background-color: #EBEBEB">
       <div class="d-flex flex-column justify-content-center align-items-center registerbox mt-5">
        <div class="d-flex flex-row m-5">
         <div>
            <div class="card-body login-card-body "  style="border-radius: 20px">
                <h1 class="login-box-msg mt-3" style="font-family: Poppins, var(--default-font-family);
                font-size: 30px;color:black">LOG IN</h1>
            <form method="post" action="{{ url('/login') }}">
                @csrf
                <div class="input-group text-dark">
                    <p style=" font-family: Poppins, var(--default-font-family);color:# color: black;">Email address</p>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="form-control @error('email') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
{{-- 2nd input --}}
              <div class="input-group text-dark">
                 <p style=" font-family: Poppins, var(--default-font-family);color:# color:black; white-space: nowrap;">Password</p>
              </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
               
              {{-- ////  --}}
                <div class="d-flex justify-content-between">
                   
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember" style="font-size:12px;color:black;font-weight:100">Remember Me</label>
                            
                        </div>
                        <div>
                            <p class="text-center" style="font-size:12px;">
                                <a href="{{ route('password.request') }}" style="color:#42A7C3">Forgot Password?</a>
                            </p>
                        </div>
                   
                
                </div>
                {{-- ////// --}}
               <div class="text-center mt-1" style="font-size:12px">
                    <button type="submit" style="background-color:#42A7C3;border:0px;border-radius:5px;" class="text-white px-4 py-2 mt-2">Log In</button>
                    <p>Don't have an account?
                        <a href="{{ route('register') }}" style="color:#42A7C3">Register</a></p>
                </div>
            </form>
        </div>
        </div>



        <img src="{{asset('assets/images/Frame 115.png')}}" height="400px">
            {{-- <div style="border-radius: 20px;
            backdrop-filter: blur(9px); background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.01);margin:15px" >
           
            <p class="p-4 text-white">Enjoy personalized Dining experiences,<br>exclusive offers and more!</p>
            
            <div class="text-center">
                <img src="{{asset('assets/images/rest-01 1.png')}}" style="height:150px;width:150px;border-radius:20px;margin:10px"> 
            </div> 
            </div> --}}
    

    </div>
       </div>
       
                      
      

       
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
