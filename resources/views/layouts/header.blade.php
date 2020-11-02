<nav class="navbar header-navbar pcoded-header">
        <div class="progress progress-xs" style="display:none;width:100vw;position:fixed;z-index:1000;border-radius:0px;">
            <div id="progressBar" class="progress-bar-emrald" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div>
        </div>
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu"></i>
            </a>
            <a href="index-1.htm">
                <img class="img-fluid" src="{{ asset('assets\images\logo.png') }}" alt="Theme-Logo" width="50" height="50">{{ env('APP_NAME','HRIS') }}
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">

                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-bell"></i>
                            @if(isset($Notification))
                            <span class="badge bg-c-pink notifikasi">{{ App\Models\Notification::where(['read_at' => Null])->count() }}</span>
                            @endif
                        </div>
                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li class="show-notifikasi">
                                <h6 class="judul_notif"></h6>
                                <label style="display:none;" class="label label-danger label_new">New</label>
                                @if(isset($Notification))
                                @foreach ($Notification as $notif)
                                <a href="{{ $notif->link }}" style="background-color: inherit">
                                    <li id="countnotif">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="{{ asset('\assets\images\avatar-4.jpg') }}" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">{{ $notif->nama }}</h5>
                                                <p class="notification-msg">{{ $notif->message }}</p>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                                @endforeach
                                @endif
                            </li>
                            <div class="footer-show-notifikasi" style="display:none;">
                                <p class="notification-msg"><a class="lihat-pemberitahuan" href="#!" style="background-color: inherit;text-decoration:underline;">Lihat Semua Pemberitahuan</a></p>
                            </div>
                        </ul>
                    </div>
                </li>
                {{-- <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-message-square"></i>
                            <span class="badge bg-c-green">3</span>
                        </div>
                    </div>
                </li> --}}
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('assets\images\avatar-4.jpg') }}" class="img-radius" alt="User-Profile-Image">
                            <span>{{ auth()->user()?auth()->user()->name:'' }}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            {{-- <li>
                                <a href="#!">
                                    <i class="feather icon-settings"></i> Settings
                                </a>
                            </li> --}}
                            <li>
                                <a href="/profile">
                                    <i class="feather icon-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="/inbox">
                                    <i class="feather icon-mail"></i> Inbox
                                </a>
                            </li>
                            {{-- <li>
                                <a href="auth-lock-screen.htm">
                                    <i class="feather icon-lock"></i> Lock Screen
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{URL::to('/logout')}}">
                                    <i class="feather icon-log-out"></i> Logout
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="sidebar" class="users p-chat-user showChat">
    <div class="had-container">
        <div class="card card_main p-fixed users-main">
            <div class="user-box">
                <div class="chat-inner-header">
                    <div class="back_chatBox">
                        <div class="right-icon-control">
                            <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                            <div class="form-icon">
                                <i class="icofont icofont-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-friend-list">
                    <div class="media userlist-box" data-id="1" data-status="online" data-username="Kang Bayu" data-toggle="tooltip" data-placement="left" title="Kang Bayu">
                        <a class="media-left" href="#!">
                            <img class="media-object img-radius img-radius" src="{{ asset('assets\images\avatar-3.jpg')}}" alt="Generic placeholder image ">
                            <div class="live-status bg-success"></div>
                        </a>
                        <div class="media-body">
                            <div class="f-13 chat-header">Kang Bayu</div>
                        </div>
                    </div>
                    <div class="media userlist-box" data-id="2" data-status="online" data-username="Kang Teddy" data-toggle="tooltip" data-placement="left" title="Kang Teddy">
                        <a class="media-left" href="#!">
                            <img class="media-object img-radius" src="{{ asset('assets\images\avatar-2.jpg')}}" alt="Generic placeholder image">
                            <div class="live-status bg-success"></div>
                        </a>
                        <div class="media-body">
                            <div class="f-13 chat-header">Kang Teddy</div>
                        </div>
                    </div>
                    <div class="media userlist-box" data-id="3" data-status="online" data-username="Kang Rahmat" data-toggle="tooltip" data-placement="left" title="Kang Rahmat">
                        <a class="media-left" href="#!">
                            <img class="media-object img-radius" src="{{ asset('assets\images\avatar-4.jpg')}}" alt="Generic placeholder image">
                            <div class="live-status bg-success"></div>
                        </a>
                        <div class="media-body">
                            <div class="f-13 chat-header">Kang Rahmat</div>
                        </div>
                    </div>
                    <div class="media userlist-box" data-id="4" data-status="online" data-username="Kang Dani" data-toggle="tooltip" data-placement="left" title="Kang Dani">
                        <a class="media-left" href="#!">
                            <img class="media-object img-radius" src="{{ asset('assets\images\avatar-3.jpg')}}" alt="Generic placeholder image">
                            <div class="live-status bg-success"></div>
                        </a>
                        <div class="media-body">
                            <div class="f-13 chat-header">Kang Dani</div>
                        </div>
                    </div>
                    <div class="media userlist-box" data-id="5" data-status="online" data-username="Kang Cecep" data-toggle="tooltip" data-placement="left" title="Kang Cecep">
                        <a class="media-left" href="#!">
                            <img class="media-object img-radius" src="{{ asset('assets\images\avatar-2.jpg')}}" alt="Generic placeholder image">
                            <div class="live-status bg-success"></div>
                        </a>
                        <div class="media-body">
                            <div class="f-13 chat-header">Kang Cecep</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sidebar inner chat start-->
<div class="showChat_inner">
    <div class="media chat-inner-header">
        <a class="back_chatBox">
            <i class="feather icon-chevron-left"></i> Kang Bayu
        </a>
    </div>
    <div class="media chat-messages">
        <a class="media-left photo-table" href="#!">
            <img class="media-object img-radius img-radius m-t-5" src="{{ asset('assets\images\avatar-3.jpg')}}" alt="Generic placeholder image">
        </a>
        <div class="media-body chat-menu-content">
            <div class="">
                <p class="chat-cont">Produk yang tersedia adalah produk yang berkualitas</p>
                <p class="chat-time">8:20 WIB</p>
            </div>
        </div>
    </div>
    <div class="media chat-messages">
        <div class="media-body chat-menu-reply">
            <div class="">
                <p class="chat-cont">Produk yang tersedia adalah produk yang berkualitas</p>
                <p class="chat-time">8:20 WIB</p>
            </div>
        </div>
        <div class="media-right photo-table">
            <a href="#!">
                <img class="media-object img-radius img-radius m-t-5" src="{{ asset('assets\images\avatar-4.jpg')}}" alt="Generic placeholder image">
            </a>
        </div>
    </div>
    <div class="chat-reply-box p-b-20">
        <div class="right-icon-control">
            <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
            <div class="form-icon">
                <i class="feather icon-navigation"></i>
            </div>
        </div>
    </div>
</div>
