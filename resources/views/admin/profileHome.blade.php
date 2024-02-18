<x-app-layout>
<div class="container">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      @include('partials.alert')
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('assets/img/profile.jpg') }}"
                         alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center">{{Auth::user()->name }}</h3>

                  <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">View Profile User</h3>
                    </div>
                <div class="card-body">
                  <div class="tab-content">
                    <form action="{{ route('user.Postprofile') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                            </div>
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                          </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                          <button type="submit" class="btn btn-warning btn-lg" id="btn-simpan"><i class="fas fa-users"></i> Update User</button>
                        </div>
                      </form>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
</div>

</x-app-layout>
