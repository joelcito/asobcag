<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
        <!--begin::Scroll wrapper-->
        <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        {{-- <span class="menu-heading fw-bold text-uppercase fs-7">MENUS</span> --}}
                        <span class="fs-7 text-white fw-boldn">MENUS</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                @php
                    $llama = request()->route('tipo') == 'LLAMA' ? true : false;
                    $alpaca = request()->route('tipo') == 'ALPACA' ? true : false;
                @endphp

                {{-- INGRESOS --}}
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('criadero/*', 'ejemplar/*', 'empadre/*', 'diagnostico/*', 'medicacion/*', 'feriaEjemplar/*') && $llama ? 'show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa fa-industry"></i>
                        </span>
                        <span class="menu-title text-white">Llamas</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'criadero.listado' ? 'active' : '' }}" href="{{route('criadero.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Criaderos</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'ejemplar.listado' && $llama ? 'active' : '' }}" href="{{ route('ejemplar.listado', ['LLAMA']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Ejemplares</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'empadre.listado' && $llama ? 'active' : '' }}" href="{{ route('empadre.listado', ['LLAMA']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Empadres</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'diagnostico.listado' && $llama ? 'active' : '' }}" href="{{ route('diagnostico.listado', ['LLAMA']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Diagnosticos</span>
                            </a>
                        </div>
                        {{-- <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'medicacion.listado' && $llama ? 'active' : '' }}" href="{{ route('medicacion.listado', ['LLAMA']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Medicaciones</span>
                            </a>
                        </div> --}}
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'feriaEjemplar.listado' && $llama ? 'active' : '' }}" href="{{route('feriaEjemplar.listado', ['LLAMA'])}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Feria Ejemplares</span>
                            </a>
                        </div>
                    </div>
                    <!--end:Menu sub-->
                </div>
                {{-- FIN INGRESOS --}}

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('ejemplar/*', 'empadre/*', 'diagnostico/*', 'medicacion/*', 'feriaEjemplar/*') && $alpaca ? 'show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa fa-industry"></i>
                        </span>
                        <span class="menu-title text-white">Alpacas</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'ejemplar.listado' && $alpaca ? 'active' : '' }}" href="{{ route('ejemplar.listado', ['ALPACA']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Ejemplares</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'empadre.listado' && $alpaca ? 'active' : '' }}" href="{{ route('empadre.listado', ['ALPACA']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Empadres</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'diagnostico.listado' && $alpaca ? 'active' : '' }}" href="{{ route('diagnostico.listado', ['ALPACA']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Diagnosticos</span>
                            </a>
                        </div>
                        {{-- <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'medicacion.listado' && $alpaca ? 'active' : '' }}" href="{{ route('medicacion.listado', ['ALPACA']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Medicaciones</span>
                            </a>
                        </div> --}}
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'feriaEjemplar.listado' && $alpaca ? 'active' : '' }}" href="{{route('feriaEjemplar.listado', ['ALPACA'])}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Feria Ejemplares</span>
                            </a>
                        </div>
                    </div>
                    <!--end:Menu sub-->
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('usuario/*', 'localidad/*', 'rol/*', 'raza/*', 'color/*', 'fenotipo/*', 'categoria/*', 'categoriaFeria/*', 'feria/*', 'premio/*', 'productoVeterinario/*', 'metodo/*', 'campania/*', 'tipoEmpadre/*') ? 'show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa fa-university"></i>
                        </span>
                        <span class="menu-title text-white">Administracion</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ Route::currentRouteName() == 'usuario.listado' ? 'active' : '' }}" href="{{route('usuario.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Usuarios</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    </div>
                    <!--end:Menu sub-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{url('localidad/listadoPais')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Localidad</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    </div>
                    <!--end:Menu sub-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ Route::currentRouteName() == 'rol.listado' ? 'active' : '' }}" href="{{route('rol.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Roles</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                    </div>
                    <!--end:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'raza.listado' ? 'active' : '' }}" href="{{route('raza.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Razas</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'color.listado' ? 'active' : '' }}" href="{{route('color.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Colores</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'fenotipo.listado' ? 'active' : '' }}" href="{{route('fenotipo.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Fenotipos</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'categoria.listado' ? 'active' : '' }}" href="{{route('categoria.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Categorias</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'categoriaFeria.listado' ? 'active' : '' }}" href="{{route('categoriaFeria.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Categorias Ferias</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'feria.listado' ? 'active' : '' }}" href="{{route('feria.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Ferias</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'premio.listado' ? 'active' : '' }}" href="{{route('premio.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Premios</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'productoVeterinario.listado' ? 'active' : '' }}" href="{{route('productoVeterinario.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Productos Veterinarios</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'metodo.listado' ? 'active' : '' }}" href="{{route('metodo.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Metodos</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'campania.listado' ? 'active' : '' }}" href="{{route('campania.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Campañas</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ Route::currentRouteName() == 'tipoEmpadre.listado' ? 'active' : '' }}" href="{{route('tipoEmpadre.listado')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title text-white">Tipos Empadre</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Scroll wrapper-->
    </div>
    <!--end::Menu wrapper-->
</div>
