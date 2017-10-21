<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <li>
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" @if(Request::is('profile') || Request::is('profile/*') || Request::is('achats') || Request::is('achats-prospect')) class="active" @endif>
                    <i class="fa fa-user"></i>
                    <span>Mon compte</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{route('profile')}}">Mes informations</a></li>
                    <li><a  href="{{route('Prospect.achats')}}">Mes achats</a></li>

                </ul>
            </li>


            <li class="sub-menu">
                <a href="javascript:;" @if(Request::is('prospects') || Request::is('prospects/*')) class="active" @endif>
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Salle des marchés</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{route('prospects')}}">Prospects potentiels</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;"  @if(Request::is('commandes') || Request::is('commandes/*') || Request::is('mes-commandes') || Request::is('mes-commandes/*') ) class="active" @endif>
                    <i class="fa fa-envelope"></i>
                    <span>Commandes</span> 
                </a>
                <ul class="sub">
                 <li><a  href="{{route('Commandes.index')}}">Commander</a></li>
                    <li><a  href="{{route('Commande.commande')}}">Mes commandes</a></li>
                </ul>
            </li>
              

            <li class="sub-menu">
                <a href="javascript:;"  @if(Request::is('messages') || Request::is('messages/*')) class="active" @endif>
                    <i class="fa fa-envelope"></i>
                    <span>Messagerie</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{route('messages')}}">Boîte de réception</a></li>
                    <li><a  href="{{route('messagerie.inbox')}}">Message envoyé</a></li>

                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" @if(Request::is('credit-achats') || Request::is('credit-payment/*') || Request::is('payment-credit/*') || Request::is('achats-credit')) class="active" @endif>
                    <i class="fa fa-credit-card"></i>
                    <span>Credits</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{route('Credit.achatsCredit')}}">Acheter de credits</a></li>
                    <li><a  href="{{route('Credits.achats')}}">Mes achats de credits</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('tarifs')}}">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Tarifs</span>
                </a>
            </li>

            <li>
                <a href="{{route('faqs')}}">
                    <i class="fa fa-book"></i>
                    <span>FAQs</span>
                </a>
            </li>

        </ul>
    </div>
</aside>

<!-- sidebar menu end-->
