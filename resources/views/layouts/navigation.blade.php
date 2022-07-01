
    <!-- Primary Navigation Menu -->
    <nav   class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">Sama Clinique</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
              <ul class="site-menu js-clone-nav d-none d-lg-block  ms-auto me-0 me-md-3 my-2 my-md-0">
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" >
                       
                        <li><a class="dropdown-item" href="{{ url('/') }}" >Accueil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        
                        <li>
                            <a class="dropdown-item" href="{{ url('logout') }}" 
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Log Out') }}
                            </a>
                            
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">@csrf</form>
                            
                        </li>
                        
                    </ul>

                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="{{ url('/') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Accueil
                            </a>
                            @if(Auth::user()->hasRole('ADMIN'))
                            <a class="nav-link" href="{{ url('/user/list') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                                Gestion Utilisateur
                            </a>
                            @endif

                            @if(Auth::user()->hasRole('MEDECIN'))
                            <a class="nav-link" href="{{ url('/medecin/patient') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-heartbeat fa-fw"></i></div>
                                Gestion Patients
                            </a>
                            @endif

                            @if(Auth::user()->hasRole('SECRETAIRE'))
                            <a class="nav-link" href="{{ url('/patient/list') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-heartbeat fa-fw"></i></div>
                                Gestion Patients
                            </a>
                            @endif
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{Auth::user()->prenom}} {{Auth::user()->nom}}
                    </div>
                </nav>
            </div>
