<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('parents') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>


        <!-- الابناء-->
        <li>
            <a href="{{route('sons.index')}}"><i class="fa fa-book-open"></i><span
                    class="right-nav-text">{{trans('Parent_trans.Sons')}}</span></a>
        </li>

        <!-- تقرير الحضور والغياب-->
        <li>
            <a href="{{route('sons.attendance')}}"><i class="fa fa-book-open"></i><span
                    class="right-nav-text">{{trans('Teacher_trans.Report_Attendance')}}</span></a>
        </li>

        <!-- تقرير المالية-->
        <li>
            <a href="{{route('sons.invoices')}}"><i class="fa fa-book-open"></i><span
                    class="right-nav-text">{{trans('Parent_trans.Report_Fees')}}</span></a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{route('parents.profile')}}"><i class="fa fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('Teacher_trans.Profile')}}</span></a>
        </li>

    </ul>
</div>