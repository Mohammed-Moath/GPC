@foreach($Studets as $s)
<div class="modal fade" id="Details_Student_Data-{{$s->AcdameicNumber}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h6 class="modal-title" id="Heading"> <i class="fa fa-folder-open"></i> بيانات الطالب الاكاديمية :</h6>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close" aria-hidden="true"></span></button>


            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><span class="label label-default">أسم الطالب</span></th>
                                <th>{{ isset($s->users->Name) !=null ? $s->users->Name : 'لا يوجد اي بيانات ليتم عرضها!'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><span class="label label-default">الرقم الإكاديمي</span></th>
                                <td>{{ isset($s->AcdameicNumber) !=null ? $s->AcdameicNumber : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">المركز الدراسي </span></th>
                                <td>{{ isset($s->branches->BrancheNameAR) !=null ? $s->branches->BrancheNameAR : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">التخصص</span></th>
                                <td>{{ isset($s->programs->ProgramName) !=null ? $s->programs->ProgramName : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">القسم العلمي</span></th>
                                <td>{{ isset($s->programs->scientific_departments->DepartmentName) !=null ? $s->programs->scientific_departments->DepartmentName : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default"> عدد ساعاته المعتمده</span></th>
                                <td>{{ isset($s->HoursCompleted) !=null ? $s->HoursCompleted : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">قيامه بالتدريب الميداني</span></th>
                                <td>{{ isset($s->Complete_FeldTraining) !=null ? $s->Complete_FeldTraining : 'لا يوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">تاريخ اضافة البيانات الاكاديمية الى النظام</span></th>
                                <td>{{ isset($s->created_at) !=null ? $s->created_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">تاريخ أخر تحديث للبيانات الاكاديمية</span></th>
                                <td>{{ isset($s->updated_at) !=null ? $s->updated_at : 'لا توجد أي بيانات ليتم عرضها !'}}</td>
                            </tr>
                            <!-- @if(isset($s->users_id) !=null)
                            <tr>
                                <th class="text-center" colspan="2">

                                    <a href="{{ url('show/users',$s->users_id) }}" title="عرض البيانات الشخصية/ بيانات استخدام النظام للطالب"><button class="btn btn-primary btn-xs"><strong> عرض البيانات الشخصية / بيانات استخدام النظام للطالب</strong></button>
                                    </a>

                                </th>
                            </tr>
                            @endif -->
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer ">
                <a type="submit" class="btn btn-default" href='{{ url("project-committee/data/student/pdf/$s->users_id")}}'> <i class="fa fa-file-pdf-o"></i></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">أنهاء</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach