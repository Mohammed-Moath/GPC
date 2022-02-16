@if( IsStudentManger() == 'yes')
    @foreach($Wishe as $W)
        <!-- Modal -->
        <div id="myModal-{{$W->proposals->id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-unsorted"></i>  تحديد أولوية المشاريع</h4>
                </div>
                {!! Form::open(["url"=>['student/select/priority', $W->id,$W->proposals->id,$G->id]]) !!}
                    <div class="modal-body">
                        <div class="table-responsive">
                            <p> <strong>تحديد أولوية مشروع :</strong> {{ isset($W->proposals->ProjectProposalTitle) ? $W->proposals->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!.'  }}</p> 
                            <p>  {{ Form::select('priority', Number(), null, ['class'=>'form-control','required','placeholder' => '--- حدد رقم الالولوية من هنا ---']) }} </p>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">تقديم</button>
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">ألغاء</button>
                    </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    @endforeach  
@endif