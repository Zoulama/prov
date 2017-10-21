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
                        <li class="active">Tarifs</li>
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

                              <li class="active">
                                  <a href="{{route('Profile.activite')}}">
                                       <i class="fa fa-calendar"></i> Activites recentes
                                       <span class="label label-danger pull-right r-activity">o</span>
                                  </a>
                              </li>
                              
                              <li>
                                  <a href="{{route('Profile.edit',Auth::user()->id)}}"> 
                                    <i class="fa fa-edit"></i> Edit profile
                                  </a>
                              </li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <form>
                              <textarea placeholder="Whats in your mind today?" rows="2" class="form-control input-lg p-text-area"></textarea>
                          </form>
                          <footer class="panel-footer">
                              <button class="btn btn-danger pull-right">Post</button>
                              <ul class="nav nav-pills">
                                  <li>
                                      <a href="#"><i class="fa fa-map-marker"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class="fa fa-camera"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class=" fa fa-film"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class="fa fa-microphone"></i></a>
                                  </li>
                              </ul>
                          </footer>
                      </section>
                      <section class="panel">
                          <div class="panel-body profile-activity">
                              <h5 class="pull-right">12 August 2016</h5>
                              <div class="activity terques">
                                  <span>
                                      <i class="fa fa-shopping-cart"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" fa fa-time"></i>
                                              <h4>10:45 AM</h4>
                                              <p>Purchased new equipments for zonal office setup and stationaries.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="activity alt purple">
                                  <span>
                                      <i class="fa fa-rocket"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow-alt"></div>
                                              <i class=" fa fa-time"></i>
                                              <h4>12:30 AM</h4>
                                              <p>Lorem ipsum dolor sit amet consiquest dio</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="activity blue">
                                  <span>
                                      <i class="fa fa-bullhorn"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" fa fa-time"></i>
                                              <h4>10:45 AM</h4>
                                              <p>teste <br> teste </p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="activity alt green">
                                  <span>
                                      <i class="fa fa-beer"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow-alt"></div>
                                              <i class=" fa fa-time"></i>
                                              <h4>12:30 AM</h4>
                                              <p>teste</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </section>
                      <section class="panel">
                          <header class="panel-heading summary-head">
                              <h4>Day summary</h4>
                              <p>12 August 2016</p>
                          </header>
                          <div class="panel-body">
                              <ul class="summary-list">
                                  <li>
                                      <a href="javascript:;">
                                        <i class=" fa fa-shopping-cart text-primary"></i>
                                          1 Purchase
                                      </a>
                                  </li>
                                  <li>
                                      <a href="javascript:;">
                                          <i class="fa fa-envelope text-info"></i>
                                          15 Emails
                                      </a>
                                  </li>
                                  <li>
                                      <a href="javascript:;">
                                          <i class="fa fa-picture-o text-muted"></i>
                                          2 Photo Upload
                                      </a>
                                  </li>
                                  <li>
                                      <a href="javascript:;">
                                          <i class="fa fa-tags text-success"></i>
                                          19 Sales
                                      </a>
                                  </li>
                                  <li>
                                      <a href="javascript:;">
                                          <i class="fa fa-microphone text-danger"></i>
                                          4 Audio
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </section>
                      <section class="panel">
                          <div class="panel-body profile-activity">
                              <h5 class="pull-right">11 August 2016</h5>
                              <div class="activity terques">
                                  <span>
                                      <i class="fa fa-picture-o"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" fa fa-time"></i>
                                              <h4>10:45 AM</h4>
                                              <p>teste</p>
                                              <div class="album">
                                                  <a href="#">
                                                      <img src="img/pro-ac-1.png" alt="">
                                                  </a>
                                                  <a href="#">
                                                      <img src="img/pro-ac-2.png" alt="">
                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="activity alt purple">
                                  <span>
                                      <i class="fa fa-rocket"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow-alt"></div>
                                              <i class=" fa fa-time"></i>
                                              <h4>12:30 AM</h4>
                                              <p>teste</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </section>
                      <div class="text-center">
                          <a class="btn btn-danger" href="javascript:;">Anciens</a>
                      </div>
                  </aside>
              </div>

              <!-- page end-->
        </section>
    </section>
    <!--main content end-->

@endsection
