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
                        <li class="active">Mes informations</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <!-- page start-->
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
                              <li class="active">
                                  <a href="{{route('profile')}}"> 
                                  <i class="fa fa-user"></i> Profile
                                  </a>
                              </li>

                              <li>
                                  <a href="{{route('Profile.activite')}}">
                                       <i class="fa fa-calendar"></i> Activites recentes
                                       <span class="label label-danger pull-right r-activity"></span>
                                  </a>
                              </li>
                              
                              <li>
                                  <a href="{{route('Profile.edit',Auth::user()->id)}}"> 
                                    <i class="fa fa-edit"></i> Modifier profile
                                  </a>
                              </li>
                          </ul>

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="bio-graph-heading">
                              Mes Informations
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1>Bio</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>Prenom</span>: {{ Auth::user()->first_name}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Nom </span>: {{ Auth::user()->last_name}}</p>
                                  </div>
                                  
                              </div>
                          </div>
                      </section>
                     
                  </aside>
              </div>

              <!-- page end-->
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->

@endsection
