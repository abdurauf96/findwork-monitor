


<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Side-menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled " id="side-menu">
                <li class="mm-{{ Request::is('tables*')? "active":"" }}">
                    <a href="{{route('tableIndex')}}" class="waves-effect">
                        <i class="fas fa-database"></i>
                        <span>Tables</span>
                    </a>
                </li>
                <li class="mm-{{ Request::is('failed-jobs*')? "active":"" }}">
                    <a href="{{route('failed-jobs.index')}}" class="waves-effect">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Failed jobs</span>
                    </a>
                </li>
                <li class="mm-{{ Request::is('jobs*')? "active":"" }}">
                    <a href="{{route('failed-jobs.index')}}" class="waves-effect">
                        <i class="fas fa-code-branch"></i>
                        <span>Migrations</span>
                    </a>
                </li>
                <li class="mm-{{ Request::is('jobs*')? "active":"" }}">
                    <a href="{{route('failed-jobs.index')}}" class="waves-effect">
                            <i class="fas fa-database"></i>
                            <span>Backups</span>
                    </a>
                </li>
                <li class="mm-{{ Request::is('jobs*')? "active":"" }}">
                    <a href="{{route('failed-jobs.index')}}" class="waves-effect">
                            <i class="fas fa-terminal"></i>
                            <span>Query Builder</span>
                    </a>
                </li>
                <li class="mm-{{ Request::is('jobs*')? "active":"" }}">
                    <a href="{{route('failed-jobs.index')}}" class="waves-effect">
                            <i class="fas fa-seedling"></i>
                            <span>Seeders</span>
                    </a>
                </li>
                <li class="mm-{{ Request::is('jobs*')? "active":"" }}">
                    <a href="{{route('failed-jobs.index')}}" class="waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="mm-{{ Request::is('jobs*')? "active":"" }}">
                    <a href="{{route('failed-jobs.index')}}" class="waves-effect">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Logs</span>
                    </a>
                </li>
                <li class="mm-{{ Request::is('jobs*')? "active":"" }}">
                    <a href="{{route('failed-jobs.index')}}" class="waves-effect">
                        <i class="fas fa-cogs"></i>
                        <span>Settings</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>


