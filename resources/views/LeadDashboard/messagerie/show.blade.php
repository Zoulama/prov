@extends('layouts.back.master')

@section('content')

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper site-min-height">
            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="dashboard"><i class="fa fa-home"></i>Accueil</a></li>
                        <li><a href="#">Messagerie</a></li>
                        <li class="active">Message</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Message
                               Objet:<h3>{{ $thread->subject }}</h3>
                              <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                          </header>
                          <div class="panel-body">
                            @foreach($thread->messages as $message)
                              <div class="timeline-messages">
                                  <!-- Comment -->
                                  <div class="msg-time-chat">
                                      <a href="#" class="message-img"><img class="avatar" src="img/chat-avatar.jpg" alt=""></a>
                                      <div class="message-body msg-in">
                                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"><a href="#">{{$message->user->name}}</a> envoyé le {{ $message->created_at->diffForHumans() }}</p>
                                              <p>{{ $message->body }}</p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /comment -->
                              </div>
                            @endforeach
                              <div class="chat-form">
                              <h2>Repondre:</h2>
                                {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
                                
                                  <!-- Message Form Input -->
                                    <div class="form-group">
                                        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                                    </div>

                                    @if($users->count() > 0)
                                    <div class="checkbox">
                                        @foreach($users as $user)
                                            <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">{{ $user->name }}</label>
                                        @endforeach
                                    </div>
                                    @endif

                                    <!-- Submit Form Input -->
                                    <div class="form-group">
                                        {!! Form::submit('Submit', ['class' => 'btn btn-primary btn btn-danger form-control']) !!}
                                    </div>
                                    {!! Form::close() !!}
 
                              </div>
                          </div>
                      </section>
                  </div>
            </div>
        </section>
            <!-- page end-->
    </section>
    <!--main content end-->
@endsection


  