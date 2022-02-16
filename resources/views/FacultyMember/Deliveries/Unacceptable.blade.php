@foreach($Group->delivs as $d)
    <div class="modal fade" id="Unacceptable-{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading"> <i class="fa fa-comment-o"></i> ملاحظات</h4>
                </div>
                {!! Form::open(['url'=>["FacultyMember/deliveries/$d->id/2"]]) !!}
                    <div class="modal-body"> 
                        {!! Form::textarea('Note',null,['id'=>'Note','class'=>'form-control','placeholder'=>'اترك ملاحظتك حول التسليم','title'=>'ملاحظات']) !!}         
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-danger"> <i class="fa fa-times-circle-o"></i> غير مقبول</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">الغاء</button>
                    </div>
                {!! Form::close() !!}    
            </div>
            <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>
@endforeach   
    