@foreach($Supervisors as $s)
<div class="modal fade" id="Details_Supervisor_Data-{{$s->FunctionalNumber}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header">
                <h6 class="modal-title" id="Heading"> <i class="fa fa-folder-open"></i> بيانات المشرف :</h6>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close" aria-hidden="true"></span></button>


            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><span class="label label-default">أسم المشرف</span></th>
                                <th>{{ isset($s->users->Name) !=null ? $s->users->Name : 'لا يوجد بيانات !'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><span class="label label-default">الرقم الوظيفي</span></th>
                                <td>{{ isset($s->FunctionalNumber) !=null ? $s->FunctionalNumber : 'لا يوجد بيانات !'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">رقم التلفون</span></th>
                                <td>{{ isset($s->users->PhoneNumber) !=null ? $s->users->PhoneNumber : 'لا يوجد بيانات !'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">الدرجة العلمية </span></th>
                                <td>{{ isset($s->scientific_degrees->name) !=null ? $s->scientific_degrees->name : 'لا يوجد بيانات !'}}</td>
                            </tr>
                            <tr>
                                <th><span class="label label-default">التخصص</span></th>
                                <td>{{ isset($s->programs->ProgramName) !=null ? $s->programs->ProgramName : 'لا يوجد بيانات !'}}</td>
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
                <a type="submit" class="btn btn-default" href='{{ url("project-committee/data/supervisors/pdf/$s->users_id") }}'> <i class="fa fa-file-pdf-o"></i></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">أنهاء</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach