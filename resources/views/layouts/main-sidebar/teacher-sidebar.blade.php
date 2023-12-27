<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

        <!-- الاقسام-->
        <li>
            <a href="{{route('section')}}"><i class="fa-regular fa-school"></i><span
                    class="right-nav-text">{{trans('main_trans.sections')}}</span></a>
        </li>

        <!-- الطلاب-->
        <li>
            <a href="{{route('Student.index')}}"><i class="fa fa-user-graduate"></i><span
                    class="right-nav-text">{{trans('main_trans.students')}}</span></a>
        </li>


        <!-- الاختبارات-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fa-solid fa-star" style="color: #ffffff;"></i><span
                        class="right-nav-text">{{trans('main_trans.Exams')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('quizzes.index')}}">{{trans('main_trans.List_Exams')}}</a></li>
                <!-- <li><a href="#">قائمة الاسئله</a></li> -->
            </ul>

        </li>

        <!-- التقارير-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#reports">
                <div class="pull-left"><i class="fa-solid fa-star" style="color: #ffffff;"></i><span
                        class="right-nav-text">{{trans('Teacher_trans.Report')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="reports" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('attendance.report')}}">{{trans('Teacher_trans.Report_Attendance')}}</a></li>
                <!-- <li><a href="#">تقرير الامتحانات</a></li> -->
            </ul>

        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('profile.show')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('Teacher_trans.Profile')}}</span></a>
        </li>

    </ul>
</div>