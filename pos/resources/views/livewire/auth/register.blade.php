<div class="container">
        <div class="row mt-1">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card mb-2"> 
                    <div class="card bg-primary ">
                    <h4 class="text-center text-white mt-2">Register</h4>
                    </div>
                </div>
                    <div class="card"> 
                    <div class="card-body bg-primary text-white">
                        <h1 class="text-center"><i class="fas fa-dice-d6 fa-lg mb-4 "></i><b> <br> ICEBOX CAFE</b></h1>
                        <form wire:submit.prevent="submit">
                            <div>
                            <label for="email">Name</label>
                                <input wire:model="form.name" type="text" class="form-control" placeholder="input your name">
                                @error('form.name') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="form-group">
                            <label for="email">Email</label>
                                <input wire:model="form.email" type="text" class="form-control" placeholder="input your email">
                                @error('form.email') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        <div class="form-group">
                            <label for="email">Password</label>
                                <input wire:model="form.password" type="Password" class="form-control" placeholder="input your password">
                                @error('form.password') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                            <div class="form-group">
                            <label for="email">Password</label>
                                <input wire:model="form.password_confirmation" type="Password" class="form-control" placeholder="repeat your password">
                                
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block btn-white"><b>Register</b></button>
                            </div>
                            <div class="text-white">
                                <a class="text-white" href="/login"><u>Login</u></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
</div>
