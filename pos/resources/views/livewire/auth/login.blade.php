<div class="container">
        <div class="row mt-1">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card mb-2"> 
                    <div class="card bg-primary ">
                    <h4 class="text-center text-white mt-2">Login</h4>
                    </div>
                </div>
                    <div class="card"> 
                    <div class="card-body bg-primary ">
                        <h1 class="text-center text-white"><i class="fas fa-dice-d6 fa-lg mb-4"></i> <br><b> ICEBOX CAFE</b></h1></br>
                        @if(session()->has('error')) <span class="text-danger">{{session('error')}}</span> @endif
                        <form wire:submit.prevent="submit">
                            <div class="form-group text-white">
                            <label for="email">Email</label>
                                <input wire:model="form.email" type="text" class="form-control" placeholder="input your valid email">
                                @error('form.email') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        <div class="form-group text-white">
                            <label for="email">Password</label>
                                <input wire:model="form.password" type="Password" class="form-control" placeholder="input your valid password">
                                @error('form.password') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block btn-white"><b>Login</b></button>
                            </div>
                            <div>
                                <a class="text-white" href="/register"><u>Register</u></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
</div>
