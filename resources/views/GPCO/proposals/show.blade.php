@extends('layouts.Master.GPCO') 

@section('title')
   تفاصيل مقترح المشروع رقم :  {{ isset($ShowProposal->id) !=null ?  $ShowProposal->id: 'لايوجد أي بيانات ليتم عرضها!.' }}
@endsection 

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header text-center">
                      <i class="fa fa-file-text-o"></i>  المقترحات
                    </h3>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-file-text-o"></i>  المقترحات 
                        </li>
                        <li>
                            <a title="أدارة المقترحات" href="{{url('Proposal')}}"><i class="fa fa-repeat"></i> أدارة المقترحات</a>
                        </li>
                        <li class="active">
                            تفاصيل المقترح رقم :  {{ isset($ShowProposal->id) !=null ?  $ShowProposal->id: 'لايوجد أي بيانات ليتم عرضها!.' }}
                        </li>
                        <li  class="pull-left">
                            <a title="الرئيسية" href="{{ url('home/GPCO') }}">الرئيسية <i class="fa fa-home"></i> </a>
                        </li>
                            <a title="رجوع" class="pull-left" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
                    </ol>
                </div>
            </div> 
            <!-- /.row -->
           
            <div class="row"> 
                <div class="col-lg-12 col-md-12 table-responsive">
                    <h4 class="text-center"><strong> مقترح مشروع /</strong></h4>
                     <h4 class="text-center"><span class="label label-primary">{{ isset($ShowProposal->ProjectProposalTitle) !=null ? $ShowProposal->ProjectProposalTitle : 'لاتوجد أي بيانات ليتم عرضها !'}}</span></h4>
                     <hr>
                </div> 
                </br> 
                <hr>

                <div class="col-lg-6 col-md-6 table-responsive">
                    <i class="fa fa-cogs"></i> <strong>الخيارات |<strong>
                    <a href="{{ url("review/proposal/$ShowProposal->id/edit") }}"> <button title="مراجعة وتعديل المقترح" type="reset" class="btn btn-info"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a>
                    <a href="{{ url("review/proposal/$ShowProposal->id/approval") }}"> <button title="أعتماد هذا المقترح" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-check" aria-hidden="true"></span></button></a>
                    <a href="{{ url("review/proposal/$ShowProposal->id/cancellation-accreditation") }}"> <button title="ألغاء اعتماد هذا المقترح" type="submit" class="btn btn-warning"><i class="fa fa-minus-circle"></i></button></a>
                    <button data-title="Delete" data-toggle="modal" data-target="#delete" class="btn btn-danger" title="حذف هذا المقترح"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                    <button title="Print"  onclick="myFunction()" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                    <a href="{{ url("pdf/proposal/$ShowProposal->id") }}"> <button title="PDF" type="reset" class="btn btn-default"><i class="fa fa-file-pdf-o"></i></button></a>
                    <hr>
                </div>

                <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                    <table class="table table-bordered  ">
                        <thead>
                            <tr>
                                <th  title="مقدم هذا المقترح" class="text-center" >
                                    <span class="image-user-Proposals">
                                        <img title="مقدم هذا المقترح" class="img-rounded"  src="{{ isset($ShowProposal->users->PresonalPicture) !=null ? asset($ShowProposal->users->PresonalPicture) : '' }}" alt="خطأ في تحميل الصورة">
                                    </span> مقدم المقترح
                                </th>
                                <td title="الاسم الرباعي لمقدم المقترح وصفته." class="text-center"> <i class="fa fa-user"></i> {{ isset($ShowProposal->users->Name) !=null ? $ShowProposal->users->Name : 'لا توجد أي بيانات ليتم عرضها' }}<br><mark>{{ isset($ShowProposal->users->UserRoles->UserRoleAr) !=null ? $ShowProposal->users->UserRoles->UserRoleAr : 'لاتوجد أي بيانات ليتم عرضها' }}</mark></td>
                                <td class="text-center"><i class="fa fa-clock-o"></i><strong> تاريخ التقديم : {{ isset($ShowProposal->created_at) !=null ? $ShowProposal->created_at : 'لاتوجد أي بيانات ليتم عرضها!' }}</strong><br><i class="fa fa-refresh"></i> أخر تحديث تم : {{ isset($ShowProposal->updated_at) !=null ? $ShowProposal->updated_at : 'لاتوجد اي بيانات ليتم عرضها!'}}</td>
                            </tr>    
                        </thead>
                        <tbody>
                            <tr class="danger">
                                <th class="text-right" colspan="3"><i class="fa fa-warning"></i> معلومات عن حالة هذا المقترح </th>
                            </tr>
                            <tr>
                                <th class="text-center">المراجعة والاعتماد</th>
                                <th class="text-center">أختيار المقترح من قبل الطلبه</th>
                                <th class="text-center">حقوق الاشراف ، والنشر</th>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    @if($ShowProposal->References ==0 && $ShowProposal->Certified ==0)
                                        <span class="label label-danger">غير مراجع</span>
                                        <span class="label label-danger">  غير معتمد</span>
                                    @endif
                                    @if($ShowProposal->References ==1 && $ShowProposal->Certified ==0 )
                                        <span class="label label-success">مراجع</span>
                                        <span class="label label-danger"> غير معتمد</span>
                                    @endif
                                    @if($ShowProposal->References ==1 && $ShowProposal->Certified ==1 )
                                        <span class="label label-success">مراجع</span>
                                        <span class="label label-success">معتمد</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($ShowProposal->References =1 && $ShowProposal->Certified ==1 && $ShowProposal->Selected >0 )
                                        <span class="label label-info"> تم اختياره من قبل  <span class="badge">{{$ShowProposal->Selected}}</span> مجموعة</span>    
                                    @endif
                                    @if($ShowProposal->References =1 && $ShowProposal->Certified ==1 && $ShowProposal->Selected ==0 )
                                        <span class="label label-warning">لم يتم أختياره</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($ShowProposal->PropertyRight == 1)
                                        <span class="label label-danger">خاص ، لا ينشر</span>
                                    @endif
                                    @if($ShowProposal->PropertyRight == 2)
                                        <span class="label label-success">عام، يمكن نشره</span>
                                    @endif
                                    @if($ShowProposal->PropertyRight == 3)
                                        <span class="label label-danger">أشراف خاص</span>
                                    @endif
                                    @if($ShowProposal->PropertyRight == 4)
                                        <span class="label label-success">أشراف عام</span>
                                    @endif
                                    @if($ShowProposal->PropertyRight == 5)
                                        <span class="label label-success">قدم من قبل اللجنة</span>
                                    @endif
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>

                <div class=" col-lg-12 col-md-12 col-sm-12 table-responsive">
                    <table class="table  table-hover">
                        <tbody>
                            <tr class="info text-center">
                                <th>
                                    <strong> الرقم التسلسلي لهذا المقترح : </strong><span class="badge"> {{ isset($ShowProposal->id) !=null ? $ShowProposal->id : 'لاتوجد أي بيانات ليتم عرضها !'}}</span>
                                    | 
                                    <strong> العام الجامعي : </strong> 
                                     {{ isset($ShowProposal->AcademicYear) !=null ? $ShowProposal->AcademicYear : 'لاتوجد أي بيانات ليتم عرضها !'}}
                                    | 
                                    <strong> الفصل الدراسي : </strong>
                                     {{ isset($ShowProposal->Semester) !=null ? $ShowProposal->Semester : 'لاتوجد أي بيانات ليتم عرضها !'}}
                                    |
                                    <strong>عدد الطلاب المقترح لهذا المشروع</strong> <span class="badge">{{ isset($ShowProposal->NumberOfStudents) !=null ? $ShowProposal->NumberOfStudents : 'لاتوجد أي بيانات ليتم عرضها !'}}</span>
                                </th>
                            </tr>
                            <tr>
                                <th title="وصف المشروع"><h4><span class="label label-default">وصف المشروع</span></h4></th>
                            </tr>
                            <tr>    
                                <td title="وصف المشروع">
                                    {{ isset($ShowProposal->descrdiption) !=null ? $ShowProposal->descrdiption :'لاتوجد أي بيانات ليتم عرضها !'}}
                                </td>
                            </tr>
                            <tr>
                                <td title="حدود المشروع"><h4><span class="label label-default"> حدود المشروع Scope</span></h4></td>
                            </tr>
                            <tr>    
                                <td title="حدود المشروع">
                                    {{ isset($ShowProposal->scope) !=null ? $ShowProposal->scope : 'لاتوجد أي بيانات ليتم عرضها !'}}
                                </td>
                            </tr>
                            <tr>
                                <td title="المخرجات المتوقعه من المشروع"><h4><span class="label label-default">المخرجات المتوقعه من المشروع</span></h4></td>
                            </tr>
                            <tr>    
                                <td title="المخرجات المتوقعة من المشروع">
                                   {{ isset($ShowProposal->Outputs) !=null ? $ShowProposal->Outputs :'لاتوجد أي بيانات ليتم عرضها !'}}
                                </td>
                            </tr>
                            <tr>
                                <td title=" أهمية هذا المشروع"><h4><span class="label label-default">أهمية هذا المشروع</span></h4></td>
                            </tr>
                            <tr>    
                                <td title="أهمية هذا المشروع">
                                    {{ isset($ShowProposal->ImportanceProposal) !=null ? $ShowProposal->ImportanceProposal : "لاتوجد أي بيانات ليتم عرضها !" }}
                                </td>
                            </tr>
                            <tr>
                                <td title="الادوات والبرمجيات المتوقع استخدامها"><h4><span class="label label-default">الادوات والبرمجيات المتوقع استخدامها</span></h4></td>
                            </tr>
                            <tr>
                                <td title="الأدوات والبرمجيات المتوقع استخدامها">
                                   {{ isset($ShowProposal->Tools) !=null ? $ShowProposal->Tools : 'لاتوجد أي بيانات ليتم عرضها !'}}
                                </td>
                            </tr>
                            <tr>
                                <td title="التخصصات التي تلائم هذا المشروع"><h4><span class="label label-default">التخصصات التي تلأئم هذا المشروع</span></h4></td>
                            </tr>
                            <tr>
                                <td title="التخصصات التي تلأئم هذا المشروع">
                                    @if(count($Programs) !=0)
                                        @foreach($Programs as $pro)
                                            @if( in_array($pro->id,$p) )
                                            - {{$pro->ProgramName}}  <br>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if(count($Programs) ==0)
                                        <span class="label label-danger">لم يتم تحديد أي تخصص</span>
                                    @endif    
                                </td>
                               
                            </tr>
                            <tr>
                               
                                <td title="التخصصات التي تلائم هذا المشروع"><h4><span class="label label-default">المشرفين المتوقين لهذا المقترح</span></h4></td>
                            </tr>
                            <tr>
                               
                                <td title="المشرف المتوقع لهذا المشروع">
                                    @if(count($SP)== 0)
                                        <span class="label label-danger">لم يتم تحديد أي مشرف</span>
                                    @endif
                                    @if(count($SP) != 0)
                                        @foreach($SP as $s)
                                       
                                            - {{ isset($s->project_supervisors->users->Name) !=null ? $s->project_supervisors->users->Name : 'لا يوجد أي بيانات ليتم عرضها !.' }}  <br>
                                          
                                        @endforeach
                                    @endif
                              
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.row -->    
        </div> <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    @include('GPCO.proposals.deletes_proposal')
@endsection

@section('footer')
<script>
function myFunction() {
    window.print();
}
</script>

@endsection  