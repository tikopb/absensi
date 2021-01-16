      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/home" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/karyawan" class="nav-link">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                    Data Karyawan
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/shiftHour" class="nav-link">
                  <i class="nav-icon fas fa-hourglass"></i>
                  <p>
                    Jam Kerja
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="/shifts" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Shift
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/absensi" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Absen
              </p>
            </a>
          </li>

          <li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                REPORT
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/karyawan" class="nav-link">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                    Absensi Per Period
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/shiftHour" class="nav-link">
                  <i class="nav-icon fas fa-hourglass"></i>
                  <p>
                    Absensi Per Karyawan
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Log Out
              </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          </li>
		  
        </ul>
      </nav>