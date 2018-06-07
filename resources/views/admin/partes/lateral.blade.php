
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administración de Sismos</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
          @if( $active == 1)  
            <li class="treeview active">
          @else
            <li class="treeview">  
          @endif
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Administración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Auth::user()->tipo == "ADMIN")
              @if( $active==1 and $subm == 1 and $subm2 == 0)  
                <li class="active">
              @else
                <li>
              @endif
              <a href="/usuarios/lista"><i class="fa fa-circle-o"></i>Usuarios</a></li>
            @endif
            @if( $active==1 and $subm == 2 and $subm2 == 0)  
            <li class="active">
            @else
            <li>
            @endif
            <a href="/perfil"><i class="fa fa-circle-o"></i> Perfil</a></li>
          </ul>
        </li>
        @if(Auth::user()->tipo == "ADMIN")
          @if( $active == 2)  
            <li class="treeview active">
          @else
            <li class="treeview">  
          @endif
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Catálogos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
       @endif 
          <ul class="treeview-menu">
          @if(Auth::user()->tipo == "ADMIN")
            @if( $active == 2 and $subm == 1)  
              <li class="treeview active">
            @else
              <li class="treeview">  
            @endif

              <a href="#"><i class="fa fa-circle-o"></i>Sismos
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </ span>
              </a>
              <ul class="treeview-menu">

                @if( $active==2 and $subm == 1 and $subm2 == 1)  
                <li class="active">
                @else
                <li>  
                @endif
                  <a href="/misismos/index"><i class="fa fa-circle-o"></i>Lista de sismos</a>
                </li>
                @if( $active==2 and $subm == 1 and $subm2 == 2)  
                <li class="active">
                @else
                <li>  
                @endif
                  <a href="/misismos/create"><i class="fa fa-circle-o"></i>Crear nuevo sismo            
                  </a>
                </li>
              </ul>
            </li>
            @endif
            @if(Auth::user()->tipo == "ADMIN")
              @if( $active==2 and $subm == 3 )  
              <li class="treeview active">
              @else
              <li class="treeview">  
              @endif
              <a href="#"><i class="fa fa-circle-o"></i>Estados
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @if( $active==2 and $subm == 3 and $subm2 == 1)  
                <li class="active">
                @else
                <li>  
                @endif
                  <a href="/estados"><i class="fa fa-circle-o"></i>Lista de Estados</a>
                </li>
                @if( $active==2 and $subm == 3 and $subm2 == 2)  
                <li class="active">
                @else
                <li>  
                @endif
                  <a href="/estados/create"><i class="fa fa-circle-o"></i>Crear Estado
                  </a>
                </li>
              </ul>
            </li>
            @endif
            @if(Auth::user()->tipo == "ADMIN")
              @if( $active==2 and $subm == 2)  
                <li class="treeview active">
              @else
                <li class="treeview">  
              @endif
              <a href="#"><i class="fa fa-circle-o"></i>Municipios
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @if( $active==2 and $subm == 2 and $subm2 == 1)  
                <li class="active">
                @else
                <li>  
                @endif
                <a href="/mpos"><i class="fa fa-circle-o"></i>Lista de Municipios</a></li>
                @if( $active==2 and $subm == 2 and$subm2 == 2)  
                <li class="active">
                @else
                <li>  
                @endif
                  <a href="/mpos/create"><i class="fa fa-circle-o"></i>Crear Municipio
                  </a>
                </li>
              </ul>
            </li>      
            @endif     
          </ul>
          
        </li>
        @if(Auth::user()->tipo == "ADMIN")
              @if( $active==3)  
                <li class="treeview active">
              @else
                <li class="treeview">  
              @endif
              <a href="#"><i class=""fa fa-dashboard"></i>Encuestas
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @if( $active==3 and $subm == 1)  
                <li class="active">
                @else
                <li>  
                @endif
                <a href="/encuestas/index"><i class="fa fa-circle-o"></i>Lista de Encuestas</a></li>
              </ul>
            </li>  
        @endif 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/reportes/index"><i class="fa fa-circle-o"></i> Lista de Reportes</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Sismos Registrados</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Usuarios Inactivos</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Datos Encuestas</a></li>
            <li><a href="/reporteA"><i class="fa fa-circle-o"></i> Mapa de distribución</a></li>
            <li><a href="/reporteB"><i class="fa fa-circle-o"></i> Último sismo</a></li>
            <li><a href="/reporteC"><i class="fa fa-circle-o"></i> Estoy bien</li>
            <li><a href="/reporteD"><i class="fa fa-circle-o"></i> Necesito Ayuda</a></li>
            <li><a href="/reporteD""><i class="fa fa-circle-o"></i> No contestarón</a></li>
          </ul>
        </li>

        <li class="header">ACCIONES</li>
        @if(Auth::user()->tipo == "ADMIN")
           <li><a href="/usuarios"><i class="fa fa-circle-o text-blue"></i> <span>Dashboard</span></a></li>
        @endif 
        <li><a href="/logout" onclick=" return confirm('Esta seguro de salir del sistema ?')"><i class="fa fa-circle-o text-red" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i> <span>Salir</span></a></li>
      </ul>
    </section>