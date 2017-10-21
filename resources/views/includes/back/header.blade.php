<!--header start-->
<header class="header white-bg">
    <div class="sidebar-toggle-box">
        <i class="fa fa-bars"></i>
    </div>
    <!--logo start-->
    <a href="#" class="logo" >Flat<span>lab</span></a>
    <!--logo end-->

    <div class="top-nav ">
        <ul class="nav pull-right top-menu">
        <li class="dropdown">
                <div class="btn-group dropdown">
                        <button class="btn btn-round btn-danger dropdown-toggle" type="button" data-toggle="dropdown" id="cart-shop">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="cart-count default-bg">{{Cart::count()}}</span>
                            Panier
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right dropdown-animation cart">
                            <li>
                            @if(Cart::count()!=0)
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="type_lead">Type</th>
                                            <th class="location">Adresse</th>
                                            <th class="formule_lead">Formule</th>
                                            <th class="prix">Prix</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{--*/ $cartC=Cart::content()->slice(0,5) /*--}}
                                    
                                        @foreach($cartC as $row)
                                        <tr>
                                            <td class="type_lead"><a href="{{route('Prospect.show',array($row->options->type,$row->options->id))}}">{{$row->name}}</a></td>
                                            <td class="location">{{$row->options->zipcode}} {{$row->options->ville}}</td>
                                            <td class="formule_lead">{{$row->options->for}}</td>
                                            <td class="prix">{{$row->price}}&euro;</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td class="total-quantity" colspan="2">{{Cart::count()}}</td>
                                            <td class="total-price">{{Cart::total()}}&euro;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="panel-body text-right">
                                    <a href="{{route('Prospect.CartView')}}" class="btn btn-group btn-gray btn-sm">Voir Panier</a>
                                    <a href="{{route('Prospect.PayByCard')}}" class="btn btn-group btn-default">
                                      <i class="icon-left-open-big"></i> Payez par carte
                                    </a>
                                    <a href="{{route('Prospect.PayByCredits')}}" class="btn btn-group btn-default">
                                      <i class="icon-check"></i> Payez par credit
                                    </a>
                                </div>
                            @else
                              <span>Votre panier est vide</span>
                            @endif
                            </li>
                        </ul>
                    </div>
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="{{asset('back/img/avatar1_small.jpg')}}">
                    <span class="username">
                    @if (session(SESSION_USER_ACCOUNTS) && count(session(SESSION_USER_ACCOUNTS)))
                        {{ Auth::user()->account->getDisplayName() }}
                    @else
                        {{ Auth::user()->getDisplayName() }}
                    @endif

                    </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                    <li><a href="logout"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
            </li>

        </ul>
    </div>
</header>
<!--header end-->