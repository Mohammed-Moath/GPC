@foreach($Wishes as $w)
    <div class="modal fade" id="Approval-{{$w->id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading"> <i class="fa fa-comment-o"></i> ملاحظات ورأي اللجنة </h4>
                </div>
                {!! Form::open(['url'=>["approval/project/$w->groups_id/$w->proposals_id"]]) !!}
                    <div class="modal-body"> 
                        {!! Form::textarea('NotesCommittee',null,['id'=>'NotesCommittee','class'=>'form-control','placeholder'=>'ملاحظات ورأي اللجنة للمجموعة','title'=>'ملاحظات ورأي اللجنة']) !!}         
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check-circle-o"></i> أعتماد</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">الغاء</button>
                    </div>
                {!! Form::close() !!}    
            </div>
            <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>
@endforeach   
    