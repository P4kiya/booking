<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="/"><i class="fa-solid fa-home"></i> <span>Accueil</span></a>
                </li>
                <li class="{{ Request::is('clients') || Request::is('add-client') || Request::is('edit-client/*') ? 'active' : '' }}">
                    <a href="/clients"><i class="fa-solid fa-users"></i><span>Clients</span></a>
                </li>
                <li class="{{ Request::is('appartements') || Request::is('add-appartement') || Request::is('edit-appartement/*') ? 'active' : '' }}">
                    <a href="/appartements"><i class="fa-solid fa-house-user"></i><span>Appartements</span></a>
                </li>
                <li class="{{ Request::is('calendar') ? 'active' : '' }}">
                    <a href="/calendar"> <i class="fa-solid fa-calendar-days"></i><span>Planning</span></a>
                </li>
                <li class="{{ Request::is('reservation') || Request::is('add-reservation')|| Request::is('view-reservation/*') || Request::is('edit-reservation/*') ? 'active' : '' }}">
                    <a href="/reservation"> <i class="fa fa-window-restore tooltipped"></i><span>Reservation</span></a>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
