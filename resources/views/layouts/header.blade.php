<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        @php
            $words = explode(' ', $setting->nama_perusahaan);
            $word  = '';
            foreach ($words as $w) {
                $word .= $w[0];
            }
        @endphp
        <span class="logo-mini">{{ $word }}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ $setting->nama_perusahaan }}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                      <i class="fa fa-bell-o"></i>
                      @php
                      $jum=DB::select('select count(id_produk) as jum from produk where stok<=stok_minimal');
                      
                   @endphp
                    @foreach($jum as $j)
                      <span class="label label-danger">{{$j->jum}}</span>
                      
                    </a>
                    <ul class="dropdown-menu">
                      <li class="header">Ada {{$j->jum}} Notifikasi</li>
                      @endforeach 
                      <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            @php
                                $notif=DB::select('select stok,stok_minimal,nama_produk from produk where stok<=stok_minimal');
                                
                             @endphp
                             
                             @foreach($notif as $n)
                            @php
                                 if ($n->stok < $n->stok_minimal) {
                                //$pesan = $n->nama_produk." Perlu tambah stok";
                             }
                            @endphp
                          <li>
                            <a href="/produk">
                              <i class="fa fa-users text-aqua"></i> {{$n->nama_produk}} Perlu tambah stok ({{$n->stok}})
                            </a>
                          </li>
                          @endforeach
                       
                        </ul>
                      </li>
                      <li class="footer"><a href="#">View all</a></li>
                    </ul>
                  </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ url(auth()->user()->foto ?? '') }}" class="user-image img-profil"
                            alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ url(auth()->user()->foto ?? '') }}" class="img-circle img-profil"
                                alt="User Image">

                            <p>
                                {{ auth()->user()->name }} - {{ auth()->user()->email }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('user.profil') }}" class="btn btn-default btn-flat">Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat"
                                    onclick="$('#logout-form').submit()">Keluar</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
    @csrf
</form>