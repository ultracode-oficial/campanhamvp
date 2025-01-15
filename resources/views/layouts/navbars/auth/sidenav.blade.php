<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center mb-0" href="{{ route('home') }}">
            <img src="{{ asset('img/uc-logo256.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold  " style="color: #bfa15f;">Campanha</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (Auth::user()->nivel == 'Super-Admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                        href="{{ route('home') }}">
                        <div
                            class="me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M9.6 22.4V15.2H14.4V22.4H20.4V12.8H24L12 2L0 12.8H3.6V22.4H9.6Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'grupo.index' ? 'active' : '' }}"
                        href="{{ route('grupo.index') }}">
                        <div
                            class="me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M5 0C4.79 0 4.61 0.03 4.43 0.09C3.26 0.33 2.33 1.26 2.09 2.43C2 2.61 2 2.79 2 3V19.5C2 21.99 4.01 24 6.5 24H23V21H6.5C5.66 21 5 20.34 5 19.5C5 18.66 5.66 18 6.5 18H23V1.5C23 0.66 22.34 0 21.5 0H20V9L17 6L14 9V0H5Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Grupo</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'lideres.index' ? 'active' : '' }}"
                        href="{{ route('lideres.index') }}">
                        <div
                            class="me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M22.1321 22.3396V18.566C22.1321 17.5094 21.9811 16.4528 21.3774 15.3962C20.7736 14.3396 20.0189 13.434 18.9623 12.8302C17.9057 12.0755 15.6415 11.9245 14.5849 11.9245L12.1698 14.4906L13.0755 16.4528V20.9811L11.566 22.6415L10.0566 20.9811V16.4528L11.1132 14.4906L8.54717 11.9245C7.33962 11.9245 5.07547 12.0755 4.01887 12.8302C2.96226 13.434 2.35849 14.3396 1.75472 15.3962C1.15094 16.4528 1 17.3585 1 18.566V22.3396C1 22.3396 4.92453 24 11.566 24C18.2075 24 22.1321 22.3396 22.1321 22.3396ZM11.566 0C8.69811 0 7.03774 2.71698 7.49057 5.73585C7.9434 8.75472 9.45283 10.8679 11.566 10.8679C13.6792 10.8679 15.1887 8.75472 15.6415 5.73585C16.0943 2.56604 14.434 0 11.566 0Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Lideranças</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'agenda.index' ? 'active' : '' }}"
                        href="{{ route('agenda.index') }}">
                        <div
                            class="me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_5_140)">
                                <path d="M6.85939 0.923077C6.85939 0.678262 6.76381 0.443474 6.59369 0.270363C6.42356 0.0972525 6.19282 0 5.95222 0C5.71163 0 5.48089 0.0972525 5.31076 0.270363C5.14063 0.443474 5.04506 0.678262 5.04506 0.923077V2.86769C3.3033 3.00923 2.16148 3.35631 1.32204 4.21169C0.481403 5.06585 0.140308 6.22892 0 8H24C23.8597 6.22769 23.5186 5.06585 22.678 4.21169C21.8385 3.35631 20.6955 3.00923 18.9549 2.86646V0.923077C18.9549 0.678262 18.8594 0.443474 18.6892 0.270363C18.5191 0.0972525 18.2884 0 18.0478 0C17.8072 0 17.5764 0.0972525 17.4063 0.270363C17.2362 0.443474 17.1406 0.678262 17.1406 0.923077V2.78523C16.3363 2.76923 15.4339 2.76923 14.4191 2.76923H9.58089C8.56607 2.76923 7.66374 2.76923 6.85939 2.78523V0.923077Z" fill="currentColor"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 12.5714C0 11.6126 1.39698e-08 10.76 0.0156 10H23.9844C24 10.76 24 11.6126 24 12.5714V14.8571C24 19.1669 24 21.3223 22.5936 22.6606C21.1884 24 18.9252 24 14.4 24H9.6C5.0748 24 2.8116 24 1.4064 22.6606C-1.19209e-07 21.3223 0 19.1669 0 14.8571V12.5714ZM18 14.8571C18.3183 14.8571 18.6235 14.7367 18.8485 14.5224C19.0736 14.3081 19.2 14.0174 19.2 13.7143C19.2 13.4112 19.0736 13.1205 18.8485 12.9062C18.6235 12.6918 18.3183 12.5714 18 12.5714C17.6817 12.5714 17.3765 12.6918 17.1515 12.9062C16.9264 13.1205 16.8 13.4112 16.8 13.7143C16.8 14.0174 16.9264 14.3081 17.1515 14.5224C17.3765 14.7367 17.6817 14.8571 18 14.8571ZM18 19.4286C18.3183 19.4286 18.6235 19.3082 18.8485 19.0938C19.0736 18.8795 19.2 18.5888 19.2 18.2857C19.2 17.9826 19.0736 17.6919 18.8485 17.4776C18.6235 17.2633 18.3183 17.1429 18 17.1429C17.6817 17.1429 17.3765 17.2633 17.1515 17.4776C16.9264 17.6919 16.8 17.9826 16.8 18.2857C16.8 18.5888 16.9264 18.8795 17.1515 19.0938C17.3765 19.3082 17.6817 19.4286 18 19.4286ZM13.2 13.7143C13.2 14.0174 13.0736 14.3081 12.8485 14.5224C12.6235 14.7367 12.3183 14.8571 12 14.8571C11.6817 14.8571 11.3765 14.7367 11.1515 14.5224C10.9264 14.3081 10.8 14.0174 10.8 13.7143C10.8 13.4112 10.9264 13.1205 11.1515 12.9062C11.3765 12.6918 11.6817 12.5714 12 12.5714C12.3183 12.5714 12.6235 12.6918 12.8485 12.9062C13.0736 13.1205 13.2 13.4112 13.2 13.7143ZM13.2 18.2857C13.2 18.5888 13.0736 18.8795 12.8485 19.0938C12.6235 19.3082 12.3183 19.4286 12 19.4286C11.6817 19.4286 11.3765 19.3082 11.1515 19.0938C10.9264 18.8795 10.8 18.5888 10.8 18.2857C10.8 17.9826 10.9264 17.6919 11.1515 17.4776C11.3765 17.2633 11.6817 17.1429 12 17.1429C12.3183 17.1429 12.6235 17.2633 12.8485 17.4776C13.0736 17.6919 13.2 17.9826 13.2 18.2857ZM6 14.8571C6.31826 14.8571 6.62348 14.7367 6.84853 14.5224C7.07357 14.3081 7.2 14.0174 7.2 13.7143C7.2 13.4112 7.07357 13.1205 6.84853 12.9062C6.62348 12.6918 6.31826 12.5714 6 12.5714C5.68174 12.5714 5.37652 12.6918 5.15147 12.9062C4.92643 13.1205 4.8 13.4112 4.8 13.7143C4.8 14.0174 4.92643 14.3081 5.15147 14.5224C5.37652 14.7367 5.68174 14.8571 6 14.8571ZM6 19.4286C6.31826 19.4286 6.62348 19.3082 6.84853 19.0938C7.07357 18.8795 7.2 18.5888 7.2 18.2857C7.2 17.9826 7.07357 17.6919 6.84853 17.4776C6.62348 17.2633 6.31826 17.1429 6 17.1429C5.68174 17.1429 5.37652 17.2633 5.15147 17.4776C4.92643 17.6919 4.8 17.9826 4.8 18.2857C4.8 18.5888 4.92643 18.8795 5.15147 19.0938C5.37652 19.3082 5.68174 19.4286 6 19.4286Z" fill="currentColor"/>
                              </g>
                              <defs>
                                <clipPath id="clip0_5_140">
                                  <rect width="24" height="24" fill="white"/>
                                </clipPath>
                              </defs>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Agenda</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}"
                        href="{{ route('dashboard.index') }}">
                        <div
                            class="me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_5_120)">
                                <path d="M13.3333 8V0H24V8H13.3333ZM0 13.3333V0H10.6667V13.3333H0ZM13.3333 24V10.6667H24V24H13.3333ZM0 24V16H10.6667V24H0Z" fill="currentColor"/>
                              </g>
                              <defs>
                                <clipPath id="clip0_5_120">
                                  <rect width="24" height="24" fill="white"/>
                                </clipPath>
                              </defs>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboards</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'relatorio.index' ? 'active' : '' }}"
                        href="{{ route('relatorio.index') }}">
                        <div
                            class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
                              </svg>
                        </div>
                        <span class="nav-link-text ms-1">Relatorios</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}"
                        href="{{ route('user.index') }}">
                        <div
                            class="me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_5_136)">
                                <path d="M3.42857 5.71429C3.42857 4.46398 3.92525 3.26488 4.80935 2.38078C5.69345 1.49668 6.89255 1 8.14286 1C9.39316 1 10.5923 1.49668 11.4764 2.38078C12.3605 3.26488 12.8571 4.46398 12.8571 5.71429C12.8571 6.96459 12.3605 8.16369 11.4764 9.04779C10.5923 9.93189 9.39316 10.4286 8.14286 10.4286C6.89255 10.4286 5.69345 9.93189 4.80935 9.04779C3.92525 8.16369 3.42857 6.96459 3.42857 5.71429ZM14.5714 8.28571C14.5714 7.77919 14.6712 7.27762 14.865 6.80965C15.0589 6.34168 15.343 5.91647 15.7012 5.5583C16.0593 5.20013 16.4845 4.91602 16.9525 4.72218C17.4205 4.52834 17.922 4.42857 18.4286 4.42857C18.9351 4.42857 19.4367 4.52834 19.9046 4.72218C20.3726 4.91602 20.7978 5.20013 21.156 5.5583C21.5142 5.91647 21.7983 6.34168 21.9921 6.80965C22.1859 7.27762 22.2857 7.77919 22.2857 8.28571C22.2857 9.30869 21.8793 10.2898 21.156 11.0131C20.4326 11.7365 19.4515 12.1429 18.4286 12.1429C17.4056 12.1429 16.4245 11.7365 15.7012 11.0131C14.9778 10.2898 14.5714 9.30869 14.5714 8.28571ZM0 20.2857C3.21808e-08 18.1261 0.857906 16.0549 2.38499 14.5278C3.91207 13.0008 5.98324 12.1429 8.14286 12.1429C10.3025 12.1429 12.3736 13.0008 13.9007 14.5278C15.4278 16.0549 16.2857 18.1261 16.2857 20.2857V20.2891L16.2846 20.4251C16.2821 20.5705 16.2428 20.7128 16.1702 20.8388C16.0977 20.9647 15.9942 21.0702 15.8697 21.1451C13.5373 22.5495 10.8654 23.2897 8.14286 23.2857C5.31771 23.2857 2.67314 22.504 0.417143 21.1451C0.292401 21.0703 0.188762 20.9649 0.115985 20.839C0.0432071 20.713 0.0036861 20.5706 0.00114291 20.4251L0 20.2857ZM18 20.2891L17.9989 20.4537C17.9925 20.8346 17.9015 21.2094 17.7326 21.5509C17.9627 21.5646 18.1947 21.5714 18.4286 21.5714C20.2526 21.5714 21.9794 21.1486 23.5154 20.3954C23.6541 20.3277 23.7719 20.2237 23.8563 20.0946C23.9408 19.9654 23.9889 19.8159 23.9954 19.6617L24 19.4286C24.0002 18.4889 23.7627 17.5645 23.3096 16.7413C22.8566 15.9181 22.2027 15.2229 21.4088 14.7203C20.6149 14.2176 19.7068 13.924 18.7689 13.8666C17.831 13.8092 16.8938 13.9899 16.0446 14.392C17.3158 16.0938 18.0014 18.1616 17.9989 20.2857L18 20.2891Z" fill="currentColor"/>
                              </g>
                              <defs>
                                <clipPath id="clip0_5_136">
                                  <rect width="24" height="24" fill="white"/>
                                </clipPath>
                              </defs>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Usuários</span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->nivel == 'User')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'grupo.index' ? 'active' : '' }}"
                        href="{{ route('grupo.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-fw fa-home text-dark text-sm opacity-10" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Grupo</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() == 'inscricao.index' ? 'active' : '' }}" href="{{ route('inscricao.index') }}">
                                <div
                                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Inscrições</span>
                            </a>
                        </li>     --}}
            @endif

            @if(Auth::user()->nivel == 'Coordenador')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'coordenador.grupo.index' ? 'active' : '' }}"
                        href="{{ route('coordenador.grupo.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-fw fa-home text-dark text-sm opacity-10" aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1">Grupo</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>