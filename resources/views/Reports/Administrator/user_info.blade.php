<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>المستخدمين | حساب المستخدم رقم {{ isset($user->id) !=null ?$user->id : ''}}</title>
    <style>
        body {
            direction: rtl;



        }

        .container {
            position: relative;
            width: 21cm;
            height: 29.7cm;

        }

        .header-td1 div {
            float: right;
            margin: 5px;
            width: 32%;
            line-height: 150%;
            text-align: center;
        }

        .clear {
            clear: both;
        }

        .header-td2 {
            border-bottom: 1px solid black;
            text-align: center;
        }

        .footer {
            position: absolute;
            bottom: 0;
            font-size: xx-small;
            width: 100%;
            border-top: 1px solid black;
        }
    </style>

</head>

<body>
    <div class="container">


        <div class="header">
            <div class="header-td1">
                <div>
                    <p>جامعة العلوم والتكنولوجيا
                        <br> كلية الحاسوب وتكنولوجيا المعلومات
                    </p>
                </div>
                <div class="logo">
                    <!-- <img title="GPC" class="rounded img-responsive" src="{{ asset('/img/NewLoge.JPG') }}" alt=" #" /> -->
                    <br>
                    <b>نظام ادارة مشاريع التخرج</b>
                </div>
                <div>
                    <p>التاريخ : {{date_only()}}</p>

                    <p>الرقم :</p>
                </div>
                <p class="clear"></p>
            </div>
            <div class="header-td2">
                <h3>بيانات حساب المستخدم | {{ isset($user->Name) !=null ?$user->Name : ''}}</h3>
            </div>
        </div>



        <div class="card-body">
            <div class="col-sm-3">
                <div class="card text-center border-left-0 border border-danger">
                    <p><span class="badge badge-pill badge-info">تاريخ الانشاء |{{ isset($user->created_at) !=null ? $user->created_at : '' }}</span></p>
                    <p><span class="badge badge-pill badge-success">أخر تحديث |{{ isset($user->updated_at) !=null ? $user->updated_at : '' }}</span></p>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td><strong>الاسم : </strong>{{ isset($user->Name) !=null ?  $user->Name : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>اسم الاستخدام : </strong> {{ isset($user->username) !=null ?  $user->username : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            </tr>
                            <tr>
                                <td><strong>المجموعة : </strong>{{ isset($user->UserRoles->UserRoleAr) !=null ? $user->UserRoles->UserRoleAr : 'لايوجد بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <td><strong>رقم الهاتف : </strong>{{ isset($user->PhoneNumber) !=null ? $user->PhoneNumber : 'لاتوجد بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <td><strong>الايميل : </strong>{{ isset($user->Email) !=null ? $user->Email : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                            </tr>
                            <tr>
                                <td> حالة الحساب : {{ $user->IsActive ==1 ? 'مفعل' : 'غير مفعل' }} <a href=""><i class="fa fa-question-circle"></i></a> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if($user->Roles == 3)
            <hr>
            <div class="col-sm-4">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr class="thead-dark">
                                <th>البيانات الاكاديمية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($user->ProjectStudent == null)
                            <tr>
                                <th class=" text-danger">لاتوجد بيانات للطالب</th>
                            </tr>
                            @endif
                            @if($user->ProjectStudent != null)
                            <tr>
                                <th>الرقم الإكاديمي</th>
                                <td>{{ isset($user->ProjectStudent->AcdameicNumber) !=null ?  $user->ProjectStudent->AcdameicNumber : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            </tr>
                            <tr>
                                <th>المركز الدراسي</th>
                                <td>{{ isset($user->ProjectStudent->branches->BrancheNameAR) !=null ?  $user->ProjectStudent->branches->BrancheNameAR : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            </tr>
                            <tr>
                                <th>التخصص</th>
                                <td>{{ isset($user->ProjectStudent->programs->ProgramName) !=null ?  $user->ProjectStudent->programs->ProgramName : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            </tr>
                            <tr>
                                <th>القسم العلمي</th>
                                <td>{{ isset($user->ProjectStudent->programs->scientific_departments->DepartmentName) !=null ?  $user->ProjectStudent->programs->scientific_departments->DepartmentName : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            </tr>
                            <tr>
                                <th>عدد ساعاته المعتمدة</th>
                                <td>{{ isset($user->ProjectStudent->HoursCompleted) !=null ? $user->ProjectStudent->HoursCompleted : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>قيامه بالتدريب الميداني</th>
                                <td>{{ isset($user->ProjectStudent->Complete_FeldTraining) !=null ? $user->ProjectStudent->Complete_FeldTraining : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th>تاريخ أضافة البيانات الاكاديمية الى النظام</th>
                                <td>{{ isset($user->ProjectStudent->created_at) !=null ? $user->ProjectStudent->created_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>أخر تحديث للبيانات الاكاديمية</th>
                                <td>{{ isset($user->ProjectStudent->updated_at) !=null ? $user->ProjectStudent->updated_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($user->Roles == 4)
            <hr>
            <div class="col-sm-4">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr class="thead-dark">
                                <th  >البيانات الاكاديمية</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($user->ProjectSupervisor == null)
                            <tr>
                                <th>لاتوجد بيانات لاعضو هيئة التدريس</th>
                            </tr>
                            @endif
                            @if($user->ProjectSupervisor != null)
                            <tr>
                                <th>الرقم الوظيفي</th>
                                <td>{{ isset($user->ProjectSupervisor->FunctionalNumber) !=null ?  $user->ProjectSupervisor->FunctionalNumber : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            </tr>
                            <tr>
                                <th>الرتبة العلمية</th>
                                <td>{{ isset($user->ProjectSupervisor->scientific_degrees->name) !=null ? $user->ProjectSupervisor->scientific_degrees->name : 'لايوجد أي بيانات ليتم عرضها!.' }}</td>
                            </tr>
                            <tr>
                                <th>تاريخ أضافة البيانات الاكاديمية الى النظام</th>
                                <td>{{ isset($user->ProjectSupervisor->created_at) !=null ? $user->ProjectSupervisor->created_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th>أخر تحديث للبيانات الاكاديمية</th>
                                <td>{{ isset($user->ProjectSupervisor->updated_at) !=null ? $user->ProjectSupervisor->updated_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>

        <div class="footer">
            <p>طبع بواسطة : {{ Auth::user()->username }} | {{ Time_Now() }}</p>
        </div>


    </div>
</body>

</html>