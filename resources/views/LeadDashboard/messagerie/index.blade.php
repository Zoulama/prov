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
                        <li class="active">Boîte de reception</li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                 <!--mail inbox start-->
              <div class="mail-box">
                  <aside class="sm-side">
                      <div class="user-head">
                          <a href="javascript:;" class="inbox-avatar">
                              <img src="img/mail-avatar.jpg" alt="">
                          </a>
                           <div class="user-name">
                              <h5>
                                @if (session(SESSION_USER_ACCOUNTS) && count(session(SESSION_USER_ACCOUNTS)))
                                    {{ Auth::user()->account->getDisplayName() }}
                                 @else
                                    {{ Auth::user()->getDisplayName() }}
                                 @endif
                              </h5>

                              <p>
                                @if (session(SESSION_USER_ACCOUNTS) && count(session(SESSION_USER_ACCOUNTS)))
                                    {{ Auth::user()->account->getDisplayName() }}
                                @else
                                    {{ Auth::user()->getReminderEmail()}}
                                @endif
                              </p>
                          </div>
                          <a href="javascript:;" class="mail-dropdown pull-right">
                              <i class="fa fa-chevron-down"></i>
                          </a>
                      </div>
                      <div class="inbox-body">
                          <a class="btn btn-compose" data-toggle="modal" href="#myModal">
                              Nouveau
                          </a>
                          <!-- Modal -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                          <h4 class="modal-title">Nouveau</h4>
                                      </div>
                                      <div class="modal-body">
                                          
                                          {!! Form::open(['route' => 'messages.store','class' => 'form-horizontal']) !!}
                                             
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Subject</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" name="subject" class="form-control" id="inputPassword1" placeholder="">
                                                      
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea name="message" id="" class="form-control" cols="30" rows="10"></textarea>
                                                  </div>
                                              </div>
                                              @if($users->count() > 0)
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        @foreach($users as $user)
                                                            <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">{!!$user->name!!}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                             @endif

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <button type="submit" class="btn btn-send">Envoyer</button>
                                                  </div>
                                              </div>
                                        {!! Form::close() !!}
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
                      </div>
                      <ul class="inbox-nav inbox-divider">
                          <li class="active">
                              <a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>

                          </li>
                          <li>
                              <a href="#"><i class="fa fa-envelope-o"></i> Sent Mail</a>
                          </li>
                      </ul>

                      

                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Inbox</h3>
                          
                      </div>
                      <div class="inbox-body">
                         <div class="mail-option">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                                 <div class="btn-group" >
                                     <a class="btn mini all" href="#" data-toggle="dropdown">
                                         All
                                         <i class="fa fa-angle-down "></i>
                                     </a>
                                     <ul class="dropdown-menu">
                                         <li><a href="#"> None</a></li>
                                         <li><a href="#"> Read</a></li>
                                         <li><a href="#"> Unread</a></li>
                                     </ul>
                                 </div>
                             </div>

                             <div class="btn-group">
                                 <a class="btn mini tooltips" href="#" data-toggle="dropdown" data-placement="top" data-original-title="Refresh">
                                     <i class=" fa fa-refresh"></i>
                                 </a>
                             </div>
                             <div class="btn-group hidden-phone">
                                 <a class="btn mini blue" href="#" data-toggle="dropdown">
                                     More
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                 </ul>
                             </div>
                             <div class="btn-group">
                                 <a class="btn mini blue" href="#" data-toggle="dropdown">
                                     Move to
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                 </ul>
                             </div>

                             <ul class="unstyled inbox-pagination">
                                 <li><span>1-50 of 234</span></li>
                                 <li>
                                     <a href="#" class="np-btn"><i class="fa fa-angle-left  pagination-left"></i></a>
                                 </li>
                                 <li>
                                     <a href="#" class="np-btn"><i class="fa fa-angle-right pagination-right"></i></a>
                                 </li>
                             </ul>
                         </div>
                          <table class="table table-inbox table-hover">

                            <tbody>
                            @if($threads->count() > 0)
                                @foreach($threads as $thread)
                                {{--*/ $class = $thread->isUnread($currentUserId) ? 'unread' : '' /*--}}
                                    <tr class="{{$class}}">
                                          <td class="inbox-small-cells">
                                              <input type="checkbox" class="mail-checkbox">
                                          </td>
                                          <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                          <td class="">
                                           <h4 class="media-heading">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                                        </td>
                                          <td class="view-message ">
                                            <p>{{ $thread->latestMessage->body }}</p>
                                          </td>
                                          <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                          <td class="view-message  inbox-small-cells">
                                            <p><small><strong>Creator:</strong> {{ $thread->creator()->name }}</small></p>
                                          </td>
                                          <td class="view-message  text-right">
                                              <p><small><strong>Participants:</strong> {{$thread->participantsString(Auth::id())}}</small></p>
                                          </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <p>Aucun messages.</p>
                            @endif
                            </tbody>
                           
                          </table>
                      </div>
                  </aside>
              </div>
              <!--mail inbox end-->
            </div>
            </section>
            
            <!-- page end-->
        
    </section>
    <!--main content end-->

@endsection