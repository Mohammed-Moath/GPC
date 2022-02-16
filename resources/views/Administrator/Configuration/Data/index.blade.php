@extends('layouts.Master.Administrator') 

@section('title')
 بيانات 
@endsection

@section('content')

    <div class="row">
        <div class="col-8">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">  <i class="fa fa-gear"></i> التهيئة </li>
                    <li class="breadcrumb-item active"> بيانات </li>
                </ol>
            </nav>
        </div>

        <div class="col-4">
            <div class="text-left">
                <a title="رجوع"  href="{{ URL::previous() }}" class="badge badge-light "> <i class="fa fa-mail-forward"></i> رجوع</a>
                <a title="الرئيسية" href="{{ url('administrator/home') }}" class="badge badge-light "> <i class="fa fa-home"></i> الرئيسية</a>
            </div>
        </div>
    </div>
    <div class="card-body text-danger text-left">
        <i class="fa fa-info-circle"></i>
        هنا يتم أضافة البيانات الخاصة بالكلية .
    </div>
   

    <div class="row">
        <div class="table-responsive col-sm-3 ">
            <h6 class="text-center">الأقسام العلمية</h6>
            <div class=" dataTable NiceScroll">
                <table class="table table-sm table-hover  table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">
                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus-square"></i></button>
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(scientific_departments() as $SD)
                            <tr>
                                <th scope="row" class="text-center"> 
                                @if($SD->status !=0)
                                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                @endif
                                @if($SD->status ==0)
                                    <button type="button" class="btn btn-sm btn-danger" disabled><i class="fa fa-trash-o"></i></button>
                                @endif
                                </th>
                                <td>{{ isset($SD->id) !=null ? $SD->id : '' }}</td>
                                <td>{{ isset($SD->DepartmentName) !=null ? $SD->DepartmentName : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>   
            <small  class="form-text text-muted">
              الأقسام العلمية المتواجدة في الكلية
            </small>
            <hr>
        </div>
        <div class="table-responsive col-sm-3 ">
            <h6 class="text-center">البرامج</h6>
            <div class=" dataTable NiceScroll">
                <table class="table table-sm table-hover  table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">
                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus-square"></i></button>
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(program_types() as $PT)
                            <tr>
                                <th scope="row" class="text-center"> 
                                @if($PT->status !=0)
                                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                @endif
                                @if($PT->status ==0)
                                    <button type="button" class="btn btn-sm btn-danger" disabled><i class="fa fa-trash-o"></i></button>
                                @endif
                                </th>
                                <td>{{ isset($PT->id) !=null ? $PT->id : '' }}</td>
                                <td>{{ isset($PT->name) !=null ? $PT->name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
            <small  class="form-text text-muted">
              البرامج العلمية المتواجدة في الكلية
            </small>
            <hr>  
        </div>
        <div class="table-responsive col-sm-6 ">
            <h6 class="text-center">التخصصات</h6>
            <div class=" dataTable NiceScroll">
                <table class="table table-sm table-hover  table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">
                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus-square"></i></button>
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">القسم العلمي</th>
                            <th scope="col">نوع البرنامج</th>
                            <th scope="col">التخصص</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Program() as $p)
                            <tr>
                                <th scope="row" class="text-center"> 
                                @if($p->status !=0)
                                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                @endif
                                @if($p->status ==0)
                                    <button type="button" class="btn btn-sm btn-danger" disabled><i class="fa fa-trash-o"></i></button>
                                @endif
                                </th>
                                <td>{{ isset($p->id) !=null ? $p->id : '' }}</td>
                                <td>{{ isset($p->scientific_departments->DepartmentName) !=null ? $p->scientific_departments->DepartmentName : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                <td>{{ isset($p->program_types->name) !=null ? $p->program_types->name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                <td>{{ isset($p->ProgramName) !=null ? $p->ProgramName : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  
            <small  class="form-text text-muted">
              تخصصات الكلية
            </small> 
            <hr>
        </div>
      
    </div>

    <div class="row">
        <div class="table-responsive col-sm-3 ">
            <h6 class="text-center"> الفروع</h6>
            <div class=" dataTable NiceScroll">
                <table class="table table-sm table-hover  table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus-square"></i></button></th>
                            <th scope="col">#</th>
                            <th scope="col">الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(branches() as $b)
                            <tr>
                                <th scope="row" class="text-center"> 
                                @if($b->status !=0)
                                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                @endif
                                @if($b->status ==0)
                                    <button type="button" class="btn btn-sm btn-danger" disabled><i class="fa fa-trash-o"></i></button>
                                @endif
                                </th>
                                <td>{{ isset($b->id) !=null ? $b->id : '' }}</td>
                                <td>{{ isset($b->BrancheNameAR) !=null ? $b->BrancheNameAR : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
            <small  class="form-text text-muted">
             فروع الكلية
            </small>  
            <hr>
        </div>
        <div class="table-responsive col-sm-4 ">
            <h6 class="text-center">الرتب العلمية</h6>
            <div class=" dataTable NiceScroll">
                <table class="table table-sm table-hover  table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">
                                <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus-square"></i></button>
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">الدرجة العلمية</th>
                            <th scope="col">المسمى</th>
                            <th scope="col">الرمز</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(scientific_degrees() as $sd)
                            <tr>
                                <th scope="row" class="text-center"> 
                                @if($sd->status !=0)
                                    <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                @endif
                                @if($sd->status ==0)
                                    <button type="button" class="btn btn-sm btn-danger" disabled><i class="fa fa-trash-o"></i></button>
                                @endif
                                </th>
                                <td>{{ isset($sd->id) !=null ? $PT->id : '' }}</td>
                                <td>{{ isset($sd->scientific_degrees) !=null ? $sd->scientific_degrees : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                <td>{{ isset($sd->name) !=null ? $sd->name : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                                <td>{{ isset($sd->code) !=null ? $sd->code : 'لاتوجد بيانات ليتم عرضها !' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
            <small  class="form-text text-muted">
              الرتب العلمية لأعضاء هيئة التدريس
            </small>
            <hr>  
        </div>
    </div>
@Stop