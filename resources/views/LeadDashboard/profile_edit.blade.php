@extends('layouts.back.master')

@section('content')

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">

            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-home"></i> Accueil</a></li>
                        <li class="active">Edition de profile</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>


            <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="img/profile-avatar.jpg" alt="">
                              </a>
                               <h1>
                                @if (session(SESSION_USER_ACCOUNTS) && count(session(SESSION_USER_ACCOUNTS)))
                                    {{ Auth::user()->account->getDisplayName() }}
                                 @else
                                    {{ Auth::user()->getDisplayName() }}
                                 @endif
                              </h1>

                              <p>
                                @if (session(SESSION_USER_ACCOUNTS) && count(session(SESSION_USER_ACCOUNTS)))
                                    {{ Auth::user()->account->getDisplayName() }}
                                @else
                                    {{ Auth::user()->getReminderEmail()}}
                                @endif
                              </p>
                          </div>

                          <ul class="nav nav-pills nav-stacked">
                              <li>
                                  <a href="{{route('profile')}}"> 
                                  <i class="fa fa-user"></i> Profile
                                  </a>
                              </li>

                              <li>
                                  <a href="{{route('Profile.activite')}}">
                                       <i class="fa fa-calendar"></i> Activites recentes
                                       <span class="label label-danger pull-right r-activity">0</span>
                                  </a>
                              </li>
                              
                              <li  class="active">
                                  <a href="{{route('Profile.edit',Auth::user()->id)}}"> 
                                    <i class="fa fa-edit"></i> Edit profile
                                  </a>
                              </li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              Edition de profile
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1> Profile Info</h1>
                              <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">A propos</label>
                                      <div class="col-lg-10">
                                          <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Prenom</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="f-name" placeholder=" " value="{{Auth::user()->first_name}}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Nom</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="l-name" placeholder=" " value="{{Auth::user()->last_name}}">
                                      </div>
                                  </div>
                                
            
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Occupation</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="occupation" placeholder=" " value="">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Email</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="email" placeholder=" " value="{{Auth::user()->email}}">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Mobile</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mobile" placeholder=" "
                                          value="" >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-lg-2 control-label">Website URL</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="url" placeholder="http://www.test.com ">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button type="submit" class="btn btn-success">Enregistrer</button>
                                          <button type="button" class="btn btn-default">Quitter</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading"> changer Mot de passe & Avatar</div>
                              <div class="panel-body">
                                  <form class="form-horizontal" role="form">
                                      <div class="form-group">
                                          <label  class="col-lg-2 control-label">Mot de passe actuel</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="c-pwd" placeholder=" ">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label  class="col-lg-2 control-label">Nouveau</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="n-pwd" placeholder=" ">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label  class="col-lg-2 control-label">Confirmation</label>
                                          <div class="col-lg-6">
                                              <input type="password" class="form-control" id="rt-pwd" placeholder=" ">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label  class="col-lg-2 control-label"> Avatar</label>
                                          <div class="col-lg-6">
                                              <input type="file" class="file-pos" id="exampleInputFile">
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button type="submit" class="btn btn-info">Enregistrer</button>
                                              <button type="button" class="btn btn-default">Quitter</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>

              <!-- page end-->
        </section>
    </section>
    <!--main content end-->

@endsection
