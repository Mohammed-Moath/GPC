@extends('layouts.Master.Student') 

@section('title')
    التسليمات
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-book"></i>  التسليمات
        </li>
        <li  class="pull-left">
            <a title="الرئيسية" href="{{ url('home/student') }}">الرئيسية <i class="fa fa-home"></i> </a>
        </li>
        <a class="pull-left" title="رجوع" href="{{ URL::previous() }}"> رجوع <i class="fa fa-mail-forward"></i></a>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><strong>تفاصيل التسليم المطلوب</strong></h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered    text-center">
                    <thead >
                        <tr>
                            <th class="text-center">العام الجامعي</th>
                            <th class="text-center">الفصل الدراسي</th>
                            <th class="text-center">تاريخ بدء التسليم</th>
                            <th class="text-center">تاريخ انتهاء التسليم</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ isset($Deliveries->AcademicYear) !=null ? $Deliveries->AcademicYear : 'لاتوجد بيانات ليتم عرضها!'}}</td>
                            <td>{{ isset($Deliveries->Semester) !=null ? $Deliveries->Semester : 'لاتوجد بيانات ليتم عرضها!'}}</td>
                            <td>{{ isset($Deliveries->time_open) !=null ? $Deliveries->time_open : 'لاتوجد بيانات ليتم عرضها!'}}</td>
                            <td><span class="label label-danger">{{ isset($Deliveries->time_close) !=null ? $Deliveries->time_close : 'لاتوجد بيانات ليتم عرضها!'}}</span></td>
                        </tr>
                    </tbody>
                    <thead >
                        <tr>
                            <th colspan="4" class="text-center">موضوع التسليم المطلوب</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">{{ isset($Deliveries->name) !=null ? $Deliveries->name : 'لاتوجد بيانات ليتم عرضها!'}}</td>
                        </tr>
                    </tbody>
                    <thead >
                        <tr>
                            <th colspan="4" class="text-center">الوصف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">{{ isset($Deliveries->descrdiption) !=null ? $Deliveries->descrdiption : 'لاتوجد بيانات ليتم عرضها!'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <h5>أضف الملف المطلوب من هنا</h5>
                <form class="input-group" action="{{ URL::to("student/deliveries/$Deliveries->id/submit") }}" role="form" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                    <span class="input-group-btn">
                        <button title="تحميل الملف" id="fake-file-button-browse" type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-file"></span>
                        </button>
                    </span>
                
                    <input type="file" name="import_file" id="files-input-upload" required style="display:none">
                    <input type="text"  id="fake-file-input-name" disabled="disabled" placeholder="لم يتم أختيار الى ملف"  class="form-control">

                    <span class="input-group-btn">
                        <button title="تقديم" type="submit" class="btn btn-default" disabled="disabled" id="fake-file-button-upload">
                            <span class="glyphicon glyphicon-open"></span>
                        </button>
                    </span>
                </form>
            </div>

           



         
    

        </div>
    </div>
   

  
   
 
 
@endsection           
 
@section('footer')

    <script type="text/javascript">
        // Fake file upload
        document.getElementById('fake-file-button-browse').addEventListener('click', function() {
            document.getElementById('files-input-upload').click();
        });

        document.getElementById('files-input-upload').addEventListener('change', function() {
            document.getElementById('fake-file-input-name').value = this.value;
            
            document.getElementById('fake-file-button-upload').removeAttribute('disabled');
        });
    </script>

@endsection      

