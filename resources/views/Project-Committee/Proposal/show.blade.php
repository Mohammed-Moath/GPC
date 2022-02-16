@extends('layouts.Master.Project-Committee') 

@section('title')
 مقترح المشروع رقم : {{ isset($Proposal->id) !=null ?  $Proposal->id : '' }}
@endsection 

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a title="المقترحات" href="{{ url('project-committee/proposal') }}"><i class="fa fa-file-powerpoint-o"></i> المقترحات </a></li>
                    <li class="breadcrumb-item active"> مقترح رقم | {{ isset($Proposal->id) !=null ?  $Proposal->id : 'لايوجد أي بيانات ليتم عرضها!.' }}</li>
                </ol>
            </nav>
        </div>

        <div class="col-4">
            <div class="text-left">
                <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
                <a title="الرئيسية" href="{{ url('home/GPCO') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
            </div>
        </div>
    </div>

   
           
    <div class="row"> 
        <div class="col-md-12 table-responsive">
            <h5 class="text-center">{{ isset($Proposal->ProjectProposalTitle) !=null ? $Proposal->ProjectProposalTitle : 'لاتوجد أي بيانات ليتم عرضها !'}}</h5>
            <hr>
        </div> 
              

        <div class="col-md-12 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="3" class="text-left">
                            <i class="fa fa-cogs"></i> <strong>الخيارات |<strong>
                            <div class="btn-group" role="group">
                                <a title="مراجعة وتعديل "  class="btn btn-outline-warning" href="{{ url("projectCommittee/proposal/$Proposal->id/edit") }}"><i class="fa fa-edit"></i></a>
                                <a title="أعتماد" class="btn btn-outline-success" href="{{ url("projectCommittee/proposal/$Proposal->id/approval") }}"><i class="fa fa-check-square-o"></i></a>
                                <a title="الغاء الاعتماد" class="btn btn-outline-secondary" href="{{ url("projectCommittee/proposal/$Proposal->id/cancellation-accreditation") }}"><i class="fa fa-minus-circle"></i></a>
                                <button type="button" title="حذف" class="btn btn-outline-danger"  data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-trash-o"></i></button>
                                <button title="طباعة"  class="btn btn-outline-dark"><i class="fa fa-print"></i></button>
                                <a title="PDF"  class="btn btn-outline-danger" href="{{ url("#") }}"><i class="fa fa-file-pdf-o"></i></a>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th  title="مقدم هذا المقترح" class="text-center" >
                            <span class="image-user-Proposals">
                                <img title="مقدم هذا المقترح" class="rounded-right"  src="{{ isset($Proposal->users->PresonalPicture) !=null ? asset($Proposal->users->PresonalPicture) : '' }}" alt="خطأ في تحميل الصورة">
                            </span> مقدم المقترح
                        </th>
                        <td title="الاسم الرباعي لمقدم المقترح وصفته." class="text-center"> <i class="fa fa-user"></i> {{ isset($Proposal->users->Name) !=null ? $Proposal->users->Name : 'لا توجد أي بيانات ليتم عرضها' }}<br><mark>{{ isset($Proposal->users->UserRoles->UserRoleAr) !=null ? $Proposal->users->UserRoles->UserRoleAr : 'لاتوجد أي بيانات ليتم عرضها' }}</mark></td>
                        <td class="text-center"><i class="fa fa-clock-o"></i><strong> تاريخ التقديم : {{ isset($Proposal->created_at) !=null ? $Proposal->created_at : 'لاتوجد أي بيانات ليتم عرضها!' }}</strong><br><i class="fa fa-refresh"></i> أخر تحديث تم : {{ isset($Proposal->updated_at) !=null ? $Proposal->updated_at : 'لاتوجد اي بيانات ليتم عرضها!'}}</td>
                    </tr>    
                </thead>
                <tbody>
                    <tr class="table-danger">
                        <th class="text-right" colspan="3"><i class="fa fa-warning"></i> معلومات عن حالة هذا المقترح </th>
                    </tr>
                    <tr>
                        <th class="text-center">المراجعة والاعتماد</th>
                        <th class="text-center">أختيار المقترح من قبل الطلبه</th>
                        <th class="text-center">حقوق الاشراف ، والنشر</th>
                    </tr>
                    <tr>
                        <td class="text-center">
                            @if($Proposal->References ==0 && $Proposal->Certified ==0)
                                <span class="badge badge-pill  badge-danger">غير مراجع</span>
                                <span class="badge badge-pill  badge-danger">  غير معتمد</span>
                            @endif
                            @if($Proposal->References ==1 && $Proposal->Certified ==0 )
                                <span class="badge badge-pill  badge-success">مراجع</span>
                                <span class="badge badge-pill  badge-danger"> غير معتمد</span>
                            @endif
                            @if($Proposal->References ==1 && $Proposal->Certified ==1 )
                                <span class="badge badge-pill  badge-success">مراجع</span>
                                <span class="badge badge-pill  badge-success">معتمد</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge badge-pill badge-dark">({{$Proposal->Selected}}) مجموعة </span> 
                        </td>
                        <td class="text-center">
                            @if($Proposal->PropertyRight == 1)
                                <span class="badge badge-pill badge-danger">خاص ، لا ينشر</span>
                            @endif
                            @if($Proposal->PropertyRight == 2)
                                <span class="badge badge-pill badge-success">عام، يمكن نشره</span>
                            @endif
                            @if($Proposal->PropertyRight == 3)
                                <span class="badge badge-pill badge-danger">أشراف خاص</span>
                            @endif
                            @if($Proposal->PropertyRight == 4)
                                <span class="badge badge-pill badge-success">أشراف عام</span>
                            @endif
                            @if($Proposal->PropertyRight == 5)
                                <span class="badge badge-pill badge-success">قدم من قبل اللجنة</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-center">
                            <strong> الرقم التسلسلي لهذا المقترح : </strong><span class="badge badge-pill badge-dark"> {{ isset($Proposal->id) !=null ? $Proposal->id : 'لاتوجد أي بيانات ليتم عرضها !'}}</span>
                            | 
                            <strong> العام الجامعي : </strong> 
                                <span class="badge badge-pill badge-dark">{{ isset($Proposal->calendars->AcademicYear) !=null ? $Proposal->calendars->AcademicYear : 'لاتوجد أي بيانات ليتم عرضها !'}}</span>
                            | 
                            <strong> الفصل الدراسي : </strong>
                                <span class="badge badge-pill badge-dark">{{ isset($Proposal->calendars->Semester) !=null ? $Proposal->calendars->Semester : 'لاتوجد أي بيانات ليتم عرضها !'}}</span>
                            |
                            <strong>عدد الطلاب المقترح لهذا المشروع</strong> <span class="badge badge-pill badge-dark">{{ isset($Proposal->NumberOfStudents) !=null ? $Proposal->NumberOfStudents : 'لاتوجد أي بيانات ليتم عرضها !'}}</span>
                        </th>
                    </tr>  
                </tbody>
            </table>
        </div>

        


        <div id="accordion">
            <div class="col-sm-12 table-responsive">
                <div class="card">
                    <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button title="وصف المشروع" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong>وصف المشروع</strong>
                        </button>
                    </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <p class="card-text  font-weight-normal">{{ isset($Proposal->descrdiption) !=null ? $Proposal->descrdiption :'لاتوجد أي بيانات ليتم عرضها !'}}</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 table-responsive">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button title="حدود المشروع Scope" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <strong>حدود المشروع Scope</strong>
                        </button>
                    </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <p class="card-text font-weight-normal">{{ isset($Proposal->scope) !=null ? $Proposal->scope : 'لاتوجد أي بيانات ليتم عرضها !'}}</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 table-responsive">
                <div class="card">
                    <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button title="المخرجات المتوقعه من المشروع" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <strong>المخرجات المتوقعه من المشروع</strong>
                        </button>
                    </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <p class="card-text font-weight-normal">{{ isset($Proposal->Outputs) !=null ? $Proposal->Outputs :'لاتوجد أي بيانات ليتم عرضها !'}}</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 table-responsive">
                <div class="card">
                    <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button title="الادوات والبرمجيات المتوقع استخدامها" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <strong>الادوات والبرمجيات المتوقع استخدامها</strong>
                        </button>
                    </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                        <p class="card-text font-weight-normal">{{ isset($Proposal->Tools) !=null ? $Proposal->Tools : 'لاتوجد أي بيانات ليتم عرضها !'}}</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 table-responsive">
                <div class="card">
                    <div class="card-header" id="headingFive">
                    <h5 class="mb-0">
                        <button title="أهمية هذا المشروع" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <strong>أهمية هذا المشروع</strong>
                        </button>
                    </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body">
                        <p class="card-text font-weight-normal">{{ isset($Proposal->ImportanceProposal) !=null ? $Proposal->ImportanceProposal : "لاتوجد أي بيانات ليتم عرضها !" }}</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 table-responsive">
                <div class="card">
                    <div class="card-header" id="headingSix">
                    <h5 class="mb-0">
                        <button title="التخصصات التي تلأئم هذا المشروع" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <strong>التخصصات التي تلأئم هذا المشروع</strong>
                        </button>
                    </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body">
                        @if(count($Proposal->programs) ==0)
                            <div class="alert alert-danger text-center" role="alert">
                                <i class="fa fa-warning"></i> لاتوجد بيانات
                            </div>
                        @endif
                        @if(count($Proposal->programs) !=0)
                            <table class="table table-sm table-hover  table-bordered">
                                <thead>
                                    <tr class="table-dark">
                                    <th scope="col">القسم</th>
                                    <th scope="col">نوع البرنامج</th>
                                    <th scope="col">التخصص</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Proposal->programs as $p)
                                        <tr>
                                            <td>{{ isset($p->scientific_departments->DepartmentName) !=null ? $p->scientific_departments->DepartmentName : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                            <td>{{ isset($p->program_types->name) !=null ? $p->program_types->name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                            <td>{{ isset($p->ProgramName) !=null ? $p->ProgramName : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 table-responsive">
                <div class="card">
                    <div class="card-header" id="headingSeven">
                    <h5 class="mb-0">
                        <button title="المشرفين المقترحين" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <strong>المشرفين المقترحين</strong>
                        </button>
                    </h5>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body">
                        <p class="card-text font-weight-normal">
                            @if(count($SP) ==0)
                                <div class="alert alert-danger text-center" role="alert">
                                    <i class="fa fa-warning"></i> لاتوجد بيانات
                                </div>
                            @endif

                           
                            @if(count($SP) !=0)
                                @foreach($SP as $s) 
                                    - {{ isset($s->project_supervisors->users->Name) !=null ? $s->project_supervisors->users->Name : 'لا يوجد أي بيانات ليتم عرضها !.' }}  <br>
                                @endforeach
                            @endif
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('Project-Committee.Proposal.delete')
@endsection

@section('footer')
<script>
function myFunction() {
    window.print();
}
</script>

@endsection  