<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1 class="mb-4">My Profile</h1>

                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
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

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ Auth::user()->name }}"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="{{ Auth::user()->email }}"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                        >
                    </div>

                    <button type="submit" class="btn btn-info">
                        Update Profile
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-layout>
